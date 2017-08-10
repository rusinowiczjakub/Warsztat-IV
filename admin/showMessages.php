<?php

$sql = "SELECT * FROM Messages WHERE admin_id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $_SESSION['adminlogin']]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo"<h1>Messages</h1><table>";

echo("<tr><td>klient ID</td><td>opened</td><td>message</td>");


foreach ($result as $message){

    if (is_null($message['opened'])){
        $message['opened']="nieczytany";
    }

    echo("<tr>");
    echo("<td>".$message['client_id']."</td>");
    echo("<td>".$message['opened']."</td>");
    echo("<td>".$message['message']."</td>");
    echo("</tr>");
}

echo("</table>");