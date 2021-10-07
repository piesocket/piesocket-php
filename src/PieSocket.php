<?php
namespace PieSocket;

if(!class_exists("Firebase\JWT\JWT")){
  require "./vendor/autoload.php";
}


use Firebase\JWT\JWT;

class PieSocket{

  public $config;

  public function __construct($config){
    $this->config = $config;
  }

  public function generateAuthToken($channel, $userData=null){

    $payload = array(
      "iss" => "piesocket-php",
      "sub" => $channel,
      "user" => $userData,
      "iat" => time(),
      "exp" => strtotime('+1 day')
    );

    $jwt = JWT::encode($payload, $this->config['api_secret']);
    return $jwt;
  }

  public function publish($channel, $payload = []){
    $curl = curl_init();

    $post_fields = [
      "key" => $this->config['api_key'],
      "secret" => $this->config['api_secret'],
      "channelId" => $channel,
      "message" => $payload
    ];

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://".$this->config['cluster_id'].".piesocket.com/api/publish",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($post_fields),
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    return $response;
  }

}
?>