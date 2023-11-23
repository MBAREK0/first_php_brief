
<?php
include 'db/conect.php';

$id = isset($_GET['updateid']) ? $_GET['updateid'] : null; 

$AfficherReq = "SELECT * FROM users WHERE user_id=$id";
$AfficherResult = mysqli_query($db, $AfficherReq);

if ($AfficherResult) {
    while ($row = mysqli_fetch_assoc($AfficherResult)) {
        $id = $row['user_id'];
        $name = $row['u_name'];
        $email = $row['u_email'];
    }
}

if ($id !== null) {
    
    if (isset($_POST["updatesubmit"])) {
        $user_name = $_POST["userNom"];
        $user_email = $_POST["userEmail"];
     
        $req = "UPDATE users SET u_name='$user_name',u_email='$user_email' WHERE user_id=$id";
        $result = mysqli_query($db, $req);
        
        if ($result) {
            header("Location: index.php");
            echo 'Updated successfully';
        } else {
            die(mysqli_error($db));
        }
    }
   
} else {
    echo 'nooooooooooo';
    header("Location: index.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Update CRUD</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container col-6">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" class="formedite">
                    <div class="modal-header">                        
                        <h4 class="modal-title">Update Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userNom">Name</label>
                            <input type="text" class="form-control" name="userNom" value="<?php echo $name ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" class="form-control" value="<?php echo $email ?>" name="userEmail" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Update" name="updatesubmit">
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>