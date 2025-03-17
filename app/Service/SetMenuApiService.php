<?php

namespace App\Service;

interface SetMenuApiService
{
    public function fetchPaginatedData(int $page):string;

}
