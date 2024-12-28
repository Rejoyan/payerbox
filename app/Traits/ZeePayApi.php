<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use App\Models\PaymentBoxSender;
use App\Models\PaymentBoxReceiver;

trait ZeePayApi {

    use WorldwidesvcApi;

    private $zeepay_client_id = '200';
    private $zeepay_client_secret = 'ACFfI3oJdUlIzECv2DTFs0480nRv6xoT1vQE0yMv';
    private $zeepay_username = 'sampaio.marques@worldwidesvc.com';
    private $zeepay_password = 'Worldwide@123';
    private $zeepay_token = '';
    private $zeepay_grant_type = 'password';
    private $zeepay_url = 'https://test.digitaltermination.com/';
    private $zeepay_id_type = [
        1 => 'european ID',
        2 => 'foreign ID',
        3 => 'National insurance tax number (NIT)',
        4 => 'national ID',
        5 => 'passport'
    ];

    private function getZeePayOauthToken() {
        $param = [
            'grant_type' => $this->zeepay_grant_type,
            'username' => $this->zeepay_username,
            'password' => $this->zeepay_password,
            'client_secret' => $this->zeepay_client_secret,
            'client_id' => $this->zeepay_client_id,
        ];

        $response = Http::asForm()->post($this->zeepay_url . 'oauth/token', $param)->object();

        $this->zeepay_token = $response->access_token;
    }

    public function zeePayCreateTrx($requestData) {

        $worldsideSercApidata = $this->GetTransactions();
        $this->getZeePayOauthToken();
        $message = '';
        $success = 0;
        if (!empty($worldsideSercApidata)) {
            foreach ($worldsideSercApidata as $key => $worldsideData) {

                if ($requestData->payout_country == $worldsideData->beneficiary_country_name && $worldsideData->delivery_method == 'BANK') {

                    if ($worldsideData->destination_country_code == 'BRA') {

                        $param = $this->zeepayForBrazil($worldsideData);
                    } else if ($worldsideData->destination_country_code == 'COL') {

                        $param = $this->zeepayForColombia($worldsideData);
                    } else {
                        $param = [
                            'amount' => $worldsideData->payout_amount,
                            'send_amount' => $worldsideData->payin_amount,
                            'sender_country' => $worldsideData->source_country_code, //'GHA',
                            'sending_currency' => $worldsideData->source_currency_code,
                            'sender_first_name' => $worldsideData->remitter_first_name,
                            'sender_last_name' => $worldsideData->remitter_last_name,
                            'receiver_first_name' => $worldsideData->beneficiary_first_name,
                            'receiver_last_name' => $worldsideData->beneficiary_last_name,
                            'service_type' => 'bank',
                            'receiver_msisdn' => $worldsideData->beneficiary_phone,
                            'receiver_country' => $worldsideData->beneficiary_country_iso_code,
                            'receiver_currency' => $worldsideData->destination_currency_code,
                            'transaction_type' => 'cr',
                            'routing_number' => $worldsideData->beneficiary_bank_routing_number,
                            'account_number' => $worldsideData->beneficiary_bank_account_number,
                            'bank_branch' => $worldsideData->beneficiary_bank_branch_code,
                            'extr_id' => $worldsideData->reference_number,
                            'callback_url' => 'https://webhook.site/eb553e65-8c63-4918-90d4-bf28eaccfed6',
                            'bank_account_type' => 'C',
                            'receiver_id' => $worldsideData->receiver_id,
                            'cpf_code' => $worldsideData->cpf_code,
                            'receiver_id_type' => $worldsideData->receiver_id_type
                        ];
                    }

                    try {
                        $response = Http::withToken($this->zeepay_token)->asForm()
                                        ->post($this->zeepay_url . 'api/payouts', $param)->object();

                        
                        if ($response->code == 400) {
                            $message = 'Zeepay ' . $response->message . ' = ' . $worldsideData->reference_number;
                            break;
                        }
                        $success = 1;
                        $message = 'Zeepay Trx submited successfully';
                    } catch (Exception $e) {
                        $message = 'Zeepay ' . $e->getMessage();
                        break;
                    }
                }
                //return [$success, 'Zeepay please check country'];
            }
            return [$success, $message];
        }

        return [$success, 'Worlwide not response'];
    }

    private function zeepayForBrazil($worldsideData) {

        $param = [
            'amount' => $worldsideData->payout_amount,
            'send_amount' => $worldsideData->payin_amount,
            'sender_country' => $worldsideData->source_country_code, //'GHA',
            'sending_currency' => $worldsideData->source_currency_code,
            'sender_first_name' => $worldsideData->remitter_first_name,
            'sender_last_name' => $worldsideData->remitter_last_name,
            'receiver_first_name' => $worldsideData->beneficiary_first_name,
            'receiver_last_name' => $worldsideData->beneficiary_last_name,
            'service_type' => 'bank',
            'receiver_msisdn' => $worldsideData->beneficiary_phone,
            'receiver_country' => $worldsideData->beneficiary_country_iso_code,
            'receiver_currency' => $worldsideData->destination_currency_code,
            'transaction_type' => 'cr',
            'bank_name' => $worldsideData->beneficiary_bank_name,
            'routing_number' => $worldsideData->beneficiary_bank_routing_number,
            'account_number' => $worldsideData->beneficiary_bank_account_number,
            'bank_branch' => $worldsideData->beneficiary_bank_branch_code,
            'extr_id' => $worldsideData->reference_number,
            'callback_url' => 'https://webhook.site/eb553e65-8c63-4918-90d4-bf28eaccfed6',
            'bank_account_type' => 'C',
            'receiver_id' => $worldsideData->cpf_code,
            'cpf_code' => $worldsideData->cpf_code,
            'receiver_id_type' => in_array(strtoupper($worldsideData->receiver_id_type), array_map('strtoupper', $this->zeepay_id_type)) ? array_search(strtoupper($worldsideData->receiver_id_type), array_map('strtoupper', $this->zeepay_id_type)) : 5
        ];
        return $param;
    }

    private function zeepayForColombia($worldsideData) {

        $param = [
            'amount' => $worldsideData->payout_amount,
            'send_amount' => $worldsideData->payin_amount,
            'sender_country' => $worldsideData->source_country_code, //'GHA',
            'sending_currency' => $worldsideData->source_currency_code,
            'sender_first_name' => $worldsideData->remitter_first_name,
            'sender_last_name' => $worldsideData->remitter_last_name,
            'receiver_first_name' => $worldsideData->beneficiary_first_name,
            'receiver_last_name' => $worldsideData->beneficiary_last_name,
            'service_type' => 'bank',
            'receiver_msisdn' => $worldsideData->beneficiary_phone,
            'receiver_country' => $worldsideData->beneficiary_country_iso_code,
            'receiver_currency' => $worldsideData->destination_currency_code,
            'transaction_type' => 'cr',
            'bank_name' => $worldsideData->beneficiary_bank_name,
            'routing_number' => $worldsideData->beneficiary_bank_routing_number,
            'account_number' => $worldsideData->beneficiary_bank_account_number,
            'bank_branch' => $worldsideData->beneficiary_bank_branch_code,
            'extr_id' => $worldsideData->reference_number,
            'callback_url' => 'https://webhook.site/eb553e65-8c63-4918-90d4-bf28eaccfed6',
            'bank_account_type' => 'C',
            'receiver_id' => $worldsideData->receiver_id,
            'cpf_code' => $worldsideData->cpf_code,
            'tax_id' => $worldsideData->remitter_document_number,
//            'receiver_id_type' => 4
            'receiver_id_type' => in_array(strtoupper($worldsideData->receiver_id_type), array_map('strtoupper', $this->zeepay_id_type)) ? array_search(strtoupper($worldsideData->receiver_id_type), array_map('strtoupper', $this->zeepay_id_type)) : 5
        ];
        return $param;
    }

}
