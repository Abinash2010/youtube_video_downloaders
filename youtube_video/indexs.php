<?php
include 'function.php';
$url = $_POST['url'];
$class=new y_v_d();
$code=$class->get_http_response_code($url);
$exist=$class->isExisturl($code);
if($exist)
{
  $type=$class->get_type($url);
  if($type['type']=='video')
  {
    $id=$class->getId($url);
    $class->getVideo($id);
  }
  else {
    echo 'you cant download this file..its not in video format';
  }

}
else {

    echo 'Your url doesnot exist';

}



 ?>
