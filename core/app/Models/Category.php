<?php
/**
 *
 * @category zStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $guarded = [];

    public function getIconAttribute($value)
    {
        $icon = is_null($value) ? 'https://ui-avatars.com/api/?name='.$this->name.'&background=random&v=' . rand(0, 999999) : $value;
        if (Str::contains(request()->url(), '/api/v1')) {
            return asset('storage/backend/category-icon/'.$value);
        }
        return $icon;
    }

    public function services()
    {
        return $this->hasMany(Service::class)->where('is_publish', 1);
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
