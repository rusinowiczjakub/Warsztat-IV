<?php
require_once("connection.php");

$twitterArraysSQL = array(
    "create table Items(
                        id int AUTO_INCREMENT NOT NULL,
                        name varchar(100) NOT NULL,
                        description text NOT NULL,
                        price decimal(7,2) NOT NULL)                      
     ENGINE=InnoDB, CHARACTER SET=utf8"
,
    "create table Images(
                        id int AUTO_INCREMENT NOT NULL,
                        item_id int NOT NULL,
                        link varchar(140) NOT NULL,
                        PRIMARY KEY(id),
                        FOREIGN KEY(item_id) REFERENCES Items(id) ON DELETE CASCADE)
     ENGINE=InnoDB, CHARACTER SET=utf8"
,
    "create table Clients(
                        id int AUTO_INCREMENT NOT NULL,
                        name varchar(100) NOT NULL,
                        surname varchar(100) NOT NULL,
                        email varchar(100) NOT NULL,
                        password CHAR(64) NOT NULL,
                        address varchar (255) NOT NULL,
                        PRIMARY KEY(id)
                        )                                          
     ENGINE=InnoDB, CHARACTER SET=utf8"
,
    "create table Messages(
                        id int AUTO_INCREMENT NOT NULL,
                        admin_id int NOT NULL,
                        client_id int NOT NULL,
                        opened datetime NOT NULL,
                        message text NOT NULL,
                        PRIMARY KEY(id),
                        FOREIGN KEY(admin_id) REFERENCES Admins(id),
                        FOREIGN KEY(client_id) REFERENCES Clients(id) ON DELETE CASCADE)
     ENGINE=InnoDB, CHARACTER SET=utf8"
,
    "create table Orders(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        client_id int NOT NULL,
                        FOREIGN KEY(client_id) REFERENCES Clients(id),
                        order_status int NOT NULL
                                                )
     ENGINE=InnoDB, CHARACTER SET=utf8"
,
    "create table Items_Orders(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        quantity int,
                        client_id int NOT NULL,
                        item_id int NOT NULL,
                        FOREIGN KEY(order_id) REFERENCES orders(order_id),
                        FOREIGN KEY(item_id) REFERENCES items(item_id)
                                                )
     ENGINE=InnoDB, CHARACTER SET=utf8");

foreach($twitterArraysSQL as $query){
    $result = $conn->query($query);
    if ($result === TRUE) {
        echo "Tabela zostala stworzona poprawnie<br>";
    } else {
        echo "Blad podczas tworzenia tabeli: " . $conn->error."<br>";
    }
}


$conn->close();
$conn = null;

