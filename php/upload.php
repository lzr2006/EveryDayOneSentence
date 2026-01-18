<?php
header("Content-Type: application/json; charset=utf-8");
include("config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $email = $_POST["email"];
        $sentence = $_POST["sentence"];
        $action = $_POST["action"];
        
        // 首先检查用户是否存在
        $stmt = $pdo->prepare("SELECT id FROM user WHERE email = :email");
        $stmt->execute([":email" => $email]);
        $result_uid = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result_uid) {
            echo json_encode([
                "status" => false,
                "message" => "用户不存在: " . $email
            ]);
            exit;
        }
        
        $uid = $result_uid["id"];
        
        // 修复：不要包含 id 字段，让其自动递增；不要设置时间字段为 NULL
        if($action == "upload")
        {
            $sql = "INSERT INTO sentence (user_id, sentence, is_passed_shenhe) VALUES (:user_id, :sentence, :is_passed_shenhe)";
            $stmt = $pdo->prepare($sql);
            $is_exe_ok = $stmt->execute([
                ":user_id" => $uid,
                ":sentence" => $sentence,
                ":is_passed_shenhe" => 0
            ]);
            
            if($is_exe_ok) {
                echo json_encode([
                    "status" => true,
                    "message" => "投稿成功"
                ]);
            } else {
                $error_info = $stmt->errorInfo();
                echo json_encode([
                    "status" => false,
                    "message" => "投稿失败",
                    "error" => $error_info
                ]);
            }
        }
        else if($action == "update")
        {
            $sql = "UPDATE sentence SET sentence = :sentence, is_passed_shenhe = 0 WHERE id = :sentence_id";
            $stmt = $pdo->prepare($sql);
            $is_exe_ok = $stmt->execute([
                ":sentence" => $sentence,
                ":sentence_id"=> $_POST["sentence_id"]
            ]);
            
            if($is_exe_ok) {
                echo json_encode([
                    "status" => true,
                    "message" => "更新成功"
                ]);
            } else {
                $error_info = $stmt->errorInfo();
                echo json_encode([
                    "status" => false,
                    "message" => "更新失败",
                    "error" => $error_info
                ]);
            }
        }
        
    } catch (Exception $e) {
        echo json_encode([
            "status" => false,
            "message" => "数据库错误: " . $e->getMessage()
        ]);
    }
}
?>