<?php

namespace App\Http\Resources;

use App\Models\SetMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin SetMenu
 */
class SetMenusIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $numberOfGuests = $request->get("number_of_guests") ?: 1;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price_per_person * $numberOfGuests,
            "min_spend" => $this->min_spend,
            "thumbnail" => $this->thumbnail,
            "cuisines" => $this->cuisines->map(fn ($cuisine) => [
                "id" => $cuisine->id,
                "name" => $cuisine->name,
            ]),
        ];
    }
}
