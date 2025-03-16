<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\Http;

class SetMenuApiServiceImpl implements SetMenuApiService
{
    private string $setMenuApiUrl;

    public function __construct(string $setMenuApiUrl)
    {
        $this->setMenuApiUrl = $setMenuApiUrl;
    }

    public function fetchPaginatedData(int $page): string
    {
        $url = $this->setMenuApiUrl . "?page=" . $page;
        $response = Http::get($url);
        return $response->body();
    }
}
