<?php

namespace App\Repository;

use App\Exceptions\CuisineBatchImportException;
use App\Exceptions\SetMenuBatchImportException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class SetMenuRepositoryImpl implements SetMenuRepository
{

    /**
     * @throws SetMenuBatchImportException
     */
    public function batchImport(Collection $setMenus)
    {
        DB::beginTransaction();
        $setMenusToPersist = [];
        foreach ($setMenus as $setMenu) {
            $setMenusToPersist[] = $setMenu->get();
        }
        try {
            DB::table('set_menus')->insertOrIgnore($setMenusToPersist);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new SetMenuBatchImportException();
        }
    }

    public function importCuisineRelations(Collection $setMenus)
    {
        $savedSetMenus = DB::table('set_menus')->select("id", "name")->get();
        $cuisineSetMenus = [];

        DB::beginTransaction();
        try {
            foreach ($setMenus as $setMenu) {
                foreach ($setMenu->getCuisines() as $cuisine) {
                    $setMenuId = $savedSetMenus->where("name", $setMenu->get()['name'])->firstOrFail()->id;
                    $cuisineSetMenus[] = [
                        "cuisine_id" => $cuisine->getId(),
                        "set_menu_id" => $setMenuId,
                    ];
                }
            }
            DB::table('cuisine_set_menu')->insertOrIgnore($cuisineSetMenus);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }
}
