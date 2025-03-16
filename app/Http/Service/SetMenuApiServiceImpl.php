<?php

namespace App\Http\Service;

class SetMenuApiServiceImpl implements SetMenuApiService
{

    private string $setMenuApiUrl;

    public function __construct(string $setMenuApiUrl)
    {
        $this->setMenuApiUrl = $setMenuApiUrl;
    }

    public function fetchPaginatedData(int $page): string
    {
        return $this->setMenuApiUrl;
    }
}
