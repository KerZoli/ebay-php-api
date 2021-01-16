<?php

namespace App\FeedEntities;

use stdClass;

interface FeedInterface
{
    public function add(stdClass $data);

    public function getResults(): array;
}
