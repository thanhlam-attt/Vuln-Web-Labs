<!-- Trang này không dùng tới, code cho vui thôi -->

<?php
setcookie("Admin:", "Cookieofadmin!")
?>
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

// Truy vấn cơ sở dữ liệu để lấy ra các bình luận đã được lưu
$sql = "SELECT name, comment, timestamp FROM comments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị các bình luận trên trang web
    echo "<table>";
    echo "<tr><th>Tên user</th><th>Comment</th><th>Thời gian</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        if (
            preg_match("/onload/", $row["comment"]) || preg_match("/location/", $row["comment"]) || preg_match("/onclick/", $row["comment"])
            || preg_match("/onmouse/", $row["comment"]) || preg_match("/onkey/", $row["comment"]) || preg_match("/onprint/", $row["comment"])
            || preg_match("/onchange/", $row["comment"]) || preg_match("/onfocus/", $row["comment"]) || preg_match("/onsubmit/", $row["comment"])
        ) {
            echo "<td>" . "null" . "</td>";
        }else {
            echo "<td>" . nl2br(urldecode($row["comment"])) . "</td>";
        }
        echo "<td>" . $row["timestamp"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Chưa có bình luận nào.";
}

$conn->close();
?>
<script>
    var delay = 5000; // Ví dụ: chuyển hướng sau 5 giây

    // Hàm tự động chuyển hướng và trở về trang cũ
    function auto_Load() {
        window.location.href = "http://localhost/xss/admin_stored.php";
    }

    // Gọi hàm tự động chuyển hướng và trở về sau khoảng thời gian
    setTimeout(auto_Load, delay);
</script>