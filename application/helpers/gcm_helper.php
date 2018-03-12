<?php

function gcm($isi,$judul) {

  $msg = array(
    'body' =>$isi ,
    'title'=>$judul,
    'icon' =>'myicon',
    'sound'=>'mySound'
  );

  $fields = array
  (
    'to'  => '/topics/zona',
    'notification' => $msg
  );

  $headers = array(
  'Authorization: key=AAAAIoCQPMM:APA91bFiGIA-QEvGBmRdOM1zMZ4F9UOXbtNGM52REh7gnj7m2tqdfqCHnacfNhOHHZEbFhC2GjEdFwOO7RhqxrpgioI97Hzbgeuq8n6l_XeHhX18AMsl_aLIyWqtAxrM5FdTXZrPfbs5', // FIREBASE_API_KEY_FOR_ANDROID_NOTIFICATION
  'Content-Type: application/json'
  );

  // Open connection
  $ch = curl_init();

  // Set the url, number of POST vars, POST data
  curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
  curl_setopt( $ch,CURLOPT_POST, true );
  curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
  curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

  // Disabling SSL Certificate support temporarly
  curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
  curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

  // Execute post
  $result = curl_exec($ch );
  if($result === false){
  die('Curl failed:' .curl_errno($ch));
  }

  // Close connection
  curl_close( $ch );
  return $result;

}

?>
