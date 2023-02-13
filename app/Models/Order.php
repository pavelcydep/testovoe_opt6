<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Order extends Model
{
    use HasFactory;
  
      /**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */

 protected $fillable = ['email','phone','addres','summa','count','data_order'];
public function products()
{
    return $this->belongsToMany(Product::class)->withPivot('count');

}
    
}
