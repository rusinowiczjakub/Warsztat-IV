<?php

require __DIR__."/../src/Controller.php";

if($_SERVER["REQUEST_URI"] === "/admin") {
    echo("test");
//    if($_SERVER["REQUEST_METHOD"] === "GET") {
//        echo $controller->showProduct();
//    } elseif($_SERVER["REQUEST_METHOD"] === "POST") {
//        echo $controller->addProduct();
//    }
//    die;
}