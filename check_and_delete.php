<?php

$year = date("Y");
$month = date("m");
$day = date("d");

$files = array();
exec("ls -vd /home/saru/timelapse/*/*/*", $files);
//var_dump($files);

$i = 0;
while(true){
  $free_bytes = disk_free_space("/") / 1000.0 / 1000.0 / 1000.0;
  if($free_bytes > 40.0){
    break;
  }

  $file = $files[$i];
  exec("rm -rf $file");
  $i++;
  echo "delete $file\n";
  if($i >= count($files)){
    break;
  }
}

?>

