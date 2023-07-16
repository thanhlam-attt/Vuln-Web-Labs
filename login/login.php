<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="/xss/Image/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
</head>

<body>
    <header>
        <a href="\xss\index.php" class="logo">LAB</a>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div align="center">
                    <h2>Login!</h2>
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <fieldset>
                            <label for="username">Username:</label><input type="text" name="username"
                                placeholder="Enter Username" required="required" /><br>
                            <label for="password">Password: </label> <input type="password" name="password"
                                placeholder="Enter Password" required="required" /><br>
                            <button type="submit" class="btn">login</button>
                        </fieldset>
                    </form>
                    <div role="group" class="btn-group">
                        <strong>
                            Hints<br>
                        </strong>
                        <button type="button" title="Hint 1" onclick='alert("Tìm file source code?")'>1</button>
                        <button type="button" title="Hint 2" onclick='alert("Thấy flag tự chuyển sang lab mới, không cần nhập flag đâu :3")'>2</button>
                    </div>
                    
                    <?php
                    function random_input()
                    {
                        $random = random_int(10000000, 20000000);
                        return $random;
                    }
                    function password_generated()
                    {
                        $ramdom = random_input();
                        $passwd = "0e" . $ramdom;
                        return $passwd;
                    }

                    if (!empty($_POST['username']) && !empty($_POST['password'])) {
                        $passwd = password_generated();
                        $FLAG = "Hello WORLD!!";
                        if (!strcmp($_POST['username'], 'admin') && hash('md4', $_POST['password']) == $passwd) {
                            echo '<script>alert("Flag: c0d3_n9U_l@_cHeT!")</script>';
                        } else {
                            echo '<script>alert("Wrong Username or Password")</script>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>