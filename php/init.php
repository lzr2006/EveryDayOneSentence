<?
include("config.php");
$table_user = "CREATE TABLE user (
    id(int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY),
    email varchar(100),
    password varchar(100),
)";
$table_sentence = "CREATE TABLE sentence (
    id(int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY),
    -- 内联 关联user表的id
    user_id int(11),
    sentence varchar(100),
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if($pdo_type == "local")
{
    $stmt = $local_pdo->prepare($table_user);
    $stmt->execute();
    $result = $stmt->fetchResult();
    echo json_encode(
        array(
              "code" => $result,
              "message"=>"Table user created"
        ));
}
else if($pdo_type == "remote")
{
    $stmt = $remote_pdo->prepare($table_user);
    $stmt->execute();
    $result = $stmt->fetchResult();
    echo json_encode(
        array(
              "code" => $result,
              "message"=>"Table user created"
        ));
}
?>