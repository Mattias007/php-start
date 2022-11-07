<?php
require_once('connection.php');


$qry =  $_GET["qry"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="search.php" method="GET">
  <input name="qry" id="qry" type="text" placeholder="Type here">
  <input id="submit" type="submit" value="Search">
</form>

<?php 
if (strlen($qry)!=null) {
    $stmt = $pdo->query("SELECT * FROM books WHERE title LIKE '%$qry%'");
    ?> <li><a href="index.php">Return to book list</li><?php
    while ($row = $stmt->fetch())
    { ?>
        <li><a href="book.php?id=<?php echo $row['id']; ?>"><h1><?php echo $row['title']; ?></h1></li>
    <?php
    }
}
?> <li><a href="index.php">Return to book list</li><?php
?>
</body>
</html>