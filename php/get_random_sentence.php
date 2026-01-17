<?php
header("Content-Type:application/json;charset=utf-8");
include("config.php");
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $sql="SELECT sentence FROM sentence WHERE is_passed_shenhe=1 ORDER BY RAND() LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $is_exe_ok = $stmt->execute();
    if($is_exe_ok)
    {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode(
            array(
                    "status" => true,
                    "message"=>"查询成功",
                    "data"=>$result["sentence"]
            ));
    }
    else
    {
    echo json_encode(
        array(
                "status" => false,
                "message"=>"查询失败"
        ));
    }
}
?>