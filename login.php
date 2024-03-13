<?php


$form_sent=!empty($_POST);
session_start();

if($form_sent){
    // var_dump($_POST);

    
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        require_once __DIR__.'./db/conn.php';

        $query=$conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");
        $query->bind_param("ss", $username, $password);
        
        $username = $_POST['username']??'';
        $password = md5($_POST['password']??'');
        var_dump($password);


        $query->execute();
        $result=$query->get_result();
        // var_dump($result);

        if($result->num_rows){
            $_SESSION["user"]=$result->fetch_assoc();
            // var_dump($_SESSION);
        }
        
    }

    if(!empty($_POST['logout'])){
        session_unset();
        session_destroy();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php if(!isset($_SESSION['user'])):?>
        <h1>Login form</h1>
    <form method="POST">
        <div>
            <label for="username">username</label>
            <input type="text" name="username" id='username'>
        </div>
        <div>
            <label for="password">password</label>
            <input type="text" name="password" id='password'>
        </div>
        <button>login</button>
    </form>
    <?php else:?>
        <h1>Logout</h1>

    <form method="POST">
        <input type="hidden" name="logout" value="1">
        <button>Logout</button>
    </form>
    <?php endif;?>
</body>
</html>