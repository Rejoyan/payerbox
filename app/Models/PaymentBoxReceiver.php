<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentBoxReceiver extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        
    "payment_box_sender_id",
    "beneficiary_full_name",
    "beneficiary_first_name",
    "beneficiary_last_name",
    "receiver_address",
    "receiver_city",
    "receiver_phone",
    "receiver_email",
    "receiver_dob",
    "receiver_place_of_birth",
    "bank_acc",
    "bank_name",
    "branch_name",
    "branch_code",
    "purpose_category",
    "purpose_comments",
    "status",
    "exported",
    "main_hold",
    "subdomain_hold",
    "paid_date",
    "paid_time",
    "buyer_rate",
    "sub_aget_rate",
    "codice_fiscale",
    "beneficiary_cnic",
    "be_branch_name",
    "be_branch_code",
    "be_bank_name",
    "total_trx",
    "total_amount",
    "relationship",
    "payment_s_method",
    "payment_s_type",
    "tmt_no",
    ];
}
