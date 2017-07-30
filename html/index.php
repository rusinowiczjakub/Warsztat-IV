<?php
require_once "nav.php";
require_once "../src/Group.php";
require_once "../src/Items.php";

?>
<html>
<head>
    <title>Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
<?php
if(isset($_GET['page'])){
    if($_GET['page'] == 'items'){
        echo Items::showItems($conn);
    }
}
if(isset($_GET['item'])){
    echo Items::showItemById($conn, $_GET['id']);

}

if(isset($_GET['category'])){
    echo Items::showItemsByGroups($conn, $_GET['id']);
}

?>

</body>

</html>