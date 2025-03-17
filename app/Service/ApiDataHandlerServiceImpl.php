<?php

namespace App\Service;

use App\DTO\CuisineDTO;
use App\DTO\SetMenuDTO;
use App\Exceptions\CuisineCannotBeParsedException;
use App\Exceptions\SetMenuCannotBeParsedException;
use App\Repository\CuisineRepository;
use App\Repository\SetMenuRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class ApiDataHandlerServiceImpl implements ApiDataHandlerService
{
    private static int $activePage = 1;
    private SetMenuApiService $setMenuApiService;
    private CuisineRepository $cuisineRepository;
    private SetMenuRepository $setMenuRepository;

    private const REQUIRED_CUISINE_KEYS = ["id", "name"];
    private const REQUIRED_SET_MENU_KEYS = ["created_at",
        "name", "description", "display_text", "image", "thumbnail", "is_vegan", "is_vegetarian",
        "status", "price_per_person", "min_spend", "is_seated", "is_standing", "is_canape", "is_mixed_dietary",
        "is_meal_prep", "is_halal", "is_kosher", "available", "number_of_orders"];

    public function __construct(
        SetMenuApiService $setMenuApiService,
        CuisineRepository $cuisineRepository,
        SetMenuRepository $setMenuRepository
    )
    {
        $this->setMenuApiService = $setMenuApiService;
        $this->setMenuRepository = $setMenuRepository;
        $this->cuisineRepository = $cuisineRepository;
    }

    /**
     * @throws SetMenuCannotBeParsedException
     * @throws CuisineCannotBeParsedException
     */
    public function extractData(array $data): Collection
    {
        $setMenus = new Collection();
        foreach ($data as $setMenu) {
            $cuisines = new Collection();
            if (array_key_exists('cuisines', $setMenu)) {
                foreach ($setMenu['cuisines'] as $cuisine) {
                    $cuisines->add($this->getCuisineDTO($cuisine));
                }
            }
            $setMenuDTO = $this->getSetMenuDTO($setMenu);
            $setMenuDTO->setCuisines($cuisines);
            $setMenus->add($setMenuDTO);
        }
        return $setMenus;
    }

    /**
     * @throws CuisineCannotBeParsedException
     */
    private function getCuisineDTO(array $data): CuisineDTO
    {
        if (count(array_intersect_key(array_flip(self::REQUIRED_CUISINE_KEYS), $data)) === count(self::REQUIRED_CUISINE_KEYS)) {
            return new CuisineDTO($data['id'], $data['name']);
        }
        throw new CuisineCannotBeParsedException();
    }

    /**
     * @throws SetMenuCannotBeParsedException
     */
    private function getSetMenuDTO(array $data): SetMenuDTO
    {
        if (count(array_intersect_key(array_flip(self::REQUIRED_SET_MENU_KEYS), $data)) === count(self::REQUIRED_SET_MENU_KEYS)) {
            return new SetMenuDTO(
                Carbon::parse($data["created_at"]),
                $data["name"],
                $data["description"],
                $data["display_text"],
                $data["image"],
                $data["thumbnail"],
                $data["is_vegan"],
                $data["is_vegetarian"],
                $data["status"],
                $data["price_per_person"],
                $data["min_spend"],
                $data["is_seated"],
                $data["is_standing"],
                $data["is_canape"],
                $data["is_mixed_dietary"],
                $data["is_meal_prep"],
                $data["is_halal"],
                $data["is_kosher"],
                $data["available"],
                $data["number_of_orders"]);
        }
        throw new SetMenuCannotBeParsedException();
    }

    public function retrieveData(?int $page = null): array
    {
        if (is_null($page)) {
            $page = self::$activePage;
        }

        return json_decode($this->setMenuApiService->fetchPaginatedData($page), true);
    }

    public function retrieveNextPage(): array
    {
        self::$activePage++;
        return $this->retrieveData(self::$activePage);
    }

    public function persistData(Collection $setMenus): void
    {
        $this->cuisineRepository->batchImport($setMenus);
        $this->setMenuRepository->batchImport($setMenus);
        $this->setMenuRepository->importCuisineRelations($setMenus);
    }

    public function setActivePage($page): void
    {
        self::$activePage = $page;
    }

    public function getActivePage(): int
    {
        return self::$activePage;
    }

}
