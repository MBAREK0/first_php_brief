<?php
include '../db/conect.php';

$id = isset($_GET['updateid']) ? $_GET['updateid'] : null; 

$AfficherReq = "SELECT * FROM ressources WHERE ressource_id =$id";
$AfficherResult = mysqli_query($db, $AfficherReq);

if ($AfficherResult) {
        $rowS = mysqli_fetch_assoc($AfficherResult);

        $selectedSubCategorie = $rowS['sub_cat_id']; 
        $selectedSubCategorie_req="SELECT nom_sub_categorie FROM subcategory WHERE sub_cat_id=$selectedSubCategorie";
        $AffSubName = mysqli_query($db,$selectedSubCategorie_req);
        $rowSub = mysqli_fetch_assoc( $AffSubName);
        $SubcategorieName=$rowSub['nom_sub_categorie'];

        $selectedCategorie = $rowS['categorie_id']; 
        $selectedCategorie_req="SELECT nom_categorie FROM categorie WHERE categorie_id=$selectedCategorie";
        $AffCatName = mysqli_query($db, $selectedCategorie_req);
        $rowC = mysqli_fetch_assoc( $AffCatName);
        $categorieName=$rowC['nom_categorie'];
}
   //  update 
if ($id !== null) {
    
    if (isset($_POST["updatesubmit"])) {

        $selected_categorie = $_POST['categorieSelect'];
        $selected_sub_categorie = $_POST['subcategorieSelect'];
        
        // Fetching category ID
        $CategorieID_req = "SELECT categorie_id FROM categorie WHERE nom_categorie = '$selected_categorie'";
        $AffCatID = mysqli_query($db, $CategorieID_req);
        
        if ($AffCatID) {
            $rowCI = mysqli_fetch_assoc($AffCatID);
            $categorie_Id = $rowCI['categorie_id'];
        } else {
            // Handle the case where the query failed
            echo "Error fetching category ID: " . mysqli_error($db);
        }
        
        // Fetching sub-category ID
        $SubCategorieID_req = "SELECT sub_cat_id FROM subcategory WHERE nom_sub_categorie = '$selected_sub_categorie'";
        $AffCatSubID = mysqli_query($db, $SubCategorieID_req);
        
        if ($AffCatSubID) {
            $rowSI = mysqli_fetch_assoc($AffCatSubID);
            $Subcategorie_Id = $rowSI['sub_cat_id'];
        } else {
            // Handle the case where the query failed
            echo "Error fetching sub-category ID: " . mysqli_error($db);
        }
        
        // Update query
        $req = "UPDATE ressources SET sub_cat_id='$Subcategorie_Id', categorie_id='$categorie_Id' WHERE ressource_id =$id";
        $result = mysqli_query($db, $req);
        
        if ($result) {
            header("Location: ressources.php");
            echo 'Updated successfully';
        } else {
            // Handle the case where the update query failed
            echo 'Update failed: ' . mysqli_error($db);
        }
    }}

?>