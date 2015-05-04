<?php
require(__DIR__ . '/../../vendor/autoload.php');

use ItTutorial\ctocamp\src\mq\UserMQ;

defined('DSN') or define('DSN','mysql:host=127.0.0.1;dbname=tredis');
defined('USER') or define('USER','root');
defined('PASS') or define('PASS','123456');

$mq = UserMQ::MQ();
$flag = TRUE;
while($flag){
    $msg = $mq->pop();
    if($msg!=null && $msg != ''){
            try{
                $pdo = new \PDO(DSN,USER,PASS);
            }catch(PDOException $e){
                die($e->getMessage());
            }
            $data = array_values($msg);
            $sql = "insert into tb_user values(null,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
    }
}

