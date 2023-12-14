<?php 
session_start();
$dsn = 'mysql:host=localhost;dbname=kekw';
$username = 'root';
$password = 'hehez190';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if(empty($_POST['username']) || empty($_POST["password"])){
        $msg ="<span>field required</span>";
   }
   else{

   }
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("INSERT INTO user (username, password) VALUES (:user, :pass)");
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);

    try {
        $stmt->execute();
        $success = $stmt->rowCount();
        if($success >0){
            $_SESSION["username"] = $_POST['username'];
            header('Location:db-prac.php');
        }
        echo "Data inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
<input type="text" placeholder="username" name="username">
<input type="password" placeholder="password" name="password">
<button type="submit">LOG IN</button>
</form>



</body>
</html>