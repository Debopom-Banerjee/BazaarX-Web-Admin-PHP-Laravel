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
use App\User;
use Illuminate\Support\Str;


class Transaction extends Model
{
    use HasFactory;
    // protected $guarded = [id];
    protected $casts = [
        'txn' => 'array'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
