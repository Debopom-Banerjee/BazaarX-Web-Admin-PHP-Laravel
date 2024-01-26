<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;
    protected $table = 'bank_details';
    protected $guarded = ['id'];
    public function getPrefix() {
        return "#UB".str_replace('_1','','_'.(100000 +$this->id));
    }
}
