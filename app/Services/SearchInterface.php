<?php

namespace App\Services;

interface SearchInterface
{
    public function setFilters();

    public function search();
}
