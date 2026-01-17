<?php
// 用于显示指定的句子
header("Content-Type:text/json;charset=utf-8");
include("config.php");
if($pdo_type == "local")
{
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $sql="SELECT sentence,user_id FROM sentence WHERE id=:id";
        $stmt = $pdo_local->prepare($sql);
        $is_exe_ok = $stmt->execute([
          ":id"=>$_GET['id'],
        ]);
        if($is_exe_ok)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(
                array(
                      "code" => $result,
                      "message"=>$result
                ));
        }
        else
        {
            echo json_encode(
                array(
                      "code" => $result,
                      "message"=>"查询失败"
                ));
        }
    }
}
?>