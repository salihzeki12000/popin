<?php
/**
* 
*/
class PaypalVerification
{
    private  $firstName;
    private  $secondName;
    private  $email;
   public function paypal($firstName,$secondName,$email){
       // create a new cURL resource
    $ch = curl_init();
    $ppUserID = PAYPALUSERID; //Take it from   sandbox dashboard for test mode or take it from paypal.com account in production mode, help: https://developer.paypal.com/docs/classic/api/apiCredentials/
    $ppPass = PAYPALPASS; //Take it from sandbox dashboard for test mode or take it from paypal.com account in production mode, help: https://developer.paypal.com/docs/classic/api/apiCredentials/
    $ppSign = PAYPALSIGN; //Take it from sandbox dashboard for test mode or take it from paypal.com account in production mode, help: https://developer.paypal.com/docs/classic/api/apiCredentials/
    $ppAppID = PAYPALAPPID; //if it is sandbox then app id is always: APP-80W284485P519543T
    $sandboxEmail = SENDBOXEMAIL; //comment this line if you want to use it in production mode.It is just for sandbox mode
    //parameters of requests
    $nvpStr = 'emailAddress='.$email.'&firstName='.$firstName.'&lastName='.$secondName.'&matchCriteria=NAME';
    // RequestEnvelope fields
    $detailLevel    = urlencode("ReturnAll");   // See DetailLevelCode in the WSDL for valid enumerations
    $errorLanguage  = urlencode("en_US");       // This should be the standard RFC 3066 language identification tag, e.g., en_US
    $nvpreq = "requestEnvelope.errorLanguage=$errorLanguage&requestEnvelope.detailLevel=$detailLevel";
    $nvpreq .= "&$nvpStr";
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
    $headerArray = array(
    "X-PAYPAL-SECURITY-USERID:$ppUserID",
    "X-PAYPAL-SECURITY-PASSWORD:$ppPass",
    "X-PAYPAL-SECURITY-SIGNATURE:$ppSign",
    "X-PAYPAL-REQUEST-DATA-FORMAT:NV",
    "X-PAYPAL-RESPONSE-DATA-FORMAT:JSON",
    "X-PAYPAL-APPLICATION-ID:$ppAppID",
    "X-PAYPAL-SANDBOX-EMAIL-ADDRESS:$sandboxEmail" //comment this line in production mode. IT IS JUST FOR SANDBOX TEST 
    );
    $url="https://svcs.sandbox.paypal.com/AdaptiveAccounts/GetVerifiedStatus";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
    $paypalResponse = curl_exec($ch);
    //echo $paypalResponse;   //if you want to see whole PayPal response then uncomment it.
    curl_close($ch);
    $data = json_decode($paypalResponse);
    return $data;
  }
}