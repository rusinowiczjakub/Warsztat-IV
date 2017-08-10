<?php

session_start();

require __DIR__."/../connection.php";

require_once __DIR__.'/../src/Admin.php';
require_once __DIR__.'/../src/Message.php';

if  ($_SERVER['REQUEST_METHOD']=="POST")

{

    if ((isset($_POST['adminEmail'])&&
        (isset($_POST['adminPassword']))&&
        (!isset($_SESSION['adminlogin']))))
    {
        $email= $_POST['adminEmail'];
        $password=$_POST['adminPassword'];

        $sql = "SELECT * FROM Admins WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //sprawdzam czy hasło poprawne

        if (count($result) && $password == $result[0]['password'])
        {
            echo "hasło poprawne";
            $_SESSION['adminlogin']=$result[0]['id'];
        } else {
            echo "email lub hasło niepoprawne";
        }

    }
}

if (isset($_SESSION['adminlogin']))
{
    include("menuAdmin.php");

    if (isset($_GET['option']) && $_GET['option'] == 'showmessage'){
        include("showMessages.php");
    }

    if (isset($_GET['option']) && $_GET['option'] == 'newmessage'){
        include("newMessage.php");
    }



}
else
{
    ?>

    <form action="" method="POST">
        <input type="text" name="adminEmail" placeholder="email">
        <input type="password" name="adminPassword" placeholder="password">
        <input type="submit" value="zaloguj sie">

    </form>
    <?php
}


