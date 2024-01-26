<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Service;

class AffiliateItem extends Model
{
    protected $table = 'affiliate_items';
    protected $guarded = ['id'];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
