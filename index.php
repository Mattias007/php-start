

<?php
ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);


require_once('connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/indexstyle.css">
    <title>Document</title>
</head>
<body>
    <form action="search.php" method="get">
        <input name="qry" id="qry" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
    </form>
    <li><a href="add_book.php">Add book to book list</li>
    <li><a href="add_author.php">Add Author to Author list</li>
  
    <?php

    $stmt = $pdo->query('SELECT * FROM books');
    while ($row = $stmt->fetch())
    { ?>
        <li><a href="book.php?id=<?php echo $row['id']; ?>"><h1><?php echo $row['title']; ?></h1></li>
    <?php
    }

    ?>


</body>
</html>