<?php
// 用于显示指定的句子
header("Content-Type:text/json;charset=utf-8");
include("../config.php");
if($pdo_type == "local")
{
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $sql="SELECT sentence FROM sentence WHERE id=:id";
        $stmt = $pdo_local->prepare($sql);
        $stmt->execute([
          ":id"=>$_GET['id'],
        ]);
        $result = $stmt->fetchAssoc();
        echo json_encode(
            array(
                  "code" => $result,
                  "message"=>$result["sentence"]
            ));
    }
}
?>