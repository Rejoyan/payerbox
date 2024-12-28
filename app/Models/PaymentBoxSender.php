<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentBoxSender extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "api_status",
    "trx_date",
    "trx_time",
    "agent_id_collect",
    "agent_collect_name",
    "type",
    "agent_id_main",
    "agent_name_main",
    "office_id",
    "trx_no",
    "pin_no",
    "customer_id",
    "customer_fullname",
    "customer_first_name",
    "customer_last_name",
    "house_no",
    "street",
    "city",
    "post_code",
    "customer_state",
    "customer_country",
    "customer_tel",
    "customer_cell",
    "customer_email",
    "customer_mother_name",
    "id_type",
    "id_number",
    "customer_id_issue_place",
    "customer_gender",
    "dob",
    "birth_place",
    "profession",
    "agent_id_pay",
    "agent_name_pay",
    "payment_method",
    "beneficiary_country",
    "customer_rate",
    "agent_rate",
    "payout_ccy",
    "amount",
    "payin_ccy",
    "payin_amount",
    "admin_charges",
    "agent_charges",'status_details'
    ];
    public function paymentBoxReceiver() {
        return $this->hasOne(PaymentBoxReceiver::class);
    }
    public function getStatus() {
        $status = 'UnPaid';
        if($this->api_status == 1){
        $status = 'Paid';    
        }
        return $status;
    }
     public function getStatusColor() {
        $status = 'bg-warning';
        if($this->api_status == 1){
        $status = 'bg-success';    
        }
        return $status;
    }
}
