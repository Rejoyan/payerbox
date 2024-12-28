<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use App\Models\PaymentBoxSender;
use App\Models\PaymentBoxReceiver;
use SoapClient;

trait CybussolutionsApi {

    public $username_world_wide = 'world_wide';
    public $password_world_wide = 'xfer123';
    public $partner_id_world_wide = 'WORLDPAYOUT';
    public $url_world_wide = 'http://cp.cybussolutions.com/cybusTransService/CybusServiceServer.php?wsdl';

    public function getRateGenericOfCyb() {


        try {
            $client = new SoapClient($this->url, array('exceptions' => true, 'trace' => 1));


            $params = [
                "USER" => $this->username_world_wide,
                "PASSWORD" => $this->password_world_wide,
                "PARTNER_ID" => $this->partner_id_world_wide,
                'SENDING_CURRENCY' => 'GBP',
                'RECEIVING_CURENCY' => 'NGN',
                'SENDING_COUNTRY' => 'GB',
                'RECEIVING_COUNTRY' => 'NG',
                'AMOUNT' => '10',
                'TRANS_TYPE_ID' => '2'
            ];

            /*
             * $input_celsius = 36;
             

            $request_param = '<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getRateGenericRequest xmlns="https://www.w3schools.com/xml/">
      <Celsius>' . $input_celsius . '</Celsius>
    </getRateGenericRequest>
  </soap12:Body>
</soap12:Envelope>'; 

            $headers = array(
                'Content-Type: text/xml; charset=utf-8',
                'Content-Length: ' . strlen($request_param)
            );

            $ch = curl_init($this->url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $data = curl_exec($ch);

            $result = $data;
print_r($data);
            if ($result === FALSE) {
                printf("CURL error (#%d): %s<br>\n", curl_errno($ch), htmlspecialchars(curl_error($ch)));
            }

            curl_close($ch);

            echo $input_celsius . ' Celsius => ' . $data . ' Fahrenheit';
            exit;*/
            $response = $client->getRateGeneric($params);
            var_dump(($response));
            exit;
            /**
             *
              <xsd:element name="SENDING_CURRENCY" type="xsd:string"/>
              <xsd:element name="RECEIVING_CURENCY" type="xsd:string"/>
              <xsd:element name="SENDING_COUNTRY" type="xsd:string"/>
              <xsd:element name="RECEIVING_COUNTRY" type="xsd:string"/>
              <xsd:element name="AMOUNT" type="xsd:string"/>
              <xsd:element name="TRANS_TYPE_ID" type="xsd:string"/>
             */
//            if ($response->GetAgentListOfAccountsAndItsBranchesResult->Successful) {
//                $xml = simplexml_load_string($response->GetAgentListOfAccountsAndItsBranchesResult->dsAccountBranchList->any);
//                foreach ($xml->NewDataSet->Table as $data) {
//                    $this->BranchCode = (string) $data->BranchCode;
//                    $this->AccountName = (string) $data->AccountName;
//                    $this->AccountNumber = (string) $data->AccountNumber;
//                    $this->AccountType = (string) $data->AccountType;
//                    $this->AccountCurrencyCode = (string) $data->AccountCurrencyCode;
//                    $this->BranchName = (string) $data->BranchName;
//                    $this->BranchAddress = (string) $data->BranchAddress;
//                    $this->BranchType = (string) $data->BranchType;
//                    $this->APIBranch = (string) $data->APIBranch;
//                }
//            }
        } catch (\SoapFault $e) {
            return [1, $e->getMessage()];
        }
    }

    /*
     * 
      <xsd:all>
      <xsd:complexType name="sendTransGenericRequest">
      <xsd:element name="USER" type="xsd:string" />
      <xsd:element name="PASSWORD" type="xsd:string" />
      <xsd:element name="PARTNER_ID" type="xsd:string" />
      <xsd:element name="REFERENCE_CODE" type="xsd:string" />
      <xsd:element name="DATE" type="xsd:string" />
      <xsd:element name="TRANSSTATUS" type="xsd:string" />
      <xsd:element name="SENDING_CURRENCY" type="xsd:string" />
      <xsd:element name="RECEIVER_CURENCY" type="xsd:string" />
      <xsd:element name="RATE" type="xsd:string" />
      <xsd:element name="FEE" type="xsd:string" />
      <xsd:element name="LOCATION_ID" type="xsd:string" />
      <xsd:element name="PAYER_ID" type="xsd:string" />
      <xsd:element name="RECEIVING_AMOUNT" type="xsd:string" />
      <xsd:element name="SEND_AMOUNT" type="xsd:string" />
      <xsd:element name="SENDER_FIRST_NAME" type="xsd:string" />
      <xsd:element name="SENDER_LAST_NAME" type="xsd:string" />
      <xsd:element name="SENDER_OCCUPATION" type="xsd:string" />
      <xsd:element name="SENDER_ADDRESS" type="xsd:string" />
      <xsd:element name="SENDER_COUNTRY" type="xsd:string" />
      <xsd:element name="SENDER_MOBILE" type="xsd:string" />
      <xsd:element name="RECEIVER_TYPE" type="xsd:string" />
      <xsd:element name="COMPANYNAME" type="xsd:string" />
      <xsd:element name="RECEIVER_FIRST_NAME" type="xsd:string" />
      <xsd:element name="RECEIVER_LAST_NAME" type="xsd:string" />
      <xsd:element name="RECEIVER_PHONE_NUMBER" type="xsd:string" />
      <xsd:element name="LOCAL_AMOUNT" type="xsd:string" />
      <xsd:element name="RECEIVER_COUNTRY" type="xsd:string" />
      <xsd:element name="TRANSACTION_TYPE" type="xsd:string" />
      <xsd:element name="RECEIVER_CITY" type="xsd:string" />
      <xsd:element name="RECEIVER_ZIP" type="xsd:string" />
      <xsd:element name="RECEIVER_STATE" type="xsd:string" />
      <xsd:element name="RECEIVER_ADDRESS" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_NAME" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_SORT" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_CODE" type="xsd:string" />
      <xsd:element name="RECEIVER_BRANCH_CODE" type="xsd:string" />
      <xsd:element name="RECEIVER_BRANCH_ADDRESS" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_ACCOUNT_TITLE" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_ACCOUNT_NO" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_ACCOUNT_TYPE" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_ROUTING" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_SWIFT" type="xsd:string" />
      <xsd:element name="RECEIVER_BANK_IBAN" type="xsd:string" />
      <xsd:element name="TRANSACTION_PURPOSE" type="xsd:string" />
      <xsd:element name="TRANSACTION_DETAILS" type="xsd:string" />
      <xsd:element name="SECRET_QUESTION" type="xsd:string" />
      <xsd:element name="SECRET_ANSWER" type="xsd:string" />
      <xsd:element name="SENDER_ID_NUMBER" type="xsd:string" />
      <xsd:element name="SENDER_ID_ISSUE_DATE" type="xsd:string" />
      <xsd:element name="SENDER_ID_EXPIRY_DATE" type="xsd:string" />
      <xsd:element name="SENDER_DOB" type="xsd:string" />
      <xsd:element name="SENDER_POST_CODE" type="xsd:string" />
      <xsd:element name="SITE_LOCATION" type="xsd:string" />
      <xsd:element name="PAYING_PARTNER" type="xsd:string" />
      </xsd:all>
      2.2 sendTransGeneric Fields explanation:
     *      */
}
