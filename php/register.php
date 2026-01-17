<?php
include("config.php");
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // 检查邮箱是否已存在
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $checkStmt->execute([':email' => $_POST['email']]);
        $count = $checkStmt->fetchColumn();
        
        if ($count > 0) {
            // 邮箱已存在
            echo json_encode([
                "code" => false,
                "message" => "Email already exists"
            ]);
        } else {
            // 插入新用户
            $insertStmt = $pdo->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");
            $result = $insertStmt->execute([
                ':email' => $_POST['email'],
                ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
            ]);
            
            if ($result) {
                echo json_encode([
                    "code" => true,
                    "message" => "Registration successful"
                ]);
            } else {
                echo json_encode([
                    "code" => false,
                    "message" => "Registration failed"
                ]);
            }
        }
    } catch (Exception $e) {
        echo json_encode([
            "code" => false,
            "message" => "Database error: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "code" => false,
        "message" => "Invalid request method"
    ]);
}
?>