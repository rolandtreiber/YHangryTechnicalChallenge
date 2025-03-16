<?php

namespace Tests\Mock\Service;

use App\Http\Service\SetMenuApiService;

abstract class BaseMockSetMenuApiService implements SetMenuApiService
{
    protected string $file;

    // I noticed that the mock api does not support setting items returned per page.
    // For this reason only, it is defined as a constant making it easy to configure should the api change.
    const PER_PAGE = 10;

    private function buildData($page): array
    {
        $from = ($page - 1) * self::PER_PAGE;
        $result = [];
        $string = file_get_contents($this->file);
        $rawData = json_decode($string);
        $collection = collect($rawData->data);
        $total = $collection->count();
        $setMenuData = $collection->slice($from, self::PER_PAGE);
        $result["data"] = [];
        foreach ($setMenuData as $setMenu) {
            $result["data"][] = $setMenu;
        }
        $result["links"] = [
            "next" => $total > ($page * self::PER_PAGE) ? "base_endpoint?page=".$page + 1 : null
        ];
        $result["meta"] = [
            "from" => $from,
            "to" => $from + self::PER_PAGE,
            "current_page" => $page,
            "last_page" => ceil($total / self::PER_PAGE),
            "per_page" => self::PER_PAGE,
            "total" => $total,
        ];

        return $result;
    }

    public function fetchPaginatedData(int $page): string
    {
        return json_encode($this->buildData($page));
    }
}
