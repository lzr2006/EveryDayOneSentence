<?php
header('Content-Type: application/json');
// 设置安全密码 - 请修改为你的实际密码
define('REVIEW_PASSWORD', 'zr871214'); // 请修改此密码
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $action = $_POST['action'];
    
    if ($action === 'login') 
    {
        $password = $_POST['password'];
        if (empty($password)) 
        {
            echo json_encode([
                'status' => false,
                'message' => '密码不能为空'
            ]);
            exit;
        }
        $isValid = password_verify($password,password_hash($password,PASSWORD_BCRYPT));
        
        if ($isValid) {
            session_start();
            $_SESSION['authenticated'] = true;
            
            echo json_encode([
                'status' => true,
                'message' => '登录成功'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => '密码错误'
            ]);
        }
    } else {
        echo json_encode([
            'status' => false,
            'message' => '无效操作'
        ]);
    }
} else {
    echo json_encode([
        'status' => false,
        'message' => '请求方法错误'
    ]);
}
?>