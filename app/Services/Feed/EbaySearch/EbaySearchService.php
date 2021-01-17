<?php

namespace App\Services\Feed\EbaySearch;

use App\FeedEntities\EbayFeed;
use App\FeedEntities\FeedInterface;
use App\Services\Feed\EbaySearch\Filters\FilterFactory;
use App\Services\Feed\SearchInterface;
use Exception;
use Illuminate\Support\Facades\Http;

class EbaySearchService implements SearchInterface
{
    //Currently support only JSON format
    private const RESPONSE_DATA_FORMAT = 'JSON';
    private const ENTRIES_PER_PAGE = 100;

    private $feed;
    private $baseUrl;
    private $serviceVersion;
    private $appName;
    private $operationName;
    private $keywords;
    private $sort;
    private $sortOrder;
    private $filterFactory;
    private $filters = [];

    public function __construct(EbayFeed $feed, FilterFactory $filterFactory, EbaySortOrder $sort, string $baseUrl, string $serviceVersion, string $appName)
    {
        $this->feed = $feed;
        $this->filterFactory = $filterFactory;
        $this->sort = $sort;
        $this->baseUrl = $baseUrl;
        $this->serviceVersion = $serviceVersion;
        $this->appName = $appName;
    }

    /**
     * @throws Exception
     */
    public function findItemsByKeyword(string $keywords): void
    {
        $this->operationName = 'findItemsByKeywords';
        $this->keywords = $keywords;

        $pageNr = 1;
        while (true) {
            $response = Http::get($this->baseUrl . '?' . $this->buildSearchParams($pageNr));
            $pageNr++;
            $response = json_decode($response);

            if (isset($response->findItemsByKeywordsResponse[0]->ack[0])
                && $response->findItemsByKeywordsResponse[0]->ack[0] === 'Success'
                ) {

                if ($response->findItemsByKeywordsResponse[0]->paginationOutput[0]->totalEntries[0] > 0) {
                    foreach ($response->findItemsByKeywordsResponse[0]->searchResult[0]->item as $item) {
                        $this->feed->add($item);
                    }
                }

                if ($pageNr > $response->findItemsByKeywordsResponse[0]->paginationOutput[0]->totalPages[0]) {
                    break;
                }
            } else {
                throw new Exception('Failed to get feed data.');
                break;
            }
        }
    }

    public function getFeed(): FeedInterface
    {
        return $this->feed;
    }

    public function setFilter($value, $condition, $currency = ''): self
    {
        $this->filters[] = $this->filterFactory->make($value, $condition, $currency);

        return $this;
        //PricePlusShippingLowest
       /* itemFilter(0).name=MaxPrice&
        itemFilter(0).value=2500.00&
        itemFilter(0).paramName=Currency&
        itemFilter(0).paramValue=USD&
        itemFilter(1).name=MinPrice&
        itemFilter(1).value=2000.00&
        itemFilter(1).paramName=Currency&
        itemFilter(1).paramValue=USD& */
    }

    public function setSort(string $type): self
    {
        $this->sortOrder = $this->sort->getSortOrderByKey($type);

        return $this;
    }

    private function buildSearchParams(int $pageNr): string
    {
        return urldecode(http_build_query(array_merge([
            'OPERATION-NAME' => $this->operationName,
            'SERVICE-VERSION' => $this->serviceVersion,
            'SECURITY-APPNAME' => $this->appName,
            'RESPONSE-DATA-FORMAT' => self::RESPONSE_DATA_FORMAT,
            'keywords' => $this->keywords,
            'paginationInput.entriesPerPage' => self::ENTRIES_PER_PAGE,
            'paginationInput.pageNumber' => $pageNr,
            'sortOrder' => $this->sortOrder ?? 'default',
        ], $this->buildFilters())));
    }

    private function buildFilters(): array
    {
        $queryParams = [];
        $count = count($this->filters);

        for ($i=0; $i < $count; $i++) {
            $params = $this->filters[$i]->getItemFilters();
            foreach ($params as $key => $value) {
                $queryParams['itemFilter(' . $i . ').' . $key] = $value;
            }
        }

        return $queryParams;
    }
}
