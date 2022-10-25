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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book['title']?></title>
</head>
<body>

    <h1><?php echo $book['title']?></h1>

    <div>
        <h2><?php echo 'Release date: '; echo $book['release_date']; ?></h2> 
        
        <h2> <?php echo 'Price: '; echo $book['price']; ?></h2>

        <h2> <?php echo 'Autor: '; echo $autor['first_name']; echo ' '; echo $autor['last_name']; ?></h2>

        <h2> <?php echo 'Release date: '; echo $book['release_date'];?></h2>

        <h2> <?php echo 'Language: '; echo $book['language']; ?></h2>

        <img src="<?php echo $book['cover_path'] ?>">

        <p> <?php echo 'Summary: '; echo $book['summary']; ?></p>

    </div>


        <li><a href="edit_book.php?id=<?=$id;?>">Change</li>
        <li><a href="delete.php?id=<?=$id;?>">Delete</li>
        <li><a href="index.php">Return to book list</li>
</body>
</html>