<html>
<?php
include 'connect.php';

$studentData = "select id,name from student ORDER BY name;";

$exestudentData = $connection->query($studentData);

$studentListRecord = $exestudentData->num_rows;


if(isset($_REQUEST['delete']))
{

$selectedStudId = $_REQUEST['id'];
	
$deleteSelectedStud = "delete from student where id = $selectedStudId"; 
$exeDeleteCat = $connection->query($deleteSelectedStud);

header("Location: stud.php");
}

if(isset($_REQUEST['update']))
{

$selectedStudId = $_REQUEST['id'];
	
$updateSelectedStud = "select * from student where id = $selectedStudId"; 
$exeUpdateStud = $connection->query($updateSelectedStud);
$fetchUpdateStud = $exeUpdateStud->fetch_object();

}

if(isset($_REQUEST['up_btn_update']))
{

$selectedStudId = $_REQUEST['id'];
$updatedStudName = $_REQUEST['up_Stud_name'];	
$updateSelectedStud = "update student SET name = '$updatedStudName' where id = $selectedStudId"; 
$exeUpdateStud = $connection->query($updateSelectedStud);


header("Location: stud.php");
}


if(isset($_REQUEST['btn_submit']))
{
$insertedStudName = $_REQUEST['Stud_name'];

$queryInsertNewstudent = "INSERT INTO `student` (`id`, `name`) VALUES (NULL, '$insertedStudName');";
$exeCatInsert = $connection->query($queryInsertNewstudent); 

header("Location: stud.php");
}


?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {background-color: #008CBA;} /* Blue */
.button3 {background-color: #f44336;} /* Red */ 
.button4 {background-color: #00ff00; color: blue;} /* blue */ 
.button5 {background-color: #555555;} /* Black */
<h2>{
	text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;
	}
</style>

<head>
<title>
STUDENT</title>

<body>

<table border="2" align="center">
	<tr>
	<th colspan="4"><h2>Student List</h2></th>
	</tr>
  <tr>
    <th>student Id</th>
    <th>student Name</th> 
    <th colspan="2">Action</th>
  </tr>
  
  <?php 
  
  if($studentListRecord > 0){
  while($studentDataFetch = $exestudentData->fetch_object())
	{
	 ?>
	 
  <tr>
    <td><?php echo $studentDataFetch->id;?></td>
    <td><?php echo $studentDataFetch->name;?></td>
		<td> <a href="stud.php?id=<?php echo $studentDataFetch->id;?>&update=up1"><button type="button" name ="btn_update" class="button button4" >Update</button> </a></td>
	<td> <a href="stud.php?id=<?php echo $studentDataFetch->id;?>&delete=del1"><button type="button" name ="btn_delete" class="button button3">Delete</button></a> </td>

     </tr>
	
	<?php 
	}
   }
  else{
	  echo "No record found";
  }?>
  
  <tr>
  <th colspan="4"><?php echo "Number of student: $studentListRecord"?></th>
  </tr>
  
</table>
<br>
<br>
<form method = "POST">
<?php 
if(isset($_REQUEST['update']))
{ ?>
<table>
<tr>
<td>student Name: </td>
<td> <input type="text" name="up_Stud_name" value="<?php echo $fetchUpdateStud->name;?>" required> <span class = "error"><?php $errorPrName?><br><br> </td>
</tr>

</table>
<button type="submit" name ="up_btn_update" class="button button4">Update student</button>
<?php } 

else{ ?>

<table>
<tr>
<tr><td>TO ADD A STUDENT </td></tr>
<tr>
<td> <input type="text" name="Stud_name" placeholder="student name" value="" required> <span class = "error"><?php $errorPrName?><br><br> </td>
</tr>

</table>
<button type="submit" name ="btn_submit" class="button button2">Add student</button>

<?php } ?>
</form>

</body>
</head>
</html>