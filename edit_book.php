<?php

require_once('connection.php');

$id =$_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();


$stmt_autorID = $pdo->prepare('SELECT * FROM book_authors WHERE book_id = :id');
$stmt_autorID->execute(['id' => $id]);
$autorID = $stmt_autorID->fetch();

$Author_ID = $autorID['author_id'];


$stmt_autor = $pdo->prepare('SELECT * FROM authors WHERE id = :Author_ID');
$stmt_autor->execute(['Author_ID' => $Author_ID]);
$autor = $stmt_autor->fetch();



if (isset($_POST['savebutton'])) { 
    $title = $_POST['title'];
    $price = $_POST['price'];

            $sql = "UPDATE books SET title=:title, price='$price' WHERE id=:id";

    var_dump($_POST);
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id],['Author_ID' => $Author_ID],['title' => $title],['price' => $price]);
    echo $stmt->rowCount() . " records UPDATED successfully";
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

    <h1><?php echo $book['title']?></h1>
    
    <form action="edit_book.php?id=<?php echo $id ?>" method="post">
    <div>
        <label for="title">Change title</label>
        <input type="text" name="title" id="title" value="<?php echo $book['title']?>">
    </div>

    <div>
        <label for="title">Change price</label>
        <input type="text" name="price" id="price" value="<?php echo $book['price']?>">
    </div>

    <div>
        <label for="title">Change Author</label>
        <input type="text" name="author" id="author" value="<?php echo  $Author_ID?>">
    </div>
    
    <div>
    <input type="submit" name="savebutton" value="Save">
    </div>
    </form>


            <li><a href="book.php?id=<?=$id;?>">Return to book</li>
        <li><a href="index.php">Return to book list</li>
</body>
</html>