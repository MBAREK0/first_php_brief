<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>CRUD ressources</title>
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

if (isset($_POST["ressSubmit"])) {
    if (!empty($_POST["categorieSelect"]) && !empty($_POST["subcategorieSelect"])) {
        
        $selected_sub_categorie = $_POST["subcategorieSelect"];
        $selected_categorie = $_POST['categorieSelect'];
        //get  the categorie id 
        $categorie_req = "SELECT categorie_id FROM categorie WHERE nom_categorie='$selected_categorie'";
        $aff_categorie_req = mysqli_query($db, $categorie_req);

        if ($aff_categorie_req) {
            $result_categorie_req = mysqli_fetch_assoc($aff_categorie_req);
            $categorie_id = $result_categorie_req['categorie_id'];
			 //get  the subcategorie id 
            $sub_categorie_req = "SELECT sub_cat_id FROM subcategory WHERE nom_sub_categorie='$selected_sub_categorie'";
            $aff_subcategorie_req = mysqli_query($db, $sub_categorie_req);

            if ($aff_subcategorie_req) {
                $result_subcategorie_req = mysqli_fetch_assoc($aff_subcategorie_req);
                $subcategorie_id = $result_subcategorie_req['sub_cat_id'];

                // Check if categorie_id and sub_cat_id already exists
                $checkExistQuery = "SELECT COUNT(*) AS num_rows FROM ressources WHERE categorie_id = $categorie_id AND sub_cat_id = $subcategorie_id";
                $resultExist = mysqli_query($db, $checkExistQuery);

                if ($resultExist) {
                    $rowExist = mysqli_fetch_assoc($resultExist);
                    $numRowsExist = $rowExist["num_rows"];

                    if ($numRowsExist == 0) {
                        //  insert the result of modal
                        $insertQuery = "INSERT INTO ressources (categorie_id, sub_cat_id) VALUES ($categorie_id, $subcategorie_id)";
                        $resultInsert = mysqli_query($db, $insertQuery);

                        if ($resultInsert) {
                            // return to the parent page 
                            header("Location: ressources.php");
                            exit();
                        } else {
                            echo "Error: " . mysqli_error($db);
                        }
                    } else {
                        echo "The values is already exists";
                    }
                } else {
                    echo "Error from  £resultExist " . mysqli_error($db);
                }
            }
        }
    }
	
}
mysqli_close($db);
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
						<h2>Manage <b>Users </b></h2>
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
						<th>ressource id</th>
						<th>Subcategorie </th>
						<th>Categorie </th>
					</tr>
				</thead>
				<tbody>
					<?php
					require '../db/conect.php';
					$AfficherReq ="SELECT ressource_id, nom_sub_categorie, nom_categorie FROM ressources r JOIN categorie c ON r.categorie_id = c.categorie_id JOIN subcategory s ON r.sub_cat_id = s.sub_cat_id";

					$AfficherR=mysqli_query($db,$AfficherReq);
					if($AfficherR){
						
						while($row=mysqli_fetch_assoc($AfficherR)){
							
							$ress_id=$row['ressource_id'];
							$subName=$row['nom_sub_categorie'];
							$cat_name=$row['nom_categorie'];
							echo '<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td>'.$ress_id.'</td>
							<td>'.$subName.'</td>
							<td>'.$cat_name.'</td>
							<td>
								<a href="updateRessource.php? updateid='.$ress_id.'" class="edit" ><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="deletRessource.php?deleteid='.$ress_id.'" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
							</td>
							
						</tr>';
							
						}
						
					}
					mysqli_close($db);
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
			<form action="" method="post" class="formAjout">
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
									
                <?php
				require '../db/conect.php';
    $subRequet = "SELECT * FROM subcategory";
    $subAfficher_requet = mysqli_query($db, $subRequet);
    
    echo '<select name="subcategorieSelect" id="subcategorieSelect">';
	echo '<option value=""></option>';
    while ($sub_selectRow = mysqli_fetch_assoc($subAfficher_requet)) {
        echo '<option value="' . $sub_selectRow['nom_sub_categorie'] . '">' . $sub_selectRow['nom_sub_categorie'] . '</option>';
    }
    echo '</select>';
    echo'<br>'

?>
					<?php
    $requet = "SELECT * FROM categorie";
    $Afficher_requet = mysqli_query($db, $requet);
    
    echo '<select name="categorieSelect" id="categorieSelect">';
	echo '<option value=""></option>';
    while ($selectRow = mysqli_fetch_assoc($Afficher_requet)) {
        echo '<option value="' . $selectRow['nom_categorie'] . '">' . $selectRow['nom_categorie'] . '</option>';
    }
    echo '</select>';
	mysqli_close($db);

?>
						
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add" name="ressSubmit">
				</div>
			</form>
		</div>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>