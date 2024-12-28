<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use App\Models\PaymentBoxSender;
use App\Models\PaymentBoxReceiver;
use SoapClient;

trait FastpayGME {

    use WorldwidesvcApi;

    private $FastpayGME_PartnerId = 'BRNNP15210';
    private $FastpayGME_UserName = 'WorldWideSendAPI';
    private $FastpayGME_Password = 'W0rldw1d3#1521';
    private $FastpayGME_SessionId = '';
    private $FastpayGME_ReceivingAgentId = '';
    private $FastpayGME_url = 'http://202.166.220.79:1002/sendwsapi/FastMoneyWebService.asmx?wsdl';

//    private $FastpayGME_url = 'http://202.166.220.79:1002/sendwsapi/FastMoneyWebService.asmx?wsdl';

    public function fastpayGMEGetStatus() {

        set_time_limit(300);
        try {

            $context = stream_context_create([
                'ssl' => [
                    // set some SSL/TLS specific options
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ]);
            $client = new SoapClient('http://202.166.220.79:1002/sendwsapi/FastMoneyWebService.asmx?wsdl', array("trace" => 1, "exception" => 0));

//            dd($client->__getFunctions());
            $params = [
                "PartnerId" => 'BRNNP15210',
                "UserName" => 'WorldWideSendAPI',
                "Password" => 'W0rldw1d3#1521',
                "PinNo" => 456,
                "SessionId" => time(),
            ];

            $response = $client->GetStatus($params);
            echo '<pre>';
            print_r($response->GetStatusResult);
            exit;
            if ($response->GetAgentListOfAccountsAndItsBranchesResult->Successful) {
                $xml = simplexml_load_string($response->GetAgentListOfAccountsAndItsBranchesResult->dsAccountBranchList->any);
                foreach ($xml->NewDataSet->Table as $data) {
                    $this->BranchCode = (string) $data->BranchCode;
                    $this->AccountName = (string) $data->AccountName;
                    $this->AccountNumber = (string) $data->AccountNumber;
                    $this->AccountType = (string) $data->AccountType;
                    $this->AccountCurrencyCode = (string) $data->AccountCurrencyCode;
                    $this->BranchName = (string) $data->BranchName;
                    $this->BranchAddress = (string) $data->BranchAddress;
                    $this->BranchType = (string) $data->BranchType;
                    $this->APIBranch = (string) $data->APIBranch;
                }
            }
        } catch (\SoapFault $e) {
            return [1, $e->getMessage()];
        }
//        dd($response);
    }

    public function fastpayGMECreateTrx($requestData) {
        $worldsideSercApidata = $this->GetTransactions();

        if (!empty($worldsideSercApidata)) {
            foreach ($worldsideSercApidata as $key => $worldsideData) {

                if ($requestData->payout_country == $worldsideData->beneficiary_country_name) {

                    $param = [
                        'sender_country' => $worldsideData->source_country_code, //'GHA',
                        'sending_currency' => $worldsideData->source_currency_code,
                        'CustomerName' => $worldsideData->remitter_full_name,
                        'CustomerAddress' => '',
                        'CustomerAddress' => '',
                        'CustomerContact' => '',
                        'CustomerCity' => '',
                        'CustomerCountry' => $worldsideData->source_country_name,
                        'CustomerIdType' => '',
                        'CustomerIdNumber' => '',
                        'BeneName' => $worldsideData->beneficiary_full_name,
                        'BeneAddress' => $worldsideData->beneficiary_address,
                        'BeneContact' => '',
                        'BeneCity' => $worldsideData->beneficiary_city,
                        'BeneCountry' => $worldsideData->beneficiary_country_name,
                        'Profession' => '',
                        'IncomeSource' => '',//required
                        'Relationship' => '',
                        'PurposeOfRemittance' => $worldsideData->sending_purpose,
                        'SendingAmout' => $worldsideData->payin_amount,
                        'ReceivingAmount' => $worldsideData->payout_amount,
                        'PaymentMethod' => 'B', // B for Bank , C for Cash
                        'BankCode' => $worldsideData->beneficiary_bank_branch_code,
                        'BankName' => $worldsideData->beneficiary_bank_name,
                        'BankBranchName' => $worldsideData->beneficiary_bank_branch_name,
                        'BankAccountNumber' => $worldsideData->beneficiary_bank_account_number,
                        'TransactionDate' => date('m-d-Y', strtotime($worldsideData->transaction_date)),
                        'CalculateBy' => 'C', /* C – Calculation by Sending
                          Currency and response total Payout
                          amount after Deducting service
                          charge
                          P – Calculation by Payout Amount
                          and response total collection amount
                          in Sending Currency including Service
                          Charge */
                        'FreeCharge' => '',
                    ];
//                 
                }

//dd($param);

                set_time_limit(300);
                try {

                    $context = stream_context_create([
                        'ssl' => [
                            // set some SSL/TLS specific options
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        ]
                    ]);
                    $client = new SoapClient('http://202.166.220.79:1002/sendwsapi/FastMoneyWebService.asmx?wsdl', array("trace" => 1, "exception" => 0));


                   $param = array_merge( [
                        "PartnerId" => $this->FastpayGME_PartnerId,
                        "UserName" => $this->FastpayGME_UserName,
                        "Password" => $this->FastpayGME_Password,
                        "SessionId" => time(),
                    ],$param);
                    
                    $response = $client->SendMoney($param);
                    echo '<pre>';
                    print_r($response);
                    exit;
                } catch (\SoapFault $e) {
                    return [1, $e->getMessage()];
                }
            }
            return [$success, 'Worlwide not response'];
        }
    }

}
