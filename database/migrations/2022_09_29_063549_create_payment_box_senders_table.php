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
        Schema::create('payment_box_senders', function (Blueprint $table) {
            $table->id();
            $table->string('api_status')->default(0);
            $table->text('status_details')->nullable();
            $table->string('trx_date')->nullable();
            $table->string('trx_time')->nullable();
            $table->string('agent_id_collect')->nullable();
            $table->string('agent_collect_name')->nullable();
            $table->string('type')->nullable();
            $table->string('agent_id_main')->nullable();
            $table->string('agent_name_main')->nullable();
            $table->string('office_id')->nullable();
            $table->string('trx_no')->nullable();
            $table->string('pin_no')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('customer_fullname')->nullable();
            $table->string('customer_first_name')->nullable();
            $table->string('customer_last_name')->nullable();
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_tel')->nullable();
            $table->string('customer_cell')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_mother_name')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('customer_id_issue_place')->nullable();
            $table->string('customer_gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('profession')->nullable();
            $table->string('agent_id_pay')->nullable();
            $table->string('agent_name_pay')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('beneficiary_country')->nullable();
            $table->string('customer_rate')->nullable();
            $table->string('agent_rate')->nullable();
            $table->string('payout_ccy')->nullable();
            $table->string('amount')->nullable();
            $table->string('payin_ccy')->nullable();
            $table->string('payin_amount')->nullable();
            $table->string('admin_charges')->nullable();
            $table->string('agent_charges')->nullable();
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
        Schema::dropIfExists('payment_box_senders');
    }
};
