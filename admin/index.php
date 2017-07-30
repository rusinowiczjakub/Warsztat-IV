<?php

session_start();

$configDB['servername'] = 'localhost';
$configDB['baseName'] = 'shop';
$configDB['username'] = 'root';
$configDB['password'] = 'coderslab';

$servername = $configDB['servername'];
$dbName = $configDB['baseName'];
$username = $configDB['username'];
$pass = $configDB['password'];

$conn = new PDO("mysql:host=$servername;dbname=$dbName", "$username", "$pass");
// Sprawdzamy czy połączcenie się udało
if (!$conn) {
    die("Polaczenie nieudane.");
}

if ($conn->errorCode() != null)
{
    die("Polaczenie nieudane. Blad: " .
        $conn-> errorInfo()[2]);
}

if  ($_SERVER['REQUEST_METHOD']=="POST")

{

    if ((isset($_POST['adminEmail'])&&
        (isset($_POST['adminPassword']))&&
        (!isset($_SESSION['adminlogin']))))
    {

        $sql = "SELECT * FROM Admins WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $_POST['adminEmail']]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //sprawdzam czy hasło poprawne

        if (count($result) && $_POST['adminPassword'] == $result[0]['password'])
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
    echo("zalogowany");

    $sql = "SELECT * FROM Messages WHERE admin_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $_SESSION['adminlogin']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    var_dump($result);

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


