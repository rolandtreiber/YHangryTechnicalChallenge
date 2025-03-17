<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface CuisineRepository
{
    public function batchImport(Collection $setMenus);
}
