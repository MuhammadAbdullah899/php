<?php
//Including Database configuration file.
include "conn.php";
//Getting value of "searchName" variable from "script.js".
if (isset($_POST['searchName'])) {

//Search box value assigning to $Name variable.
  $Name = $_POST['searchName'];
  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT name FROM book WHERE name LIKE '%$Name%' LIMIT 5 ");
    $stmt->execute();
    $data = $stmt->fetchAll();

    //Creating unordered list to display result.
    echo '<ul>';

    foreach ($data as $Result ) {  
    ?>
      <li onclick='fillName("<?php echo $Result['name']; ?>")'>
      <a>
      <!-- Assigning searched result in "Search box" in "search.php" file. -->
         <?php echo $Result['name']; ?>
      </li></a>
    
    <?php
    }
    echo '</ul>';  
  
  } catch(PDOException $e) {
    
    echo $sql . "<br>" . $e->getMessage();
  }

}

if (isset($_POST['searchPublisher'])) {
   $Name = $_POST['searchPublisher'];
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT publisher FROM book WHERE publisher LIKE '%$Name%' LIMIT 5 ");
    $stmt->execute();
    $data = $stmt->fetchAll();

    //Creating unordered list to display result.
    echo '<ul>';

    foreach ($data as $Result ) {  
    ?>
      <li onclick='fillPublisher("<?php echo $Result['publisher']; ?>")'>
      <a>
      <!-- Assigning searched result in "Search box" in "search.php" file. -->
         <?php echo $Result['publisher']; ?>
      </li></a>
    
    <?php
    }
    echo '</ul>';  
  
  } catch(PDOException $e) {
    
    echo $sql . "<br>" . $e->getMessage();
  } 
}


if (isset($_POST['searchISBN'])) {
   $Name = $_POST['searchISBN'];
 try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT ISBN FROM book WHERE ISBN LIKE '%$Name%' LIMIT 5 ");
    $stmt->execute();
    $data = $stmt->fetchAll();

    //Creating unordered list to display result.
    echo '<ul>';

    foreach ($data as $Result ) {  
    ?>
      <li onclick='fillISBN("<?php echo $Result['ISBN']; ?>")'>
      <a>
      <!-- Assigning searched result in "Search box" in "search.php" file. -->
         <?php echo $Result['ISBN']; ?>
      </li></a>
    
    <?php
    }
    echo '</ul>';  
  
  } catch(PDOException $e) {
    
    echo $sql . "<br>" . $e->getMessage();
  } 

}

if(isset($_POST["name"]) )
{
    $name=$_POST['name'];
    try {
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM book WHERE name ='$name'  ");
      $stmt->execute();
      $data = $stmt->fetchAll();
      $rowCount = $stmt->rowCount();

      if($rowCount > 0){
        foreach ($data as $row ){

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
            echo "</div>";
        }
      }else{
              echo '<lable>Book not available</lable>';
      }
  } catch(PDOException $e) {    
    echo $sql . "<br>" . $e->getMessage();
  }
}

if(isset($_POST["publisher"]) )
{
        //Get all state data
        $publisher=$_POST['publisher'];
     try {
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM book WHERE publisher ='$publisher' ");
      $stmt->execute();
      $data = $stmt->fetchAll();
      $rowCount = $stmt->rowCount();

      if($rowCount > 0){
        foreach ($data as $row ){

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
            echo "</div>";
        }
      }else{
              echo '<lable>Book not available</lable>';
      }
  } catch(PDOException $e) {    
    echo $sql . "<br>" . $e->getMessage();
  }
}
if(isset($_POST["ISBN"]) )
{
  $ISBN=$_POST['ISBN'];
    try {
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM book WHERE ISBN ='$ISBN' ");
      $stmt->execute();
      $data = $stmt->fetchAll();
      $rowCount = $stmt->rowCount();

      if($rowCount > 0){
        foreach ($data as $row ){

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
            echo "</div>";
        }
      }else{
              echo '<lable>Book not available</lable>';
      }
  } catch(PDOException $e) {    
    echo $sql . "<br>" . $e->getMessage();
  }     
}
?>