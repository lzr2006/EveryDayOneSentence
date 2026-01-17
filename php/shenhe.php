<?php
header("Content-Type:application/json;charset=utf-8");
include("config.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if($_POST['action'] == "update")
  {
    $sql = "UPDATE sentence SET is_passed_shenhe=:is_passed_shenhe WHERE id=:sentence_id";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
      ":is_passed_shenhe"=> $_POST['is_passed'],
      ":sentence_id"=> $_POST['sentence_id']
    ]);
    if($result)
    {
      echo json_encode(
        array(
              "status" => true,
              "message"=> "更新成功",
        ));
    }
    else{
      echo json_encode(
        array(
              "status" => false,
              "message"=> "更新失败",
        ));
    }
  }
}
else if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  if($_GET["action"] == "getNext")
  {
    $sql = "SELECT sentence,id FROM sentence WHERE is_passed_shenhe=0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result)
    {
      echo json_encode(
        array(
              "status" => true,
              "message"=> "获取成功",
              "data"=> $result
        ));
    }
    else{
      echo json_encode(
        array(
              "status" => false,
              "message"=> "获取失败",
        ));
    }
  }
}
?>