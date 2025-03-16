<?php

namespace App\Http\Service;

interface SetMenuApiService
{
    public function fetchPaginatedData(int $page):string;

}
