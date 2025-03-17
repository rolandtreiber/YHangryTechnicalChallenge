<?php

namespace App\Service;

use App\Models\SetMenu;

class SetMenuServiceImpl implements SetMenuService
{
    public function getPaginatedResults($slug, $page)
    {
        return SetMenu::whereHas("cuisines", function ($query) use ($slug) {
            if ($slug) $query->where('slug', $slug);
        })->where("available", 1)->orderBy("number_of_orders", "DESC")->paginate(10);
    }
}
