<?php
require 'ClassConnectRestApi.php';
 error_reporting(E_ERROR | E_WARNING | E_PARSE | E_ALL); 
 ini_set("memory_limit", "1000M");

/**
 * index.php
 * Testowe Api dla Początkujących do celów testowych
 * @author Adam Berger
 */
try {
          $url = "https://gorest.co.in/public-api/users";
       // $url = "https://gorest.co.in/public-api/users/1512";
       // $url = "http://localhost/ConnectApi/test.php";
        
        $api = new ClassConnectRestApi($url); 
     
     $api->protokol = "http";
     $api->method   = "GET";
     /* "Content-Type:application/json" // Jeżeli deklarujemy jonson to content musi być jonson,
     *  a jeżeli tablice to x-www-form-urlencoded
     */
     $api->header = "Content-type: application/x-www-form-urlencoded\r\n";
     $api->tmeOut = 120;
     // "content" => '{"name":"Tenali Ramakrishna", "gender":"Male", "email":"tenali@15ce.com", "status":"Active"}',
     $api->content = ["page"=>"71"];
     /*
     $api->protokol ="http";
     $api->method = "POST";
     $api->header = "Content-type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer twoj token dostepu";
               //. "Content-Length: " . strlen($query_data) . "\r\n",
     $api->tmeOut = 120;
     $api->content = ["name"=>"Adas", "gender"=>"Male", "email"=>"adas@o2.pl", "status"=>"Active"];
     */
     
    /* PUT
     $api->protokol ="http";
     $api->method = "PUT";
     $api->header = "Content-type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer twoj token dostepu";
     $api->tmeOut = 120;
     $api->content = ["email"=>"adas@o2.pl"];
     */
    
     /* DELETE
     $api->protokol ="http";
     $api->method = "DELETE";
     $api->header = "Content-type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer twoj token dostepu";
     $api->tmeOut = 120;
     $api->content = ["email"=>"adas@o2.pl"];
     */

        $dec = json_decode($api->apiViewAll());
         // echo $dec->{"code"};
           // GET
       if($dec->{"code"} == "200" ||
          // POST, PUT
         $dec->{"code"} == "201" ||
          // DELETE
         $dec->{"code"} == "204"){
         echo "Połączenie udane GET, POST, PUT, DELETE";
       }else{
           echo $dec->{"code"}." Błąd połączenia";
       }
       // print_r($dec->{"meta"}->{"pagination"}->{"pages"});
          if($dec->{"code"} == "401"){
             echo $dec->{"data"}->{"message"};
          }
             print_r($dec->{"data"});

} catch (Exception $exc) {
    echo $exc->getTraceAsString()."<br>";
    echo $exc->getMessage();
}
