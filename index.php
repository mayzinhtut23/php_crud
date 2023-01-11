<?php
session_start();
require "connect.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- CSS only -->
		<link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" />
			<meta charset="utf-8">
		<title>crud</title>
		<style>
			body {
				padding: 50px;
			}
		</style>
	</head>
	<body>
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
			<a href="postcreate.php" class="btn btn-primary float-right">+ Add New</a>
							</div>
						</div>
			</div>
					<div class="card-body">
		<?php
		if(isset($_SESSION['successMsg'])):
		?>				
	<div class="alert alert-success alert-dismissible fade show" role="alert">							<?php
							echo $_SESSION['successMsg'];
							unset($_SESSION['successMsg']); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php endif ?>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody
							<?php
							$query="SELECT * FROM posts";
							$posts = mysqli_query($db,$query);
							foreach( $posts as $post){
							?>								
								<tr>
									<td><?php echo $post['id']?></td>
									<td><?php echo $post['title'] ?></td>
									<td><?php echo $post['description'] ?></td>
									<td>
										<a href="postedit.php?postId=<?php echo $post['id']; ?>">Edit</a>|
										<a href="index.php?post_delete=<?php echo $post['id']; ?>"onclick="return confirm('Are you sure you want to delete?')">Delete</a>
									</td>
								</tr> <?php }
								
								?>
							</tbody>
						</table></div>
				</div>
			</div>
		</div>
	</div>
<?php
if (isset($_GET['post_delete'])) {
	$post_delete=$_GET['post_delete'];
	$query = "DELETE FROM posts WHERE id=$post_delete";
	mysqli_query($db,$query);
	$_SESSION['successMsg']="A post deleted successfully";
	header('location: index.php');
}
 ?>
		<!-- JavaScript Bundle with Popper -->
		<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"> </script>
	</body>
</html>