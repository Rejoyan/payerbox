<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use App\Models\PaymentBoxSender;
use App\Models\PaymentBoxReceiver;
trait WorldwidesvcApi {

/*    
    private $secret_key = '6ca8c12f-2eb9-42cd-a99a-b6378a4d9611';
    private $username = 'uat_ragent_connect';
    private $password = '@20_21!teSt';
    private $token = '';
    private $url = 'https://services.worldwidesvc.co.uk/ra/v1/';
*/
    private $secret_key = 'a56d35f7-711c-41a9-baa7-74dd34b48b7f';
    private $username = 'flex_fx_connect';
    private $password = '5^No%Q}a6:)D7F7';
    private $token = '';
    private $url = 'https://services.worldwidesvc.co.uk/ra/v1/';

    private function ApiCredentials(): array {
        $param = [
            'secret_key' => $this->secret_key,
            'username' => $this->username,
            'password' => $this->password
        ];
        return $param;
    }

    private function GetToken() {

        $response = Http::post($this->url . 'token', $this->ApiCredentials())->object();
        $this->token = $response->data->token;
    }

    public function GetTransactions() {
        $this->GetToken();
        $param['secret_key'] = $this->secret_key;
        $response = Http::withToken($this->token)
                ->post($this->url . 'gettransactions', $param)->object();
        
        if($response->result->Rflag == 1){
        return  $response->data;  
        }
        return [];
        
    }
    
    public function ConfirmTransactions($transaction) {
        $this->GetToken();
       
        $apiTraxes = $this->GetTransactions();
        
        $data = 'Successfully Submit';
        $success = false;
        foreach($apiTraxes as $apiTrax){
        $param['secret_key'] = $this->secret_key;
        $param['reference_number'] = 'ssss';// $apiTrax->reference_number;
        $response = Http::withToken($this->token)
                ->post($this->url . 'confirmtransactions', $param)->object();        
                if($response->result->Rflag == 1){
                    $res = $response->data;
                    $sender =[];            
                    $sender['pin_no']=$apiTrax->reference_number;
                    $sender['trx_no']=$apiTrax->transaction_id;
                    //$sender[]="status": "Ok",
                    $sender['status']=1;
                    $sender['status_details']=$res->status_details;
                    $sender['trx_date']=$apiTrax->transaction_date;
                    $sender['payment_method']=$apiTrax->delivery_method;
                    $sender['payout_ccy']=$apiTrax->payout_currency_code;
                    $sender['amount']=$apiTrax->payout_amount;
                    //$sender[' purpose_comments ']=$apiTrax->sending_purpose;
                    $sender['customer_fullname']=$apiTrax->remitter_full_name;
                    $sender['customer_cell']=$apiTrax->remitter_phone;
                    $sender['customer_country']=$apiTrax->remitter_nationality;
                    $sender['dob']=$apiTrax->remitter_date_of_birth;
                    $sender['id_type']=$apiTrax->remitter_document_type;
                    $sender['id_number']=$apiTrax->remitter_document_number;
                   // $sender[]=$apiTrax->remitter_document_issue_date;
                    //$sender[]=$apiTrax->remitter_document_expire_date;                    

                   $senderSave =  PaymentBoxSender::create();
                   $receiver = [];
                   $receiver[' payment_box_sender_id ']=$senderSave->id;
                   $receiver[' purpose_comments ']=$apiTrax->sending_purpose;
                   $receiver['beneficiary_full_name']=$apiTrax->beneficiary_full_name;
                   $receiver['receiver_phone'] =$apiTrax->beneficiary_phone;
                   $receiver['receiver_address'] =$apiTrax->beneficiary_address;
                   $receiver['receiver_city'] =$apiTrax->beneficiary_city;
                   //$receiver[] =$apiTrax->beneficiary_country_iso_code;
                   //$receiver[] =$apiTrax->beneficiary_bank_account_title;
                   $receiver['bank_acc'] =$apiTrax->beneficiary_bank_account_number;
                   //$receiver[] =$apiTrax->beneficiary_bank_iban_number;
                   //$receiver[] =$apiTrax->beneficiary_bank_routing_number;
                   $receiver['bank_name'] =$apiTrax->beneficiary_bank_name;
                   //$receiver[] =$apiTrax->beneficiary_bank_code;
                   $receiver['branch_name'] =$apiTrax->beneficiary_bank_branch_name;
                   $receiver['branch_code'] =$apiTrax->beneficiary_bank_branch_code;
                   PaymentBoxReceiver::create($receiver); 
            }else{
                $data = 'This Trx Faild to push';
            break;
            }
        }
        return ['success'=>$success,'data'=>$data];
    }
    
    public function GetSinglTransaction($ref_no) {
        $data = '';
        $this->GetToken();
        $param['secret_key'] = $this->secret_key;
        $param['reference_number'] = $ref_no;
        $response = Http::withToken($this->token)
                ->post($this->url . 'gettransactiondetails', $param)->object();
        
        if($response->result->Rflag == 1){
        return  $response->data;    
        }
        return $data;
    }

}
