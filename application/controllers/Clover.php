<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clover extends Public_Controller
{
  public $class_name='';

  function __construct()
  {
    parent::__construct();
      $this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
  }
  public function webhook()
  {
    $ddd = json_encode($_REQUEST);
    $sql = "INSERT INTO settings(plain_key,plain_value) VALUES ('webhook_verification_code','".$ddd."'); ";
    if (!$this->db->query($sql)) {
        echo "FALSE";
    }
    else {
        echo "TRUE";
    }
    echo $this->db->last_query();
    die;
  }
  public function cardPaymentRequest()
  {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://token-sandbox.dev.clover.com/v1/tokens",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"card\":{\"number\":\"4242424242424242\",\"exp_month\":\"12\",\"exp_year\":\"24\",\"cvv\":\"123\"}}",
      CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Content-Type: application/json",
        "apikey: 754047514a95173d542cec08707635f3"
      ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      return  "cURL Error #:" . $err;
    } else {
      return $response;
    }
  }
  public function paymentRequest()
  {
    $source = json_decode($this->cardPaymentRequest());
    $source = $source->id;
    $curl = curl_init();
    $token = 'caf7e973-b40c-2e43-1c63-0d75faa714fa';
    $d = [
      'amount'=>10,
      'currency'=>'cad',
      'capture'=>'true',
      'description'=>'ddddddd',
      'external_reference_id'=>1234,
      'receipt_email'=>'devouttest@gmail.com',
      'source'=>$source
    ];
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://scl-sandbox.dev.clover.com/v1/charges",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($d),
      CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Authorization: Bearer ".$token,
        "Content-Type: application/json"
      ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }
}
