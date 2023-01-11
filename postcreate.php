<?php session_start(); 
error_reporting(0)?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- CSS only -->
		<link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" />
		
		<title>crud</title>
		<style>
			body {
				padding: 50px;
			}
		</style>
	</head>
	<body>
	<?php

	require "connect.php";
	
	$titleError='';
	$descError='';
		if (isset($_POST['crete_post'])) {
		 $title=$_POST['title'];
	     $desc=$_POST['description'];
		 if (empty($title)) {
			 $titleError = "The title field is required";
	     }
		 if (empty($desc)) {
			 $descError = "The description field is required";
		 }
		 
		 if (!empty($title) && !empty($desc)) {
			 mysqli_query($db,"INSERT INTO posts (title,description) VALUES(
		 '$title','$desc')");
		 $_SESSION['successMsg']='success';
		 header('location: index.php');
		 }
	}
	
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-10">
								<div class="card-title">
									Post List
								</div>
							</div>
							<div class="col-md-2">
								<a href="index.php" class="btn btn-primary float-right">&larr;&larr;&larr;Back</a>
							</div>
						</div>
					</div>
					<form action="postcreate.php" method="post">
					<div class="card-body">

					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control <?php
						if ($titleError != ''): ?>is-invalid<?php endif ?>" placeholder="Enter Post Title" value="<?php echo $title ; ?>">
						<span class="text-danger"><?php echo $titleError; ?>	</span>
					</div>
					<div class="form-group">
						<label>
							Description
						</label>
						<textarea class="form-control <?php
						if ($descError != '')
							: ?>is-invalid<?php endif ?>" placeholder="Description" name="description" ><?php echo $desc ; ?></textarea>
						<span class="text-danger"><?php echo $descError; ?></span>
						</div>
		</div>
						<div class="card-footer">
							<button class="btn btn-primary" name="crete_post" type="submit">Create</button>
						</div>
						</form>
				</div>
			
			</div>
		</div>
	</div>
		<!-- JavaScript Bundle with Popper -->
		<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
	</body>
</html