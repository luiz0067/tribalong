<?php
if ($_POST) {
	$folder = "C:\\apache\\htdocs\\TribalONG\\upload\\imagens\\";
	if (
		(
			($_FILES["file"]["type"] == "image/gif")
			|| 
			($_FILES["file"]["type"] == "image/jpeg")
			|| 
			($_FILES["file"]["type"] == "image/pjpeg")
		)
		&& 
		($_FILES["file"]["size"] < 20000)
	)
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
			echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
			$arquivo=$_FILES["file"]["name"];
			$extension=strtolower(end(explode(".", $arquivo)));
			if (file_exists($folder . $arquivo))
			{
				echo "<a href=\"".$folder.$arquivo."\">".$folder.$arquivo."</a><br>";
				$arquivo=time().".".$extension;
				move_uploaded_file(
					$_FILES["file"]["tmp_name"],
					$folder . time().".".$extension
				);
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				$folder . $_FILES["file"]["name"]);
				
				//copy($_FILES["file"]["tmp_name"], "$folder" . $_FILES["file"]["name"]);
				//delete($_FILES["file"]["tmp_name"]);
				echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
		}
	}
	else
	{
		echo "Invalid file";
	}
	$redirect = "upload.php?success";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Upload your file</title>
		<script type="text/javascript">
			if("upload.php?success"="<?php echo $redirect?>")
			self.location.href="./<?php echo $redirect?>";
		</script>
		<!--Progress Bar and iframe Styling-->
		<link href="style_progress.css" rel="stylesheet" type="text/css" />
		<!--Get jQuery-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.js" type="text/javascript"></script>
		<!--display bar only if file is chosen-->
		<script type="text/javascript">

			$(document).ready(function() { 
				var show_bar = 0;
				$('input[type="file"]').click(function(){
				show_bar = 1;
				});

				//show iframe on form submit
				$("#form1").submit(function(){
					if (show_bar === 1) { 
						$('#upload_frame').show();
					function set () {
						$('#upload_frame').attr('src','upload_frame.php?up_id=<?php echo $up_id; ?>');
					}
					setTimeout(set);
					}
				});
				//

			});
		</script>
	</head>
	<body>
		<h1>Upload your file </h1>

		<div>
		<?php if (isset($_GET['success'])) { ?>
		<span class="notice">Your file has been uploaded.</span>
		<?php } ?>
		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
			Name<br />
			<input name="name" type="text" id="name"/>
			<br />
			<br />
			Your email address <br />
			<input name="email" type="text" id="email" size="35" />
			<br />
			<br />
			Choose a file to upload<br />

			<!--APC hidden field-->
			<input type="hidden" name="APC_UPLOAD_PROGRESS" id="progress_key" value="<?php echo $up_id; ?>"/>
			<!---->

			<input name="file" type="file" id="file" size="30"/>

			<!--Include the iframe-->
			<br />
			<iframe id="upload_frame" name="upload_frame" frameborder="0" border="0" src="" scrolling="no" scrollbar="no" > </iframe>
			<br />
			<!---->
			<input name="Submit" type="submit" id="submit" value="Submit" />
		</form>
		</div>

	</body>

</html>