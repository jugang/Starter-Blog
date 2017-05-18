<?php include 'includes/header.php'; ?>
<?php
//Cereate Database object
$db = new Database();

if (isset($_POST['submit'])){

    //Assign Vars
    $name = mysqli_real_escape_string($db->link, $_POST['name']);

    if ($name == ''){
        //Set error
        $error = 'Plies fill all required fields';
    }else {

        $query = "INSERT INTO categories (name)
                    VALUES ('$name')";

        //Run Insert query
        $insert_row = $db->insert($query);
    }
}
?>

    <form method="post" action="add_category.php">
        <div class="form-group">
            <label>Title</label>
            <input name="name" type="text" class="form-control" placeholder="Enter Category">
        </div>
        <div>
            <input name="submit" type="submit" class="btn btn-default" value="Submit">
            <a href="index.php" class="btn btn-default">Cancel</a>
        </div>
        <br>
    </form>

<?php include 'includes/footer.php'; ?>