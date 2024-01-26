<?php
/**
 * Class Order
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
use App\User;
use App\Models\CaseWorkstream;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    public const STATUS_INACTIVE = 0; // No Usecase found
    public const STATUS_ABOUT_TO_START = 1;
    public const STATUS_DOC_NEEDED = 2;
    public const STATUS_UNDER_APPROVAL = 3;
    public const STATUS_COMPLETED = 4;
    public const STATUS_CANCELLED = 5;
    public const STATUS_APPROVED = 6;

    // payment status
    public const PAYMENT_STATUS_UNPAID = 1;
    public const PAYMENT_STATUS_PAID = 2;
    public const PAYMENT_STATUS_REFUND_PROCESSING = 3;
    public const PAYMENT_STATUS_HOLD  = 4;
    public const PAYMENT_STATUS_REFUNDED = 5;

    

    protected $guarded = ['id'];
    protected $casts = [
        'permission' => 'object',
        'service_data'=>'array',
    ];
    protected $appends = [
        'case_workstream_id',
        'oid',
        'expected_delivery_at',
    ];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function item(){
        return $this->hasOne(OrderItem::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function partner(){
        return $this->belongsTo(User::class,'partner_id','id');
    }
    public function review(){
        return $this->belongsTo(Review::class,'id','type_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'type_id','id');
    }
    public function payment(){
        return $this->hasMany(Payment::class,'order_id','id');
    }
    public function getCaseWorkstreamIdAttribute(){
        $chk = CaseWorkstream::where('case_id',$this->id)->first();
        if($chk){
            return $chk->id;
        }else{
            return null;
        }
    }

    //prefix add attribute
    public function getOidAttribute(){
        return '#'.getPrefixZeros($this->id);
    }
    public function getExpectedDeliveryAtAttribute(){
        if(!empty($this->service) && !empty($this->service->service_duration))
         return \Carbon\Carbon::parse($this->order_date)->addDays($this->service->service_duration);
        else
        return \Carbon\Carbon::parse($this->order_date);
    }

     public function case_workstream()
    {
        return $this->hasOne(CaseWorkstream::class, 'case_id');
    }
    public function getPrefix() {
        return "#ODR".str_replace('_1','','_'.(100000 +$this->id));
    }
}
