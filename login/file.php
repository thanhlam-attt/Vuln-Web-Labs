<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php 
        header("Location: login.php", true, 301);
    ?>
    function password_generated()
        {
            $ramdom = random_input();
            $passwd = "0e" . $ramdom;
            return $passwd;
        }
    $passwd = password_generated();
    if (!strcmp($_POST['username'], 'admin') && hash('md4', $_POST['password']) == $passwd) {
        echo 'Flag sẽ hiện ra!';
    }
</body>

</html>