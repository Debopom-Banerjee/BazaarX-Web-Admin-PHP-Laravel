<?php
/**
 * Class Media
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

class Media extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = ['id'];
    protected $table = 'medias';

    public function getPathAttribute($value)
    {
        if(!request()->routeIs('panel.services.edit')){
            $path = asset('storage/files/'.$value);
        }else{
            $path = asset($value);
        }
        return $path;
    }
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
