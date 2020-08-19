<?php 
require('conn.php');
require_once 'bookProcess.php';
?>
	

<!DOCTYPE html>
<html>
<head>
	<title>Book</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
   <style type="text/css">
      a:hover {
      cursor: pointer;
      background-color: yellow;
      }
   </style>
</head>
<body>
	<?php 
	if(isset($_SESSION['message'])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type'] ?>">
			<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);
			?>		
		</div>
	<?php endif ?>
	<div style="float: right; padding: 20px; margin-top: 60px;">
		<h3>Search</h3>

		<label>Search by Book Name: </label><br>
		<input type="text" name="searchName" id="searchName" placeholder="Book Name" />
		<input type="submit" name="searchNamebtn" value="search" id="searchNamebtn"><br>


 	   	<label>Search by Publisher: </label><br>
	   	<input type="text" name="searchPublisher" id="searchPublisher" placeholder="Publisher" />
	   	<input type="submit" name="searchPublisherbtn" value="search" id="searchPublisherbtn"><br>


	   	<label>Search by ISBN: </label><br>
	   	<input type="text" name="searchISBN" id="searchISBN" placeholder="ISBN" />
	   	<input type="submit" name="searchISBNbtn" value="search" id="searchISBNbtn"><br>

		<div id="display"></div>

	</div>

	<div class="container">


		<h1 style="text-align: center;">Book Store</h1></br>
	
	<div class="row">
	<form action= "bookProcess.php" method="POST" enctype="multipart/form-data">
		<h3>Add New Book</h3>
		<input type="hidden" name="id" value="<?php echo $id; ?>">	
			<label>Book Name: </label><br>
			<input type="text" placeholder="BookName" name="bookName" value="<?php echo $bookName; ?>" required><br> 
		    <label>Publisher: </label><br>
			<input type="text" placeholder="Publisher" name="publisher" value="<?php echo $publisher; ?>" required><br>
			<label>ISBN: </label><br>
			<input type="Number" name="ISBN" value="<?php echo $ISBN; ?>" required><br>
			<label>Cover Image:</label><br>
			<input type="file" name="coverImage" value="<?php echo $coverImage; ?>" required><br><br>


		<div class="form-group">
			<?php if($update==TRUE): ?>
				<button type="submit" class="btn btn-info" name="update">Update</button>
			<?php else: ?>
				<button type="submit" class="btn btn-primary" name="add">Add</button>
			<?php endif; ?>
		</div>

	</form>
	</div>
	<?php
		try {

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$page1=0;		
		if(isset($_GET["page"])){
			$page=$_GET["page"];

			if($page=="" || $page=="1"){
				$page1=0;
			}
			else{
				$page1=($page*3)-3;
			}
		}

		$stmt = $conn->prepare("SELECT * FROM book limit $page1,3");
		$stmt->execute();
		$data = $stmt->fetchAll();

		foreach ($data as $row ) {
				
			$id=$row["id"];
			$bookName=$row["name"];
			$publisher=$row["publisher"];
			$ISBN=$row["ISBN"];
			$coverImage=$row["image"];

			echo "<div>";
			echo "Name: ".$bookName."<br>";
			echo "Publisher: ".$publisher."<br>";
			echo "ISBN: ".$ISBN."<br>";
			echo "<img src='img/$coverImage' style='width:130px;height:150px'/><br>";

			echo "<a href='book.php?edit=$id ' class='btn btn-info' >Edit   </a>";
			echo "<a href='book.php?delete=$id ' class='btn btn-danger' >Delete</a>";

			echo "</div>";
		}
		echo "<br><br>";
		$stmt1 = $conn->prepare("SELECT * FROM book ");
		$stmt1->execute();
		$count=$stmt1->rowCount();
		$pages=ceil($count/3);
		for($a=1;$a<=$pages;$a++){
			echo "<a href='book.php?page=$a' style='text-decoration: none'>$a</a>  ";
		}
	
	} catch(PDOException $e) {
		
		echo $sql . "<br>" . $e->getMessage();
	}
	
	?>
</body>
</html>