<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface SetMenuRepository
{
    public function batchImport(Collection $setMenus);
    public function importCuisineRelations(Collection $setMenus);
}
