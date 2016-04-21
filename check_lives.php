<?php
// 30 7 * * * php /home/saru/tools/check_lives.php

require_once "Mail.php";

function savacan_gmail($to, $title, $body, $header){
  $from = '<saruwatari2010@gmail.com>';

  $headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $title
  );

  $smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'xxxxx@gmail.com',
        'password' => 'xxxxx'
  ));

  $mail = $smtp->send($to, $headers, $body);

  if(PEAR::isError($mail)){
    echo('<p>' . $mail->getMessage() . '</p>');
  } else {
    echo('<p>Message successfully sent!</p>');
  }
}

function savacan_mail($body){
  mail("saru@inf.shizuoka.ac.jp", "[重要] エラー報告: $body", $body, "From: saru@aurum.cs.inf.shizuoka.ac.jp");
}

function savacan_ping($host)
{
  $cmd = sprintf('ping -c 1 -W 5 %s', escapeshellarg($host));
  $r = exec($cmd, $res, $rval);
  return $rval;
}

function savacan_connect($host, $port){
  $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
  socket_set_option($sock, SOL_SOCKET, SO_SNDTIMEO, array("sec"=>5, "usec"=>0) );
  return socket_connect($sock, $host, $port);
}

function savacan_disk()
{
  return disk_free_space("/") / 1000.0 / 1000.0 / 1000.0;
}

if(savacan_disk() < 40.0){
    savacan_mail("sarulabのディスク容量が残り40GBを切っています。");
}

if(savacan_ping("133.70.169.157") === 1){
  savacan_mail("aurumが落ちているようです。");
}

if(savacan_connect("202.228.252.200", xxxxx) === FALSE){
  savacan_mail("battleshipが落ちているようです。");
}

if(savacan_connect("133.70.169.129", xxxxx) === FALSE){
  savacan_mail("marmorが落ちているようです。");
}

?>
