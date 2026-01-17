<?php
include("config.php");
header("Content-Type:application/json;charset=utf-8");
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  $stmt = $pdo->prepare("SELECT password FROM user WHERE email = :email");
  $is_select_ok = $stmt->execute([
    ":email"=>$_GET['email'],
  ]);
  if($is_select_ok)
  {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_GET['password'],$result["password"]))
    {
      echo json_encode(
        array(
              "status" => true,
              "message"=>"登录成功"
        ));
    }
    else{
      echo json_encode(
        array(
              "status" => false,
              "message"=>"密码错误"
        ));
    }
  }
  else{
    echo json_encode(
      array(
            "status" => false,
            "message"=>"数据库查询失败"
      ));
  }
}
?>