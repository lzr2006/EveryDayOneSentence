<?php
include("config.php");
header("Content-Type:text/json;charset=utf-8");
if($pdo_type == "local")
{
  if($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    $stmt = $pdo_local->prepare("SELECT password FROM user WHERE email = :email");
    $is_select_ok = $stmt->execute([
      ":email"=>$GET['email'],
    ]);
    if($is_select_ok)
    {
      $result = $stmt->fetch(PDO::FETCH_ASSO);
      if($result)
      {
        echo json_encode(
          array(
                "code" => $result,
                "message"=>$result["password"]
          ));
      }
      else{
        echo json_encode(
          array(
                "code" => $result,
                "message"=>"密码错误"
          ));
  
      }
    }
    else{
      echo json_encode(
        array(
              "code" => $is_select_ok,
              "message"=>"数据库查询失败"
        ));
    }
  }
}
?>