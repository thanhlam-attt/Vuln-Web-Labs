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

        <form action="reflected.php" method="get" accept-charset="utf-8" id="form">
          <fieldset>Your name: <input type="text" name="name" placeholder="Enter your name" autofocus required>
            <button type="submit" class="primary" value="Submit!">Submit!</button>
          </fieldset>
        </form>

        <div role="group" class="btn-group">
          <strong>
            Hints<br>
          </strong>
          <button type="button" title="Hint 1" onclick='alert("Alert \"Flag\" to win!")'>1</button>
          <button type="button" title="Hint 2" onclick='alert("Base64")'>2</button>
          <button type="button" title="Hint 3" onclick='alert("\"Somethings\" is removed")'>3</button>
        </div>

        <form action="reflected.php" method="POST">
          <fieldset>Nhập Flag: <input type="input" name="flag">
            <button type="submit" class="primary" value="Submit!">Submit!</button>
          </fieldset>
        </form>
        <?php
        $flag = isset($_POST["flag"]) ? $_POST["flag"] : "";
        if ($flag === "") {
          echo "<p>Chưa nhập flag</p>";
        } else if ($flag === "R3f1eCted_xsS!") {
          echo '<script>
                alert("Win rồi!!! +10 uy tín!")
                setTimeout(function() {
                          window.location.href = "../login/login.php";
                }, 500);
                </script>';

        } else {
          echo '<script>alert("Flag sai, hãy thử lại!")</script>';
        }
        ?>

        <span class="toast large">
          Hello,
          <?php
          $name = isset($_GET['name']) ? $_GET['name'] : '0';
          $name = urldecode($name);
          $name = htmlentities($name);
          $name = str_replace("Flag", "", $name);
          $pattern = '/>alert\("Flag"\)/';
          $pattern_1 = '/alert\("Flag"\)>/';
          if (preg_match($pattern, urldecode($name)) || preg_match($pattern_1, urldecode($name))) {
            echo "<script>alert(\"dXNldGhpc2Nvb2tpZXRvY2FwdHVyZWZsYWc\")</script>";
          }
          echo urldecode($name);
          ?>
        </span>


      </div>
    </div>
  </div>

</body>

</html>