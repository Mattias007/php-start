<?php

require_once('connection.php');
require_once('header.php');


// echo var_dump($_POST);
if (isset($_POST['savebutton'])) { 
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];


            $sql = "INSERT INTO authors (first_name, last_name) VALUES (:first_name , :last_name)";
 

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['first_name' => $first_name,'last_name' => $last_name]);
    $resposne = $stmt->rowCount() . "  Author Added successfull";

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit page</title>
</head>
<body>

    
    <form action="add_author.php" method="post">

        <div>
            <label for="title">Change First Name</label>
            <input type="text" name="first_name" id="first_name" value="">
        </div>

        <div class="summary">
            <label for="title">Change Last Name</label>
            <input type="text" name="last_name" id="last_name" value="">
        </div>

        <div>
            <input type="submit" name="savebutton" value="Save">
        </div>
    </form>


    <li><a href="book.php?id=<?=$id;?>">Return to book</li>
    <li><a href="index.php">Return to book list</li>
    <li><a href="add_book.php">Add book to book list</li>

</body>
</html>