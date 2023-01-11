<?php
session_start();
require "connect.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
<!-- CSS only -->
<meta charset="utf-8">
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- CSS only -->
<link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" />
<title>Post Edit</title>
<style>
body {
padding: 50px;
}
</style>
</head>
<body>
<?php
if (isset($_GET['postId'])) {
$update_post =$_GET['postId'];
$post=mysqli_query($db,"SELECT * FROM posts WHERE id=$update_post");
if(mysqli_num_rows($post)==1){
foreach ($post as $row) {
$titleId= $row['id'];
$title = $row['title'];
$description = $row['description'];
}		
}
}
//update post
$titleError="";
$descError="";
if (isset($_POST['update_post'])) {
$pID= $_POST['postId'];
$title = $_POST['title'];
$desc =$_POST['description'];
if (empty($title)) {
	$titleError = "The title field is required";
}
if (empty($desc)) {
	$descError = "The description field is required";
}
if (!empty($title) && !empty($desc)) {
	$query = "UPDATE posts SET title='$title', description='$desc' WHERE id=$pID";
	mysqli_query($db,$query);
	$_SESSION['successMsg']='A post Updated successfully';
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
Post Edition Form
</div>
</div>
<div class="col-md-2">
<a href="index.php" class="btn btn-primary float-right">&larr;&larr;&larr;Back</a>
</div>
</div>
</div>
<form action="" method="post">
<div class="card-body">
<input type="hidden" name="postId" value="<?php echo $titleId; ?>"/>
<div class="form-group">
<label>Title</label>
<input type="text" name="title" class="form-control <?php
if ($titleError != '')
	: ?>is-invalid<?php endif ?>" placeholder="Enter Post Title" value="<?php echo $title; ?>">
<span class="text-danger">
<?php echo $titleError ?>
</span>
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
<button class="btn btn-primary" name="update_post" type="submit">Update</button>
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