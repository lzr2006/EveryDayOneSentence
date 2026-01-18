<?
header("Content-Type:application/json;charset=utf-8");
include("config.php");
$table_user = "CREATE TABLE IF NOT EXISTS user (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100),
    password VARCHAR(100)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

$table_sentence = "CREATE TABLE IF NOT EXISTS sentence (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    sentence VARCHAR(100) UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_passed_shenhe BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES user(id)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
$stmt = $pdo->prepare($table_user);
$result = $stmt->execute();
$stmt = $pdo->prepare($table_sentence);
$reuslt2 = $stmt->execute();
if($result && $reuslt2)
{
    echo json_encode(
        array(
                "code" => true,
                "message"=>"tables initialized"
        ));
}
?>