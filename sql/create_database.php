<?PHP


require '../connection.php';

$query = file_get_contents('create_database.sql');

if($conn->query($query)){
    echo "tables creation successful";
}else{
    echo "connection error";
}


