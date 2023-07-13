<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
setcookie('cookie_name', 'I am Attacker');
if (isset($_COOKIE['cookie_name'])) {
  if ($_COOKIE['cookie_name'] === 'I am Attacker') {
    $username = "Attacker";
  } elseif ($_COOKIE['cookie_name'] === 'usethiscookietocaptureflag') {
    if ($userAgent === "admin" or $userAgent === "Admin") {
      $username = "Admin";
    } else {
      echo "<script>alert(\"Phải là trình duyệt của admin mới được thay đổi cookie hjhj :vv\")</script>";
    }
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
  <title>XSS - Cross Site Scripting</title>
  <link href="/xss/Image/favicon.ico" rel="icon" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
</head>

<body>
  <header>

    <a href="\xss\index.php" class="logo">XSS LAB</a>
    <a href="\xss\reflected_xss\reflected.php" class="button">Reflected XSS</a>
    <strong class="user-info">
      <?php if (isset($_COOKIE["cookie_name"])):
        echo "User: " . $username;
        if ($username === "Admin") {
          echo '<script>alert("Flag: R3f1eCted_xsS!");</script>';
        }
      endif; ?>
    </strong>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ul class="breadcrumbs">
          <li>
            <?php echo "REFLECTED-XSS"; ?>
          </li>
        </ul>
        <h5 align="center">Mô tả: Chiếm lấy cookie Admin và đăng nhập vào user Admin!</h5>

        <form action="\xss\reflected_xss\reflected.php" method="get" accept-charset="utf-8" id="form">
          Your name: <input type="text" name="name" placeholder="Enter your name" autofocus required>
          <button type="submit" class="primary" value="Submit!">Submit!</button>
        </form>

        <div role="group" class="btn-group">
          <strong>
            Hints<br>
          </strong>
          <button id="btn-1" type="button" title="Hint 1" onclick='alert("Hint này chưa nghĩ ra!")'>1</button>
          <button id="btn-2" type="button" title="Hint 2" onclick='alert("Mã hóa Base64")'>2</button>
        </div>

        <div id="name">
          <?php
          $name = isset($_GET['name']) ? $_GET['name'] : '';
          if (!empty($name)):
            $name = htmlentities($name);
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "xss_reflect";
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            try {
              if (preg_match("/onload/", $name) || preg_match("/location/", $name) || preg_match("/onclick/", $name)
                || preg_match("/onmouse/", $name) || preg_match("/onkey/", $name) || preg_match("/onprint/", $name)
                || preg_match("/onchange/", $name) || preg_match("/onfocus/", $name) || preg_match("/onsubmit/", $name)) {
                echo "<script>alert(\"Hàm/Thuộc tính này đã bị chặn!\")</script>";
              } else {
                $sql = "INSERT INTO any_input (input) VALUES ('$name')";
                if ($conn->query($sql) !== TRUE) {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
              }
            } catch (\Throwable $th) {
              print("Lỗi gì rùi hjhj!");
            }

            $conn->close();
            ?>
            <span class="toast large">
              Hello,
              <?php echo urldecode($name); ?>
            </span>
          <?php endif; ?>
        </div>
        <?php
        // Kết nối với cơ sở dữ liệu
        
        ?>
        <form action="\xss\reflected_xss\reflected.php" method="POST">
          Nhập Flag: <input type="input" name="flag">
          <button type="submit" class="primary" value="Submit!">Submit!</button>
        </form>
        <?php
        $flag = isset($_POST["flag"]) ? $_POST["flag"] : "";
        if ($flag === "") {
          echo "<p>Chưa nhập flag</p>";
        } else if ($flag === "R3f1eCted_xsS!") {
          echo '<script>alert("Win rồi!!! +10 uy tín!")</script>';
        } else {
          echo '<script>alert("Flag sai, hãy thử lại!")</script>';
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>