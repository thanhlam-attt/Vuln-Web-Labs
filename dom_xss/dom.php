<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
setcookie('cookie_name', 'I am Guest');
if (isset($_COOKIE['cookie_name'])) {
    if ($_COOKIE['cookie_name'] === 'I am Guest') {
        $username = "Guest";
    } elseif ($_COOKIE['cookie_name'] === 'cookieofdomuser') {
        $username = "User";
    } else {
        $username = "Đừng thay đổi cookie linh tinh :vv";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DOM-BASED XSS</title>
    <link href="/xss/Image/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'"> -->

</head>

<body>
    <header>
        <a href="\xss\index.php" class="logo">LAB</a>
        <a href="\xss\dom_xss\dom.php?default=English" class="button">DOM-based XSS</a>
        <strong class="user-info">
            <?php if (isset($_COOKIE["cookie_name"])):
                echo "User: " . $username;
                if ($_COOKIE['cookie_name'] === 'cookieofdomuser') {
                    $ip_proxy = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : 'null';
                    if ($ip_proxy === 'null') {
                        echo '<script>alert("Địa chỉ ip không thuộc địa chỉ cục bộ");</script>';
                    } else {
                        echo "User: " . $username;
                        echo '<script>alert("Flag: D0m_xsS_@dm1n_1s_Th@nH!");</script>';
                    }
                }
            endif; ?>
        </strong>
    </header>
    <style>
        .user-info {
            float: right;
            margin-left: 10px;
            margin-top: 5px;
        }

        .button {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumbs">
                    <li>
                        <?php echo "DOM-BASED XSS"; ?>
                    </li>
                </ul>
                <h5 align="center">Alert Flag!</h5>

                <form name="XSS" method="GET">
                    <fieldset><select name="default">
                            <?php
                            $lang = isset($_GET['default']) ? $_GET['default'] : '';
                            $lang = htmlentities($lang);
                            $lang = urldecode($lang);
                            $pattern = '/>alert\("Flag"\)/';
                            $pattern_1 = '/alert\("Flag"\)>/';
                            if (preg_match($pattern, $lang) || preg_match($pattern_1, $lang)) {
                                echo '<script>alert("User: cookieofdomuser")</script>';
                                echo '<script>alert("Chưa xong đâu!")</script>';
                            }
                            ?>
                            <script>
                                if (document.location.href.indexOf("default=") >= 0) {
                                    var lang = <?php echo json_encode($lang) ?>;
                                    document.write("<option value='" + lang + "'>" + decodeURI(lang) + "</option>");
                                    document.write("<option value='' disabled='disabled'>----</option>");
                                }
                                document.write("<option value='English'>English</option>");
                                document.write("<option value='French'>French</option>");
                                document.write("<option value='Spanish'>Spanish</option>");
                                document.write("<option value='German'>German</option>");
                            </script>
                            </selec>
                            <input type="submit" value="Select" />
                            <div role="group" class="btn-group">
                                <strong>
                                    Hints<br>
                                </strong>
                                <button id="btn-1" type="button" title="Hint 1" onclick='alert("\"Flag\"")'>1</button>
                            </div>
                    </fieldset>
                </form>
                <form action="dom.php?default=English" method="POST">
                    <fieldset>Nhập Flag: <input type="input" name="flag">
                        <button type="submit" class="primary" value="Submit!">Submit!</button>
                    </fieldset>
                </form>
                <?php
                $flag = isset($_POST["flag"]) ? $_POST["flag"] : "";
                if ($flag === "") {
                    echo "<p>Chưa nhập flag</p>";
                } else if ($flag === "D0m_xsS_@dm1n_1s_Th@nH!") {
                    echo '<script>alert("Win rồi!!! Cũng ra gì đấy!")</script>';
                } else {
                    echo '<script>alert("Flag sai, hãy thử lại!")</script>';
                }
                ?>
            </div>

        </div>
    </div>

</body>

</html>