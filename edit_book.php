<?php

use function PHPSTORM_META\type;

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

$resposne = '';

if (isset($_POST['savebutton'])) { 
    $title = $_POST['title'];
    $price = $_POST['price'];
    $release_date = $_POST['release_date'];
    $language = $_POST['language'];
    $pages = $_POST['pages'];
    $stock_saldo =$_POST['stock_saldo'];
    $summary =$_POST['summary'];
    $cover_path=$_POST['cover_path'];
    $type=$_POST['type'];

            $sql = "UPDATE books SET title=:title , price=:price , language=:language , release_date=:release_date , pages=:pages , stock_saldo=:stock_saldo, summary=:summary, cover_path=:cover_path, type=:type WHERE id=:id";
            $sql1 = "UPDATE book_authors SET author_id=:author WHERE book_id=:id";


    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id ,'title' => $title,'price' => $price, 'language' => $language, 'release_date' => $release_date, 'pages'=> $pages, 'stock_saldo'=> $stock_saldo, 'summary'=>$summary,'cover_path'=>$cover_path, 'type'=>$type]);
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
            <input type="number" name="price" id="price" value="<?php echo $book['price']?>">
        </div>

        <div>
            <label for="title">Change Release date</label>
            <input type="number" name="release_date" id="release_date" value="<?php echo $book['release_date']?>">
        </div>

        <div>
            <label for="title">Change Language</label>
            <input type="text" name="language" id="language" value="<?php echo $book['language']?>">
        </div>

        <div>
            <label for="title">Change pages</label>
            <input type="number" name="pages" id="pages" value="<?php echo $book['pages']?>">
        </div>

        <div>
            <label for="title">Change Stock Saldo</label>
            <input type="number" name="stock_saldo" id="stock_saldo" value="<?php echo $book['pages']?>">
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


        <p><?php echo $resposne ?></p>

        <div class="summary">
            <label for="title">Change summary</label>
            <input type="text" name="summary" id="summary" value="<?php echo $book['summary']?>">
        </div>

        <div>
            <label for="title">Change picture</label>
            <input type="text" name="cover_path" id="cover_path" value="<?php echo $book['cover_path']?>">
        </div>

        <div>
            <label for="type">Change type</label>
            <select name="type" id="type">
                <option  <?php if($book['type'] == 'ebook'){echo 'selected';}?>  value="ebook">ebook</option>
                <option  <?php if($book['type'] == 'new'){echo 'selected';}?> value="new">new</option>
                <option  <?php if($book['type'] == 'used'){echo 'selected';}?> value="used">used</option>
            </select>
        </div>

        <div>
            <input type="submit" name="savebutton" value="Save">
        </div>
    </form>


    <li><a href="book.php?id=<?=$id;?>">Return to book</li>
    <li><a href="index.php">Return to book list</li>

</body>
</html>