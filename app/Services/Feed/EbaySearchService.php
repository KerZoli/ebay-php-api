<?php

namespace App\Services\Feed;

use App\FeedEntities\EbayFeed;
use App\FeedEntities\FeedInterface;
use Exception;
use Illuminate\Support\Facades\Http;

class EbaySearchService implements SearchInterface
{
    //Currently support only JSON format
    private const RESPONSE_DATA_FORMAT = 'JSON';
    private const ENTRIES_PER_PAGE = 10;

    private $feed;
    private $baseUrl;
    private $serviceVersion;
    private $appName;
    private $operationName;
    private $keywords;

    public function __construct(EbayFeed $feed, string $baseUrl, string $serviceVersion, string $appName)
    {
        $this->feed = $feed;
        $this->baseUrl = $baseUrl;
        $this->serviceVersion = $serviceVersion;
        $this->appName = $appName;
    }

    /**
     * @throws Exception
     */
    public function findItemsByKeyword(string $keywords)
    {
        $this->operationName = 'findItemsByKeywords';
        $this->keywords = $keywords;

        $pageNr = 1;
        while (true) {
            $response = Http::get(
                $this->baseUrl,
                $this->buildSearchParams($pageNr)
            );

            $pageNr++;

            $response = json_decode($response);

            if (isset($response->findItemsByKeywordsResponse[0]->ack[0]) && $response->findItemsByKeywordsResponse[0]->ack[0] === 'Success') {
                if ($pageNr > $response->findItemsByKeywordsResponse[0]->paginationOutput[0]->totalPages[0]) {
                    break;
                }

                foreach ($response->findItemsByKeywordsResponse[0]->searchResult[0]->item as $item) {
                    $this->feed->add($item);
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

    public function setFilters()
    {
        // TODO: Implement setFilters() method.
    }

    private function buildSearchParams(int $pageNr): array
    {
        return [
            'OPERATION-NAME' => $this->operationName,
            'SERVICE-VERSION' => $this->serviceVersion,
            'SECURITY-APPNAME' => $this->appName,
            'RESPONSE-DATA-FORMAT' => self::RESPONSE_DATA_FORMAT,
            'keywords' => $this->keywords,
            'paginationInput.entriesPerPage' => self::ENTRIES_PER_PAGE,
            'paginationInput.pageNumber' => $pageNr,
        ];
    }
}
