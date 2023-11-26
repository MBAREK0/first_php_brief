<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title> CRUD categories </title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../stayle.css">


</head>
<body>
	<?php
require '../db/conect.php';
   if(isset($_POST["categorieSubmit"])){
	if( !empty($_POST["categorieName"])){
		$categorie_name = $_POST["categorieName"];
		
		$req = "SELECT * FROM categorie WHERE nom_categorie='$categorie_name'";
		$results= mysqli_query($db,$req);
        $num_rows = mysqli_num_rows($results);

        if( $num_rows==0){
            $req = "INSERT INTO categorie (nom_categorie) VALUES ('$categorie_name')";
		    $result= mysqli_query($db,$req);
        }
	}
   }

	?>
  <!-- include nav and side bar here  -->
  <?php require '../nav.php' ?>
    <?php require '../sidebar.php' ?>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper col-6 container">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
							
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>id</th>
						<th>NameCategoie</th>
						
						
						
					</tr>
				</thead>
				<tbody>
					<?php
					$AfficherReq ="SELECT * FROM categorie";
					$AfficherResult=mysqli_query($db,$AfficherReq);
					if($AfficherResult){
						while($row=mysqli_fetch_assoc($AfficherResult)){
							$id=$row['categorie_id'];
							$name=$row['nom_categorie'];
							echo '	<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td>'.$id.'</td>
							<td>'.$name.'</td>
							
							<td>
								<a href="updateCategorie.php? updateid='.$id.'" class="edit" ><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="deletCategorie.php?deleteid='.$id.'" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
							</td>
						</tr>';
							
						}
						
					}
					
					?>
				</tbody>
			</table>
			
		</div>
	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post" class="formAjoutt">
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
									
					<div class="form-group">
						<label for="categorieName">Name</label>
						<input type="text" class="form-control" name="categorieName" required>
					</div>	
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add" name="categorieSubmit">
				</div>
			</form>
		</div>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>