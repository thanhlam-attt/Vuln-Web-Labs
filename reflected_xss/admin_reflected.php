<?php
    setcookie("admin", "dXNldGhpc2Nvb2tpZXRvY2FwdHVyZWZsYWc=")
?>

<!DOCTYPE html>
<html>
<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xss_db";
date_default_timezone_set('Asia/Ho_Chi_Minh');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "SELECT input FROM any_input";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        if (preg_match("/alert/", urldecode($row["input"])) !== false) {
            echo "<td>" . "null" . "</td>";
        } else {
            echo "<td>" . nl2br(urldecode($row["input"])) . "</td>";
        }
    }

?>
<br>
<script>
    var delay = 10000; // Ví dụ: chuyển hướng sau 10 giây

    // Hàm tự động chuyển hướng và trở về trang cũ
    function auto_Load() {
        window.location.href = "http://localhost/XSS/admin_reflected.php";
    }

    // Gọi hàm tự động chuyển hướng và trở về sau khoảng thời gian
    setTimeout(auto_Load, delay);
</script>

</html>