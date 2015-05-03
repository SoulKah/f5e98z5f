<?php
include_once 'includes/_connect.php';
include_once 'includes/_functions.php';
 
session_start();

if (login_check($mysqli) == true) :
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Uploader</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css" >	
</head>
<body>
	<div class="container">
		<div class="form-container">
            <?php $token = $_GET['token']; ?>
			<form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="ajax.php?token=<?php echo $token; ?>">
				<div class="form-group">
					<p>Selecteer afbeeldingen: </p>
					<input class='file' multiple="multiple" type="file" class="form-control" name="images[]" id="images" placeholder="Selecteer afbeeldingen">
					<span class="help-block"></span>
				</div>
				<div id="loader" style="display: none;">
					Uploaden...
				</div>
				<input type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
			</form>
		</div>
		<div class="clearfix"></div>
		<div id="uploaded_images" class="uploaded-images">
			<div id="error_div">
			</div>
			<div id="success_div">
                <a href="../../admin/view.php"><input type="button" value="Opslaan" class="btn"/></a>
			</div>
		</div>
	</div>
	<input type="hidden" id='base_path' value="<?php echo BASE_PATH; ?>">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>

<?php else :
    header("Location: ../admin");
endif; ?>