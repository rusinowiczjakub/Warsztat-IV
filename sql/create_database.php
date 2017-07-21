<?PHP


require 'connection.php';

$query = file_get_contents('create_database.sql');

$conn->query($query);


