<?php
include '../db/conect.php';
if(isset($_GET['deleteid'])){
	$id=$_GET['deleteid'];
	

	$sql="DELETE FROM categorie WHERE categorie_id =$id";
	$result=mysqli_query($db,$sql);
	if($result){
		// echo 'deleted sec';
		 header('location:categories.php');
       
	}else{
		die(mysqli_error($db));
	}
}
?>

