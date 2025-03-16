<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cuisine extends Model
{
    protected $fillable = ["name", "id", "slug"];

    public function setMenus(): BelongsToMany
    {
        return $this->belongsToMany(SetMenu::class);
    }

}
