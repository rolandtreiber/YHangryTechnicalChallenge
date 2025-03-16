<?php

namespace App\DTO;

use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 */
class CuisineDTO
{
    private int $id;
    private string $name;
    private string $slug;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = strtolower(str_replace(" ", "-", $name));
    }

    #[ArrayShape([
        "id" => "int",
        "name" => "string",
        "slug" => "string",
    ])]
    public function get(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

}
