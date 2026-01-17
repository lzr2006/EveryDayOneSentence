<?php
include("config.php");
header("Content-Type:text/json;charset=utf-8");
if($pdo_type == "local")
{
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $stmt = $pdo_local->prepare("INSERT INTO user VALUES(:email,:password) IF NOT EXISTS (SELECT email FROM user WHERE email = :email)");
    $result = $stmt->execute([
      ":email"=>$_POST['email'],
      ":password"=>password_hash($_POST['password'],PASSWORD_BCRYPT)
    ]);
    if($result==true)
    {
      echo json_encode(
        array(
              "code" => $result,
        ));
    }
    else{
      echo json_encode(
        array(
              "code" => $result,
        ));
    }
  }
}
?>