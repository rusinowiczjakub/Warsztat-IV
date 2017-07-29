
<form method="POST" action="">
    <input type="text" name="name">
    <input type="submit" name="submit" value="add">
</form>

<?php
require __DIR__."/src/Items.php";

if(isset($_POST['name'])){
$item = new Items($name = $_POST['name']);
$item->saveToDB($conn);
}

?>
