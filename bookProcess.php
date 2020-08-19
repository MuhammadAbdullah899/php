<?php require('conn.php'); 
include("utility.php");

$id=0;
$bookName="";
$publisher="";
$ISBN="";
$coverImage="";
$update=FALSE;

if(isset($_POST['add']))
{
	$bookName=$_REQUEST["bookName"];
	$publisher=$_REQUEST["publisher"];
	$ISBN=$_REQUEST["ISBN"];
	
	$file=$_FILES["coverImage"];
	$srcPath=$file["tmp_name"];
	$fileName=$file["name"];
	
	$newName=saveFile($srcPath,$fileName);// this function is in "utility.php" file


	try {
	  // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		$stmt = $conn->prepare("SELECT * FROM book WHERE name='$bookName' and publisher='$publisher' and ISBN='$ISBN' and image='$newName' ");
		$stmt->execute();
		$recordsFound = $stmt->rowCount();
		if($recordsFound > 0)
		{
			$_SESSION['message']="Book already exist!";
			$_SESSION['msg_type']="danger";
		}
		else
		{
			$stmt = $conn->prepare("INSERT INTO book (name,publisher,ISBN,image)
			VALUES (:name, :publisher, :ISBN, :image)");
			$stmt->bindParam(':name', $bookName);
			$stmt->bindParam(':publisher', $publisher);
			$stmt->bindParam(':ISBN', $ISBN);
			$stmt->bindParam(':image', $newName);

			$stmt->execute();			

			$_SESSION['message']="Book has been added!";
			$_SESSION['msg_type']="success";
		}

	} catch(PDOException $e) {
		
		$_SESSION['message']="Book has not been added!";
		$_SESSION['msg_type']="danger";

		echo $sql . "<br>" . $e->getMessage();
	}
	
	header("location: book.php");
}
if(isset($_GET['delete']))
{
	$id=$_GET['delete'];

	try {
	  // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "DELETE FROM book WHERE id='$id' ";
		$conn->exec($sql);
		
		$_SESSION['message']="Book has been deleted!";
		$_SESSION['msg_type']="danger";

	} catch(PDOException $e) {
		
		$_SESSION['message']="Book has not been deleted!";
		$_SESSION['msg_type']="danger";
	  	echo $sql . "<br>" . $e->getMessage();
	}

	header("location: book.php");
}
if(isset($_GET['edit']))
{
	$id=$_GET['edit'];
	$update=TRUE;

	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		$stmt = $conn->prepare("SELECT * FROM book WHERE id='$id' ");
		$stmt->execute();

		$recordsFound = $stmt->rowCount();
		if($recordsFound == 1)
		{
			$row = $stmt->fetch();
			$bookName=$row['name'];
			$publisher=$row['publisher'];
			$ISBN=$row['ISBN'];
			$coverImage=$row['image'];
		}
	} catch(PDOException $e) {
		
		echo $sql . "<br>" . $e->getMessage();
	}
}
if(isset($_POST['update']))
{
	$id=$_POST['id'];
	$bookName=$_POST['bookName'];
	$publisher=$_POST['publisher'];
	$ISBN=$_POST['ISBN'];

	$file=$_FILES["coverImage"];
	$fileName=$file["name"];

	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		$stmt = $conn->prepare("SELECT * FROM book WHERE name='$bookName' and publisher='$publisher' and ISBN='$ISBN' and image='$fileName' ");
		$stmt->execute();
		$recordsFound = $stmt->rowCount();
		if($recordsFound > 0)
		{
			$_SESSION['message']="Book already exist!";
			$_SESSION['msg_type']="danger";
		}
		else
		{
			$srcPath=$file["tmp_name"];
			$newName=saveFile($srcPath,$fileName);

			$sql = "UPDATE book SET name='$bookName' , publisher='$publisher', ISBN='$ISBN', image='$newName' WHERE id='$id' ";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$_SESSION['message']="Book has been updated successfully!";
			$_SESSION['msg_typpe']="warning";	
	
		}

	} catch(PDOException $e) {

		$_SESSION['message']="Book has not been updated successfully!";
		$_SESSION['msg_typpe']="danger";
		echo $sql . "<br>" . $e->getMessage();
	}
	header("location: book.php");
}
?>