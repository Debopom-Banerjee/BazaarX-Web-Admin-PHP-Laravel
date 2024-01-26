<?php
/**
 * Class Requirement
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = ['id'];
    protected $casts = [
        'customer_info'=>'array',
    ];



    public const STATUS_HOT = 0;
    public const STATUS_WARM = 1;
    public const STATUS_COlD = 2;

    public const STATUSES = [
        "0" => ['label' =>'Hot','color' => 'warning'],
        "1" => ['label' =>'Warm','color' => 'info'],
        "2" => ['label' =>'Cold','color' => 'secondary'],
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orders(){
        return $this->hasMany(Order::class,'type_id','id')->whereType('Lead');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subCategory(){
        return $this->belongsTo(Category::class);
    }
    public function getBudget(){
        return $this->belongsTo(Category::class,'budget','id');
    }
   
}
