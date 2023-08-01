<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
setcookie('cookie_name', 'I am Guest');
if (isset($_COOKIE['cookie_name'])) {
    if ($_COOKIE['cookie_name'] === 'I am Guest') {
        $username = "Guest";
    } elseif ($_COOKIE['cookie_name'] === 'Cookieofuser') {
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
    <title>Stored-XSS</title>
    <link href="../Image/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'"> -->
</head>

<body>
    <header>
        <a href="..\index.php" class="logo">LAB</a>
        <a href="stored.php" class="button">Stored XSS</a>
        <strong class="button user-info">
            <?php if (isset($_COOKIE["cookie_name"])):
                echo "User: " . $username;
                if ($_COOKIE['cookie_name'] === 'Cookieofuser') {
                    $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'null';
                    if (preg_match("/head/i", $method)) {
                        echo "User: " . $username;
                        echo '<script>alert("Flag: Fl@g_1s_St0r3d_XsS!");</script>';
                    } else {
                        echo '<script>alert("Sai phương thức!");</script>';
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

                <h5 align="center">Vẫn là alert Cookie để win :33</h5>

                <div align="center">
                    <img src=../Image/Image.jpg>
                </div>
                <fieldset><!-- Form -->
                    <legend>Bình luận về hình ảnh trên:</legend>
                    <form id="commentForm" onsubmit="submitForm();">
                        Username:
                        <strong>
                            <?php echo isset($_COOKIE['cookie_name']) ? substr($_COOKIE['cookie_name'], 5) : ''; ?>
                        </strong><br>
                        Comment: <br><textarea id="comment" name="comment" rows="3" cols="40" required></textarea><br>
                        <input type="submit" value="Gửi bình luận">
                    </form>
                </fieldset>

                <script>
                    function submitForm() {
                        var xhr = new XMLHttpRequest();
                        var formData = new FormData(document.getElementById("commentForm"));
                        xhr.open("POST", "stored.php", true);
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Xử lý kết quả trả về nếu cần thiết
                                document.getElementById('comment').value = "";
                            }
                        };
                        xhr.send(formData);
                    }
                </script>

                <div role="group" class="btn-group">
                    <strong>
                        Hints<br>
                    </strong>
                    <button type="button" title="Hint 1" onclick='alert("\"Cuc Ki\"")'>1</button>
                    <button type="button" title="Hint 2" onclick='alert("\"Mã hóa Base64\"")'>2</button>
                </div>

                <fieldset>
                    <legend>Nhập Flag</legend>
                    <form action="stored.php" method="POST">
                        Nhập Flag: <input type="input" name="flag">
                        <button type="submit" class="primary" value="Submit!">Submit!</button>
                    </form>
                </fieldset>

                <?php
                $flag = isset($_POST["flag"]) ? $_POST["flag"] : "";
                if ($flag === "") {
                    echo "<p>Chưa nhập flag</p>";
                } else if ($flag === "Fl@g_1s_St0r3d_XsS!") {
                    echo '<script>alert("Win rồi!!! Cũng ghê đấy!")</script>';
                } else {
                    echo '<script>alert("Flag sai, hãy thử lại!")</script>';
                }
                ?>

                <?php
                // Kết nối với cơ sở dữ liệu
                $servername = "localhost";
                $username = "thanh";
                $password = "thanhlam";
                $dbname = "xss_db";
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Nhận dữ liệu bình luận từ form HTML
                if (isset($_POST['comment'])) {
                    $name = substr($_COOKIE['cookie_name'], 5);
                    $comment = $_POST['comment'];
                    $timestamp = date('Y-m-d H:i:s');

                    $comment = urldecode($comment);
                    $comment = htmlspecialchars($comment);
                    // Lưu trữ dữ liệu bình luận vào cơ sở dữ liệu
                    $sql = "INSERT INTO comments (name, comment, timestamp) VALUES ('$name', '$comment', '$timestamp')";
                    if ($conn->query($sql) === TRUE) {
                        echo "success";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                function isBase64($string)
                {
                    $decodedString = base64_decode($string, true);
                    if ($decodedString !== false) {
                        $encodedString = base64_encode($decodedString);
                        if ($encodedString === $string) {
                            return true;
                        }
                    }
                    return false;
                }

                // Truy vấn cơ sở dữ liệu để lấy ra các bình luận đã được lưu
                $sql = "SELECT name, comment, timestamp FROM comments";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Hiển thị các bình luận trên trang web
                    echo "<table>";
                    echo "<tr><th>Tên user</th><th>Comment</th><th>Thời gian</th></tr>";
                    $pattern = '/>alert\("Cuc Ki"\)/';
                    $pattern_1 = '/alert\("Cuc Ki"\)>/';
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        if (isBase64($row["comment"])) {
                            echo "<td>" . nl2br(base64_decode($row["comment"])) . "</td>";
                            if (
                                preg_match($pattern, nl2br(base64_decode($row["comment"])))
                                || preg_match($pattern_1, nl2br(base64_decode($row["comment"])))
                            ) {
                                echo "<script>alert(\"User: Cookieofuser\")</script>";
                            }
                        } else {
                            echo "<td>" . nl2br($row["comment"]) . "</td>";
                        }
                        echo "<td>" . $row["timestamp"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Chưa có bình luận nào.";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

</body>

</html>