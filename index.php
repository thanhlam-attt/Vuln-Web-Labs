<?php
// unset cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach ($cookies as $cookie) {
    $parts = explode('=', $cookie);
    $name = trim($parts[0]);
    setcookie($name, '', time() - 1000);
    setcookie($name, '', time() - 1000, '/');
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
  <link href="Image/favicon.ico" rel="icon" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
</head>

<body>
  <header>
    <a href="index.php" class="logo">LAB</a>
    <a href="\xss\reflected_xss\reflected.php" class="button">Reflected XSS</a>
    <a href="\xss\stored_xss\stored.php" class="button">Stored XSS</a>
    <a href="\xss\dom_xss\dom.php?default=English" class="button">DOM-based XSS</a>
  </header>
  <div align="center">
    <h4>Chào mừng các hách cơ lỏ đến với trang web của tui!!</h4>
    <img src=/xss/Image/download.jpg>
  </div>


</body>

</html>