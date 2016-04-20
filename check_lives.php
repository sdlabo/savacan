<?php

function savacan_mail($body){
  mail("saru@inf.shizuoka.ac.jp", "[重要] エラー報告 from Life Checker", $body, "From: saru@aurum.cs.inf.shizuoka.ac.jp");
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
  return socket_connect($sock, "202.228.252.200", 10022);
}

function savacan_disk()
{
  return disk_free_space("/") / 1000.0 / 1000.0 / 1000.0;
}

if(savacan_disk() > 40.0){
    savacan_mail("sarulabのディスク容量が残り40GBを切っています。");
}

if(savacan_ping("133.70.169.157") === 0){
  savacan_mail("aurumが落ちているようです。");
}

if(savacan_connect("202.228.252.200", 10022) === TRUE){
  savacan_mail("battleshipが落ちているようです。");
}


?>