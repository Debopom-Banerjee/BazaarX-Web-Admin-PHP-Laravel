<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Payment extends Model
{
    use HasFactory;

    public const STATUS_PENDING_GOFINX_APPROVAL = 0; 
    public const STATUS_APPROVED_BY_BazaarX = 1;
    public const STATUS_PAYMENT_TRANSFERRED = 2;
    public const STATUS_PAYMENT_CANCELLED = 3;

    // payment type
    public const TYPES_MILESTONE = 1;
    public const TYPES_REFERRAL_COMMISSION = 2;
    public const TYPES_REWARD = 3;
    public const TYPES_ONE_PERCENT_COMMISSION  = 4;

    protected $guarded = ['id'];
    public function getPrefix() {
        return "#PAY".str_replace('_1','','_'.(100000 +$this->id));
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

}
