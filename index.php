<?php

require_once('connection.php');


echo '<ul>';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexstyle.css">
    <title>Document</title>
</head>
<body>

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