<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_box_receivers', function (Blueprint $table) {
            $table->id();
            $table->string('payment_box_sender_id')->nullable();
            $table->string('beneficiary_full_name')->nullable();
            $table->string('beneficiary_first_name')->nullable();
            $table->string('beneficiary_last_name')->nullable();
            $table->string('receiver_address')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_email')->nullable();
            $table->string('receiver_dob')->nullable();
            $table->string('receiver_place_of_birth')->nullable();
            $table->string('bank_acc')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('purpose_category')->nullable();
            $table->string('purpose_comments')->nullable();
            $table->string('status')->nullable();
            $table->string('exported')->nullable();
            $table->string('main_hold')->nullable();
            $table->string('subdomain_hold')->nullable();
            $table->string('paid_date')->nullable();
            $table->string('paid_time')->nullable();
            $table->string('buyer_rate')->nullable();
            $table->string('sub_aget_rate')->nullable();
            $table->string('codice_fiscale')->nullable();
            $table->string('beneficiary_cnic')->nullable();
            $table->string('be_branch_name')->nullable();
            $table->string('be_branch_code')->nullable();
            $table->string('be_bank_name')->nullable();
            $table->string('total_trx')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('relationship')->nullable();
            $table->string('payment_s_method')->nullable();
            $table->string('payment_s_type')->nullable();
            $table->string('tmt_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_box_receivers');
    }
};
