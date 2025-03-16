<?php

namespace App\DTO;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @param Carbon $createdAt
 * @param Collection<CuisineDTO> $cuisines
 * @param string $name
 * @param string|null $description
 * @param bool $displayText
 * @param bool $image
 * @param bool $thumbnail
 * @param bool $isVegan
 * @param bool $isVegetarian
 * @param bool $status
 * @param float $pricePerPerson
 * @param float $minSpend
 * @param bool $isSeated
 * @param bool $isStanding
 * @param bool $isCanape
 * @param bool $isMixedDietary
 * @param bool $isMealPrep
 * @param bool $isHalal
 * @param bool $isKosher
 * @param bool $available
 * @param int $numberOfOrders
 */
class SetMenuDTO
{
    private Carbon $createdAt;
    private Collection $cuisines;
    private string $name;
    private string|null $description;
    private bool $displayText;
    private string $image;
    private string $thumbnail;
    private bool $isVegan;
    private bool $isVegetarian;
    private bool $status;
    private float $pricePerPerson;
    private float $minSpend;
    private bool $isSeated;
    private bool $isStanding;
    private bool $isCanape;
    private bool $isMixedDietary;
    private bool $isMealPrep;
    private bool $isHalal;
    private bool $isKosher;
    private bool $available;
    private int $numberOfOrders;

    public function __construct(Carbon $createdAt, string $name, ?string $description, bool $displayText, string $image, string $thumbnail, bool|null $isVegan, bool|null $isVegetarian, bool $status, float $pricePerPerson, float $minSpend, bool $isSeated, bool|null $isStanding, bool|null $isCanape, bool|null $isMixedDietary, bool|null $isMealPrep, bool|null $isHalal, bool|null $isKosher, bool|null $available, int $numberOfOrders)
    {
        $this->createdAt = $createdAt;
        $this->name = $name;
        $this->description = $description;
        $this->displayText = $displayText;
        $this->image = $image;
        $this->thumbnail = $thumbnail;
        $this->isVegan = $isVegan;
        $this->isVegetarian = $isVegetarian != null ? $isVegetarian : false;;
        $this->status = $status;
        $this->pricePerPerson = $pricePerPerson;
        $this->minSpend = $minSpend;
        $this->isSeated = $isSeated != null ? $isSeated : false;
        $this->isStanding = $isStanding != null ? $isStanding : false;
        $this->isCanape = $isCanape != null ? $isCanape : false;
        $this->isMixedDietary = $isMixedDietary != null ? $isMixedDietary : false;
        $this->isMealPrep = $isMealPrep != null ? $isMealPrep : false;
        $this->isHalal = $isHalal != null ? $isHalal : false;
        $this->isKosher = $isKosher != null ? $isKosher : false;
        $this->available = $available != null ? $available : false;;
        $this->numberOfOrders = $numberOfOrders;
    }

    #[ArrayShape([
        'created_at' => 'string',
        'cuisines' => 'array',
        'name' => 'string',
        'description' => 'string',
        'display_text' => 'bool',
        'image' => 'string',
        'thumbnail' => 'string',
        'is_vegan' => 'bool',
        'is_vegetarian' => 'bool',
        'status' => 'string',
        'price_per_person' => 'float',
        'min_spend' => 'float',
        'is_seated' => 'bool',
        'is_standing' => 'bool',
        'is_canape' => 'bool',
        'is_mixed_dietary' => 'bool',
        'is_meal_prep' => 'bool',
        'is_halal' => 'bool',
        'is_kosher' => 'bool',
        'available' => 'bool',
        'number_of_orders' => 'int'
    ])]
    public function get(): array
    {
        return [
            'created_at' => $this->createdAt,
            'name' => $this->name,
            'description' => $this->description,
            'display_text' => $this->displayText,
            'image' => $this->image,
            'thumbnail' => $this->thumbnail,
            'is_vegan' => $this->isVegan,
            'is_vegetarian' => $this->isVegetarian,
            'status' => $this->status,
            'price_per_person' => $this->pricePerPerson,
            'min_spend' => $this->minSpend,
            'is_seated' => $this->isSeated,
            'is_standing' => $this->isStanding,
            'is_canape' => $this->isCanape,
            'is_mixed_dietary' => $this->isMixedDietary,
            'is_meal_prep' => $this->isMealPrep,
            'is_halal' => $this->isHalal,
            'is_kosher' => $this->isKosher,
            'available' => $this->available,
            'number_of_orders' => $this->numberOfOrders
        ];
    }

    public function setCuisines(Collection $cuisines): void
    {
        $this->cuisines = $cuisines;
    }

    public function getCuisines(): Collection
    {
        return $this->cuisines;
    }

}
