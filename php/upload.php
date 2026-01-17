<?php
header("Content-Type:text/json;charset=utf-8");
include("auto_login_db.php");
if($pdo_type == "local")
{
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $sql = "INSERT INTO sentence VALUES(NULL,'$email','$sentence',NULL,NULL)";
    $stmt = $pdo_local->prepare($sql);
    $stmt->execute([
      ":email"=>$_POST['email'],
      ":sentence"=>$_POST['sentence']
    ]);
    $result = $pdo_local->fetchResult();
    if($result==true)
    {
      echo json_encode(
        array(
              "code" => $result,
              "message"=>"投稿成功"
        ));
    }
    else{
      echo json_encode(
        array(
              "code" => $result,
              "message"=>"投稿失败"
        )
      )
    }
  }
}
 ?>
