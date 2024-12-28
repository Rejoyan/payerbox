<?php

namespace App\Imports;

use App\Models\PaymentBoxSender;
use App\Models\PaymentBoxReceiver;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel {

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        $senderdata = [
//            "id" => $row[0],
//            "api_status" => $row[1],
            "trx_date" => $row[0],
            "trx_time" => $row[1],
            "agent_id_collect" => $row[2],
            "agent_collect_name" => $row[3],
            "type" => $row[4],
            "agent_id_main" => $row[5],
            "agent_name_main" => $row[6],
            "office_id" => $row[7],
            "trx_no" => $row[8],
            "pin_no" => $row[9],
            "customer_id" => $row[10],
            "customer_fullname" => $row[11],
            "customer_first_name" => $row[12],
            "customer_last_name" => $row[13],
            "house_no" => $row[14],
            "street" => $row[15],
            "city" => $row[16],
            "post_code" => $row[17],
            "customer_state" => $row[18],
            "customer_country" => $row[19],
            "customer_tel" => $row[20],
            "customer_cell" => $row[21],
            "customer_email" => $row[22],
            "customer_mother_name" => $row[23],
            "id_type" => $row[24],
            "id_number" => $row[25],
            "customer_id_issue_place" => $row[26],
            "customer_gender" => $row[27],
            "dob" => $row[29],
            "birth_place" => $row[29],
            "profession" => $row[30],
            "agent_id_pay" => $row[31],
            "agent_name_pay" => $row[32],
            "payment_method" => $row[33],
            "beneficiary_country" => $row[34],
            "customer_rate" => $row[35],
            "agent_rate" => $row[36],
            "payout_ccy" => $row[37],
            "amount" => $row[38],
            "payin_ccy" => $row[39],
            "payin_amount" => $row[40],
            "admin_charges" => $row[41],
            "agent_charges" => $row[42],
        ];
        $receiverData = [
            "beneficiary_full_name" => $row[43],
            "beneficiary_first_name" => $row[44],
            "beneficiary_last_name" => $row[45],
            "receiver_address" => $row[46],
            "receiver_city" => $row[47],
            "receiver_phone" => $row[48],
            "receiver_email" => $row[49],
            "receiver_dob" => $row[50],
            "receiver_place_of_birth" => $row[51],
            "bank_acc" => $row[52],
            "bank_name" => $row[53],
            "branch_name" => $row[54],
            "branch_code" => $row[55],
            "purpose_category" => $row[56],
            "purpose_comments" => $row[57],
            "status" => $row[58],
            "exported" => $row[59],
            "main_hold" => $row[60],
            "subdomain_hold" => $row[61],
            "paid_date" => $row[62],
            "paid_time" => $row[63],
            "buyer_rate" => $row[64],
            "sub_aget_rate" => $row[65],
            "codice_fiscale" => $row[66],
            "beneficiary_cnic" => $row[67],
            "be_branch_name" => $row[68],
            "be_branch_code" => $row[69],
            "be_bank_name" => $row[70],
            "total_trx" => $row[71],
            "total_amount" => $row[72],
            "relationship" => $row[73],
            "payment_s_method" => $row[74],
            "payment_s_type" => isset($row[75])? $row[75] :'',
            "tmt_no" => isset($row[76])?$row[76]:'',
        ];
        $this->senderData($senderdata, $receiverData);
        return;
    }

    private function senderData($senderdata, $receiverData) {

        $sender = PaymentBoxSender::create($senderdata);
        $receiverData['payment_box_sender_id'] = $sender->id;
        $this->receiverData($receiverData);
    }

    private function receiverData($receiverData) {
        PaymentBoxReceiver::create($receiverData);
        
    }

}
