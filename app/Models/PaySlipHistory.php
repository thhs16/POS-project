<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaySlipHistory extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'phone','payslip_image','payment_method','order_code','order_amount'];

}
