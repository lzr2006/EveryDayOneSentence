<?php
include('config.php');
session_start();

// 检查是否已认证
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => false,
        'error' => '未授权访问'
    ]);
    exit;
}

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'getNext':
        getNextSentence();
        break;
    case 'update':
        updateReview();
        break;
    default:
        echo json_encode([
            'status' => false,
            'error' => '未知操作'
        ]);
        break;
}

function getNextSentence() {
    // 从数据库获取待审核的句子
    try {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, sentence FROM sentence WHERE is_passed_shenhe = 0 LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            echo json_encode([
                'status' => true,
                'data' => [
                    'id' => $result['id'],
                    'sentence' => htmlspecialchars($result['sentence'])
                ]
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'error' => '没有待审核的句子'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => false,
            'error' => '数据库错误'
        ]);
    }
}

function updateReview() {
    $sentenceId = $_POST['sentence_id'] ?? null;
    $isPassed = $_POST['is_passed'] ?? null;
    
    if (!$sentenceId || !isset($isPassed)) {
        echo json_encode([
            'status' => false,
            'message' => '参数缺失'
        ]);
        exit;
    }
    
    try {
      global $pdo;
        $stmt = $pdo->prepare("UPDATE sentence SET sentence =:sentence, is_passed_shenhe = :is_passed WHERE id = :id");
        $result = $stmt->execute([
          ":sentence"=>$_POST['sentence'],
          ":is_passed"=>$isPassed,
          ":id"=> $sentenceId
        ]);
        
        if ($result) {
            echo json_encode([
                'status' => true,
                'message' => $isPassed == 1 ? '已通过审核' : '已拒绝审核'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => '更新失败'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => false,
            'message' => '数据库错误'
        ]);
    }
}
?>