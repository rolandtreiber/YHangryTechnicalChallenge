<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class CuisineServiceImpl implements CuisineService
{
    public function getAllCuisines()
    {
        return DB::table('cuisines')
            ->join("cuisine_set_menu", "cuisines.id", "=", "cuisine_set_menu.cuisine_id")
            ->join("set_menus", function ($join) {
                $join->on("cuisine_set_menu.set_menu_id", "=", "set_menus.id");
            })
            ->where("set_menus.available", "=", 1)
            ->select(
                "cuisines.id",
                "cuisines.name",
                "cuisines.slug",
                DB::raw("COUNT(set_menus.id) as set_menus_count"),
                DB::raw("SUM(set_menus.number_of_orders) as aggregated_number_of_orders")
            )
            ->groupBy("cuisines.id")
            ->orderBy("aggregated_number_of_orders", "DESC")
            ->get();
    }
}
