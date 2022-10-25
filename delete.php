<?php

require_once('connection.php');

$id =$_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete page</title>
</head>
<body>

    <h1><?php echo $book['title']?></h1>
    
    <form action="delete.php?id=<?php echo $id ?>" method="post">
        <div>
            <label for="title">Type something to delete</label>
            <input type="text" name="title" id="title" placeholder="<?php echo $book['title']?>" required>
        </div>

        <div>
        <input type="submit" name="deletebutton" value="Delete">
        </div>
    </form>

    <?php 
        if (sizeof($_POST) == 2) { 
            $sql = "DELETE FROM book_authors WHERE book_id=$id";
            $sql = "DELETE FROM books WHERE id=$id";
            $pdo->exec($sql);
            echo $stmt->rowCount() . " records DELETE successfully";
        }

?>
        <li><a href="book.php?id=<?=$id;?>">Return to book</li>
        <li><a href="index.php">Return to book list</li>

</body>
</html>