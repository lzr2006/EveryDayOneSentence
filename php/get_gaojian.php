<?php
// 漏提交的
header("Content-Type: application/json; charset=utf-8");
include("config.php");
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$sql = "SELECT id FROM user WHERE email = :email";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(
	[
		":email" => $_GET["email"]
	]);
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	$uid = $r["id"];
	if(!$r)
	{
	echo json_encode([
		"status" => false,
		"message" => "用户不存在"
	]);
	return;
	}
	$sql = "SELECT sentence, is_passed_shenhe FROM sentence WHERE user_id = :user_id";
	$stmt = $pdo->prepare($sql);
	$is_exe = $stmt->execute(
	[
		":user_id" => $uid
	]);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if($is_exe)
	{
	echo json_encode([
		"status" => true,
		"message" => "获取用户上传的句子成功",
		"data" => $result
	]);
	}
	else{
	echo json_encode([
		"status" => false,
		"message" => "获取用户上传的句子失败",
		"data" => $result
	]);
	}
}
?>