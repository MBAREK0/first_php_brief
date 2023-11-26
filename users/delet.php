<?php
include '../db/conect.php';
if(isset($_GET['deleteid'])){
	$id=$_GET['deleteid'];
	

	$sql="DELETE FROM users WHERE user_id =$id";
	$result=mysqli_query($db,$sql);
	if($result){
		// echo 'deleted sec';
		header('location:../index.php');
	}else{
		die(mysqli_error($db));
	}
}
?>


