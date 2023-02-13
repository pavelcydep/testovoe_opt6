<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */

public function orders()
{

    return $this->belongsToMany(Product::class)->withPivot('count');
}
}
