<?php
include '../db/conect.php';
if(isset($_GET['deleteid'])){
	$id=$_GET['deleteid'];
	

	$sql="DELETE FROM users WHERE user_id =$id";
	$result=mysqli_query($db,$sql);
	if($result){
		// echo 'deleted sec';
		header('location:index.php');
	}else{
		die(mysqli_error($db));
	}



}
?>
<!-- <td>
							<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td> -->

