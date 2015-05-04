<?php
require(__DIR__ . '/../../vendor/autoload.php');

use ItTutorial\ctocamp\src\mq\UserMQ;

if(isset($_POST['username'])){
	$data = ['username'=>$_POST['username'],'password'=>$_POST['password']];
	UserMQ::MQ()->push($data);
}
?>
<html>
    <head></head>
    <body>
        <form action="" method="POST">
            username:<input type="text" name="username"/><br />
            password:<input type="password" name="password"/><br />
            <input type="submit" />

        </form>
    </body>
</html>
