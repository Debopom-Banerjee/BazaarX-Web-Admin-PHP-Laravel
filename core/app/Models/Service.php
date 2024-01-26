<?php
/**
 * Class Service
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

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $appends =['Sid'];
    protected $casts = [
        'permission' => 'array',
        'document' => 'array',
    ];

    public function orderItem(){
         return $this->hasMany(OrderItem::class,'item_id','id');
    }
    public function category(){
         return $this->belongsTo(Category::class);
    }

    public function getBannerAttribute($value){

        $img = !is_null($value) ? $value : 'https://ui-avatars.com/api/?name='.$this->title.'&background=random&v=' . rand(0, 999999);
        if(\Str::contains(request()->url(), 'api')){
          return asset($img);
        }
        return $img;
    }

    public function portfolio(){
        return $this->hasMany(Portfolio::class,'service_id','id');
    }


    //prefix add attribute
    public function getSidAttribute(){
        return '#'.getPrefixZeros($this->id);
    }


    public function getTitleAttribute($value){
        return  ucfirst($value);
    }

    public function orders(){
        return $this->hasMany(Order::class, 'type_id')->where('type', 'Service');
    }
  

    public function scopePublished($builder)
    {
        return $builder->where('is_publish', 1);
    }
}
