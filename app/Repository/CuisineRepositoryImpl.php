<?php

namespace App\Repository;

use App\Exceptions\CuisineBatchImportException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class CuisineRepositoryImpl implements CuisineRepository
{

    /**
     * @throws CuisineBatchImportException
     */
    public function batchImport(Collection $setMenus): void
    {
        DB::beginTransaction();
        $cuisinesToPersist = [];
        foreach ($setMenus as $setMenu) {
            $cuisinesToPersist = array_merge($cuisinesToPersist, $setMenu->getCuisines()->map(function ($cuisine) {
                return $cuisine->get();
            })->toArray());
        }
        try {
            DB::table('cuisines')->insertOrIgnore($cuisinesToPersist);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new CuisineBatchImportException();
        }
    }
}
