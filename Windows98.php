<?php
session_start();

// Hash password yang aman - ganti dengan password yang Anda inginkan
$secure_password_hash = '$2y$10$JL6bpbc9NC2yESGLDAeXqec0MmX2Otl425y6xBCGlsiGQUuRgeb4m'; 
$session_key = hash('sha256', $_SERVER['HTTP_HOST']);
$cookie_name = 'auth_' . substr($session_key, 0, 8);
$authenticated = false; // Perbaikan: set ke false sebagai default

// Cek autentikasi
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
            font-family: 'MS Sans Serif', Tahoma, sans-serif;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            cursor: default;
        }
        .desktop-icon {
            position: absolute;
            width: 80px;
            text-align: center;
            font-size: 11px;
            color: white;
            text-shadow: 1px 1px 0px #000;
            cursor: pointer;
        }
        .desktop-icon:hover {
            background-color: rgba(0,0,128,0.5);
            border: 1px dotted white;
        }
        .desktop-icon img {
            width: 32px;
            image-rendering: pixelated;
            display: block;
            margin: 0 auto 4px;
        }
        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #c0c0c0;
            border: 2px outset #c0c0c0;
            width: 340px;
            z-index: 1000;
            font-family: 'MS Sans Serif', Tahoma, sans-serif;
        }
        .login-titlebar {
            background: linear-gradient(90deg, #0a246a 0%, #a6caf0 100%);
            color: #fff;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 11px;
            display: flex;
            align-items: center;
        }
        .login-titlebar img {
            width: 16px;
            margin-right: 6px;
        }
        .login-body {
            padding: 20px;
            background: #c0c0c0;
        }
        .login-body label {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            color: #000;
        }
        .login-body input[type=password] {
            width: calc(100% - 8px);
            padding: 3px;
            margin-bottom: 15px;
            border: 2px inset #c0c0c0;
            font-size: 11px;
            background-color: #fff;
            color: #000;
            font-family: 'MS Sans Serif', Tahoma, sans-serif;
        }
        .login-body input[type=submit] {
            width: 100%;
            background-color: #c0c0c0;
            color: #000;
            border: 2px outset #c0c0c0;
            padding: 6px;
            font-weight: normal;
            font-size: 11px;
            cursor: pointer;
            font-family: 'MS Sans Serif', Tahoma, sans-serif;
        }
        .login-body input[type=submit]:active {
            border: 2px inset #c0c0c0;
        }
        .login-body input[type=submit]:hover {
            background-color: #d0d0d0;
        }
        .feeling-window {
            position: absolute;
            width: 160px;
            background: #c0c0c0;
            border: 2px outset #c0c0c0;
            z-index: 999;
            font-size: 11px;
            font-family: 'MS Sans Serif', Tahoma, sans-serif;
        }
        .feeling-titlebar {
            background: linear-gradient(90deg, #0a246a 0%, #a6caf0 100%);
            color: #fff;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 11px;
        }
        .feeling-body {
            padding: 10px;
            background: #c0c0c0;
            color: #000;
        }
        .error-message {
            color: red;
            font-size: 11px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="desktop-icon" style="top: 20px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/folder_file-4.png" alt="My Documents">
        <div>My Documents</div>
    </div>
    <div class="desktop-icon" style="top: 100px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/computer_explorer-2.png" alt="My Computer">
        <div>My Computer</div>
    </div>
    <div class="desktop-icon" style="top: 180px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/recycle_bin_empty-4.png" alt="Recycle Bin">
        <div>Recycle Bin</div>
    </div>
    <div class="desktop-icon" style="top: 260px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/msie1-2.png" alt="Internet Explorer">
        <div>Internet Explorer</div>
    </div>
    <div class="desktop-icon" style="top: 340px; left: 20px;">
        <img src="https://win98icons.alexmeub.com/icons/png/network_cool_two_pcs-4.png" alt="Network">
        <div>Network</div>
    </div>

    <div class="login-box">
        <div class="login-titlebar">
            <img src="https://win98icons.alexmeub.com/icons/png/key_win-4.png" alt="Key">
            Password Required
        </div>
        <div class="login-body">
HTML;
    
    // Tampilkan pesan error jika login gagal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        echo '<div class="error-message">Invalid password. Please try again.</div>';
    }
    
    echo <<<HTML
            <form method="post">
                <label for="password">Enter Password:</label>
                <input type="password" name="password" id="password" required autofocus>
                <input type="submit" value="OK">
            </form>
        </div>
    </div>

    <script>
    function spawnFeelingWindow() {
        // Batasi jumlah window yang muncul bersamaan
        const existingWindows = document.querySelectorAll('.feeling-window');
        if (existingWindows.length >= 3) return;
        
        const w = document.createElement('div');
        w.className = 'feeling-window';
        w.style.top = Math.random() * (window.innerHeight - 120) + 20 + 'px';
        w.style.left = Math.random() * (window.innerWidth - 180) + 20 + 'px';
        w.innerHTML = '<div class="feeling-titlebar">System Alert</div><div class="feeling-body">Are you feeling OK today?</div>';
        document.body.appendChild(w);
        
        // Hapus window setelah 3 detik
        setTimeout(() => { 
            if (w.parentNode) {
                w.remove(); 
            }
        }, 3000);
    }
    
    // Spawn window setiap 2 detik
    setInterval(spawnFeelingWindow, 2000);
    
    // Tambahkan efek klik pada desktop icons
    document.querySelectorAll('.desktop-icon').forEach(icon => {
        icon.addEventListener('dblclick', function() {
            alert('This feature is not available in demo mode.');
        });
    });
    </script>

</body>
</html>
HTML;
    exit;
}

function show_authenticated_content() {
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Windows 98 Desktop - Authenticated</title>
    <link rel="icon" type="image/x-icon" href="https://win98icons.alexmeub.com/icons/ico/msie1-2.ico">
    <style>
        body {
            background-color: #008080; 
            font-family: 'MS Sans Serif', Tahoma, sans-serif;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .taskbar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background: #c0c0c0;
            border-top: 2px outset #c0c0c0;
            display: flex;
            align-items: center;
            z-index: 1000;
        }
        .start-button {
            background: #c0c0c0;
            border: 2px outset #c0c0c0;
            padding: 4px 8px;
            margin: 2px;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .start-button:active {
            border: 2px inset #c0c0c0;
        }
        .start-button img {
            width: 16px;
            margin-right: 4px;
        }
        .welcome-window {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: #c0c0c0;
            border: 2px outset #c0c0c0;
            z-index: 999;
        }
        .window-titlebar {
            background: linear-gradient(90deg, #0a246a 0%, #a6caf0 100%);
            color: #fff;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 11px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .window-controls {
            display: flex;
            gap: 2px;
        }
        .window-control {
            width: 16px;
            height: 14px;
            background: #c0c0c0;
            border: 1px outset #c0c0c0;
            font-size: 8px;
            line-height: 12px;
            text-align: center;
            cursor: pointer;
            color: #000;
        }
        .window-control:active {
            border: 1px inset #c0c0c0;
        }
        .window-body {
            padding: 20px;
            background: #c0c0c0;
            text-align: center;
        }
        .logout-btn {
            background: #c0c0c0;
            border: 2px outset #c0c0c0;
            padding: 6px 12px;
            font-size: 11px;
            cursor: pointer;
            margin-top: 15px;
        }
        .logout-btn:active {
            border: 2px inset #c0c0c0;
        }
    </style>
</head>
<body>

    <div class="welcome-window">
        <div class="window-titlebar">
            <span>Welcome!</span>
            <div class="window-controls">
                <div class="window-control">_</div>
                <div class="window-control">□</div>
                <div class="window-control" onclick="document.querySelector('.welcome-window').style.display='none'">×</div>
            </div>
        </div>
        <div class="window-body">
            <h3>Authentication Successful!</h3>
            <p>Welcome to the Windows 98 Desktop environment.</p>
            <p>You have successfully logged in to the system.</p>
            <form method="post" style="display: inline;">
                <input type="hidden" name="logout" value="1">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="taskbar">
        <div class="start-button">
            <img src="https://win98icons.alexmeub.com/icons/png/windows-0.png" alt="Start">
            Start
        </div>
    </div>

</body>
</html>
HTML;
    exit;
}

// Proses logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $_SESSION[$session_key] = false;
    unset($_SESSION[$session_key]);
    setcookie($cookie_name, '', time() - 3600, "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Main logic
if (!$authenticated) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if (password_verify($_POST['password'], $secure_password_hash)) {
            $_SESSION[$session_key] = true;
            setcookie($cookie_name, hash('sha256', $secure_password_hash), time() + 3600, "/", "", false, true);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            show_login_form();
        }
    } else {
        show_login_form();
    }
} else {
    show_authenticated_content();
}
?>
