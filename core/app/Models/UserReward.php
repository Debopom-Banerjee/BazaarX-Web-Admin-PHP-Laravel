<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReward extends Model
{
    use HasFactory;
    public const STATUS_ACTIVE = 1;

    protected $guarded = ['id'];

    public function model()
    {
        return $this->type::where('id', $this->type_id)->first();
    }
    public function code()
    {
        return $this->belongsTo(Code::class,'type_id');
    }
}
