<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zhu
 * Date: 14-5-22
 * Time: ÏÂÎç11:29
 * To change this template use File | Settings | File Templates.
 */
try{
    $pdo = new PDO('mysql:127.0.0.1','root','root',array(PDO::ATTR_AUTOCOMMIT=>'set names utf8'));
}catch (Exception $e){
    exit($e->getMessage());
}
$pdo->query('use test');

//ajax get
if(strtolower($_SERVER['REQUEST_METHOD']) == 'get'){
    $lastId = $_GET['last'];
    $sql = "select * from msg where id > {$lastId}";
    $res = $pdo->query($sql);
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
    exit;
}

//ajax post
$msg = $_POST['msg'];
$ip = $_SERVER['REMOTE_ADDR'];
$time = date('Y-m-d H:i:s');

$sql = "insert into msg (msg,send_time,ip) values ('{$msg}','{$time}','{$ip}')";
echo $pdo->exec($sql);

