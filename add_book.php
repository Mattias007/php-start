<?php

require_once('connection.php');


// echo var_dump($_POST);
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

            $sql = "INSERT INTO books (title, price, language , release_date, pages , stock_saldo, summary, cover_path, type) VALUES (:title , :price , :language , :release_date , :pages , :stock_saldo, :summary, :cover_path, :type)";
 

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title,'price' => $price, 'language' => $language, 'release_date' => $release_date, 'pages'=> $pages, 'stock_saldo'=> $stock_saldo, 'summary'=>$summary,'cover_path'=>$cover_path, 'type'=>$type]);
    $resposne = $stmt->rowCount() . "  Book/Books UPDATE successfull";


    $id = $pdo->lastInsertId();
    echo var_dump($id);

    $sql1 = "INSERT INTO book_authors (book_id , author_id) VALUES ( $id , :author)";

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(['author' => $_POST['author']]);
    $resposne = $stmt->rowCount() . "  Author UPDATE successfull";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add page</title>
</head>
<body>

    
    <form action="add_book.php" method="post">

        <div>
            <label for="title">Change title</label>
            <input type="text" name="title" id="title" value="">
        </div>

        <div>
            <label for="title">Change price</label>
            <input type="number" name="price" id="price" value="">
        </div>

        <div>
            <label for="title">Change Release date</label>
            <input type="number" name="release_date" id="release_date" value="">
        </div>

        <div>
            <label for="title">Change Language</label>
            <input type="text" name="language" id="language" value="">
        </div>

        <div>
            <label for="title">Change pages</label>
            <input type="number" name="pages" id="pages" value="">
        </div>

        <div>
            <label for="title">Change Stock Saldo</label>
            <input type="number" name="stock_saldo" id="stock_saldo" value="">
        </div>

        <label for="author">Choose a Author:</label>
        <select name="author" id="author">
            

            <?php 
                $stmt1 = $pdo->query('SELECT * FROM authors');

                

                while ($row = $stmt1->fetch())

                {
                    ?><option  value="<?php echo $row['id']; ?>"><?php echo $row['first_name'] . ' ' . $row['last_name']?></option><?php
                }
            
            ?>

        </select>


        <p><?php echo $resposne ?></p>

        <div class="summary">
            <label for="title">Change summary</label>
            <input type="text" name="summary" id="summary" value="">
        </div>

        <div>
            <label for="title">Change picture</label>
            <input type="text" name="cover_path" id="cover_path" value="">
        </div>

        <div>
            <label for="type">Change type</label>
            <select name="type" id="type">
                <option value="ebook">ebook</option>
                <option value="new">new</option>
                <option value="used">used</option>
            </select>
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