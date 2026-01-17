<?php
header("Content-Type:text/json;charset=utf-8");
include("config.php");
if($pdo_type == "local")
{
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if($_POST['action'] == "getAllSentence")
    {
      $sql = "SELECT sentence, email,created_at FROM sentence WHERE email=:email";
      $stmt = $pdo_local->prepare($sql);
      $stmt->execute([
        ":email"=>$_POST['email'],
      ]);
      $result = $stmt->fetchAll();
      echo json_encode(
        array(
              "code" => $result,
              "message"=>$result
        ));
    }
  else if($_POST['action'] == "update")
  {
    $sql = "UPDATE sentence SET stataus=:stataus WHERE email=:email";
    $stmt = $pdo_local->prepare($sql);
    $result = $stmt->execute([
      ":email"=>$_POST['email'],
      ":status"=>$_POST['status'],
    ]);
    echo json_encode(
    array(
          "code" => $result,
          "message"=>$result
    ));
  }
}
}
?>