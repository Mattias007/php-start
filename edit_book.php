<?php

require_once('connection.php');
require_once('header.php');

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

$resposne = '';

echo var_dump($_POST);
if (isset($_POST['savebutton'])) { 
    $title = $_POST['title'];
    $price = $_POST['price'];
    $release_date = $_POST['release_date'];
    $language = $_POST['language'];

            $sql = "UPDATE books SET title=:title , price=:price , language=:language , release_date=:release_date WHERE id=:id";
            $sql1 = "UPDATE book_authors SET author_id=:author WHERE book_id=:id";


    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id ,'title' => $title,'price' => $price, 'language' => $language, 'release_date' => $release_date]);
    $resposne = $stmt->rowCount() . "  Book/Books UPDATE successfull";
    
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(['author' => $_POST['author'], 'id' => $id]);
    $resposne = $stmt->rowCount() . "  Author UPDATE successfull";
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
            <label for="title">Change Release date</label>
            <input type="text" name="release_date" id="release_date" value="<?php echo $book['release_date']?>">
        </div>

        <div>
            <label for="title">Change Language</label>
            <input type="text" name="language" id="language" value="<?php echo $book['language']?>">
        </div>

        <label for="author">Choose a Author:</label>
        <select name="author" id="author">
            

            <?php 
                $stmt1 = $pdo->query('SELECT * FROM authors');

                

                while ($row = $stmt1->fetch())

                {
                    ?><option <?php if($row['id'] == $Author_ID){echo 'selected';}?>   value="<?php echo $row['id']; ?>"><?php echo $row['first_name'] . ' ' . $row['last_name']?></option><?php
                }
            
            ?>

        </select>

        <div>
            <input type="submit" name="savebutton" value="Save">
        </div>

        <p><?php echo $resposne ?></p>
    </form>


    <li><a href="book.php?id=<?=$id;?>">Return to book</li>
    <li><a href="index.php">Return to book list</li>

</body>
</html>