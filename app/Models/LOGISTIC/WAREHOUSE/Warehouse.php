<?php
namespace App\Models\LOGISTIC\WAREHOUSE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LOGISTIC\PRODUCT\Product;
class Warehouse extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $primaryKey = 'warehouse_id'; // Especifica el nombre correcto de la clave primaria
    protected $table = 'warehouse';
    protected $fillable = [
        'name_warehouse', 'location_warehouse', 'created_at', 'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'warehouse_product', 'warehouse_id');
    }
}
