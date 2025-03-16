<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @method static first()
 * @property Collection<Cuisine> $cuisines
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool $display_text
 * @property bool $image
 * @property bool $thumbnail
 * @property bool $isVegan
 * @property bool $is_vegetarian
 * @property bool $status
 * @property float $price_per_person
 * @property float $min_spend
 * @property bool $is_seated
 * @property bool $is_standing
 * @property bool $is_canape
 * @property bool $is_mixed_dietary
 * @property bool $is_meal_prep
 * @property bool $is_halal
 * @property bool $is_kosher
 * @property bool $available
 * @property int $number_of_orders
 * @property Carbon $created_at
 */
class SetMenu extends Model
{
    use HasFactory;

    protected $fillable = ["name", "name", "description", "display_text", "image", "thumbnail",
            "is_vegan", "is_vegetarian", "status", "price_per_person", "min_spend", "is_seated", "is_standing",
            "is_canape", "is_mixed_dietary", "is_meal_prep", "is_halal", "is_kosher", "available", "number_of_orders"];

    public function cuisines(): BelongsToMany
    {
        return $this->belongsToMany(Cuisine::class);
    }

}
