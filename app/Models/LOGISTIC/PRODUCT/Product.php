<?php

namespace App\Models\LOGISTIC\PRODUCT;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LOGISTIC\WAREHOUSE\Warehouse;

class Product extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $primaryKey = 'product_id';
    protected $table = 'product';
    protected $fillable = [
        'code_product',
        'name_product',
        'stock_product',
        'warehouse_product',
        'goods_type_product',
        'category_product',
        'unit_product',
        'price_product',
        'created_at',
        'updated_at',
        'proof_image' // Añadir el campo proof_image
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_product', 'warehouse_id');
    }


}
