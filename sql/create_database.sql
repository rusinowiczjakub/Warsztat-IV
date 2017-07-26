    CREATE TABLE Items(
                        id int AUTO_INCREMENT NOT NULL,
                        name varchar(100) NOT NULL,
                        description text NOT NULL,
                        quantity INT,
                        group_id INT NULL,
                        PRIMARY KEY(id),
                        FOREIGN KEY(group_id) REFERENCES Groups(id),
                        price decimal(7,2));

   

    create table Admins(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        email varchar(100) NOT NULL,
                        password CHAR(64) NOT NULL);
     

    create table Images(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        item_id int NOT NULL,
                        link varchar(140) NOT NULL,
                        FOREIGN KEY(item_id) REFERENCES Items(id) ON DELETE CASCADE);
     

    create table Clients(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        name varchar(100) NOT NULL,
                        surname varchar(100),
                        email varchar(100),
                        password CHAR(64) NOT NULL,
                        address varchar (255) NOT NULL
                        ) ;                                         
    

    create table Messages(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        admin_id int NOT NULL,
                        client_id int NOT NULL,
                        opened datetime NOT NULL,
                        message text NOT NULL,
                        FOREIGN KEY(admin_id) REFERENCES Admins(id),
                        FOREIGN KEY(client_id) REFERENCES Clients(id) ON DELETE CASCADE);
     

    create table Orders(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        client_id int NOT NULL,
                        FOREIGN KEY(client_id) REFERENCES Clients(id),
                        order_status int NOT NULL
                                                );
     

    create table Items_Orders(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        quantity int,
                        order_id int NOT NULL,
                        item_id int NOT NULL,
                        FOREIGN KEY(order_id) REFERENCES Orders(id),
                        FOREIGN KEY(item_id) REFERENCES Items(id)
                                                );

    create table Groups(
                        id int AUTO_INCREMENT NOT NULL,
                        PRIMARY KEY(id),
                        item_id int NOT NULL,
                        FOREIGN KEY(item_id) REFERENCES Items(id)
    )
    
