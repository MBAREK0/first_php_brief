<?php


include '../db/conect.php';
//-----------------------------------------------------------count the number of users 
$count_user_Query = "SELECT COUNT(*) as count FROM users ";
 
$user_result = mysqli_query($db, $count_user_Query);

 // Check the query is a succ
if ($user_result) {

    $user_row = mysqli_fetch_assoc($user_result);
    $user_row_Count = $user_row['count'];

    // echo "The count is: $user_row_Count";
} else {
    echo "Query failed: " . mysqli_error($db);
}

//-----------------------------------------------------------count the number of categories 
$count_categorie_Query = "SELECT COUNT(*) as count FROM categorie ";
 
$categorie_result = mysqli_query($db, $count_categorie_Query);

 // Check the query is a succ
if ($categorie_result) {

    $categorie_row = mysqli_fetch_assoc($categorie_result);
    $categorie_row_Count = $categorie_row['count'];

    // echo "The cat count is: $categorie_row_Count";
} else {
    echo "Query failed: " . mysqli_error($db);
}

//----------------------------------------------------------count the number of subcategories 
$count_subcategory_Query = "SELECT COUNT(*) as count FROM subcategory ";
 
$subcategory_result = mysqli_query($db, $count_subcategory_Query);

 // Check the query is a succ
if ($subcategory_result) {

    $subcategory_row = mysqli_fetch_assoc($subcategory_result);
    $subcategory_row_Count = $subcategory_row['count'];

    // echo "The subcategory count is: $categorie_row_Count";
} else {
    echo "Query failed: " . mysqli_error($db); 
}

//-------------------------------------------------------------count the number of ressources 
$count_ressources_Query = "SELECT COUNT(*) as ressources_count FROM ressources ";
 
$ressources_result = mysqli_query($db, $count_ressources_Query);

 // Check the query is a succ
if ($ressources_result) {

    $ressources_row = mysqli_fetch_assoc($ressources_result);
    $ressources_row_Count = $ressources_row['ressources_count'];

    // echo "The ressources count is: $ressources_row_Count";
} else {
    echo "Query failed: " . mysqli_error($db); 
}


// Close the database connection
mysqli_close($db);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>statistiques</title>
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
<body >
    <!-- include nav and side bar here  -->
    <?php require '../nav.php' ?>
    <?php require '../sidebar.php' ?>

<div class="container d-flex gap-3 mt-3 " >
<img src="../picturs/R.jpg" style =" max-width:80%"alt="statistique">
  <div>
<div class="card text-bg-primary mb-3" style="width: 18rem; text-align:center;">
  <div class="card-header  fs-5 ">USERS</div>
  <div class="card-body">
    <h1 class="card-title"><?php echo $user_row_Count; ?></h1>
 
  </div>
</div>
  <!-- -------------- -->
  <div class="card text-bg-success mb-3" style="width: 18rem; text-align:center;">
  <div class="card-header  fs-5 "> categories</div>
  <div class="card-body">
  <h1 class="card-title"><?php echo  $categorie_row_Count; ?></h1>
 
  </div>
</div>
<!-- -------------- -->
<div class="card text-bg-danger mb-3" style="width: 18rem; text-align:center;">
  <div class="card-header  fs-5 "> subcategories</div>
  <div class="card-body">
  <h1 class="card-title"><?php echo  $subcategory_row_Count; ?></h1>
 
  </div>
</div>
<!-- -------------- -->
<div class="card text-bg-warning mb-3" style="width: 18rem; text-align:center; color: white !important;">

  <div class="card-header fs-5  ">ressources</div>
  <div class="card-body">
  <h1 class="card-title"><?php echo  $ressources_row_Count; ?></h1>
 
  </div>
</div>


</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>