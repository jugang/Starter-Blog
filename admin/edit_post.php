<?php include 'includes/header.php'; ?>

<?php
$id = $_GET['id'];

//Cereate Database object
$db = new Database();

//Create Query
$query = "SELECT * FROM posts WHERE id =".$id;
//Run Query
$post = $db->select($query)->fetch_assoc();

$query = "SELECT * FROM categories";
$categories = $db->select($query);
?>
<?php
if (isset($_POST['submit'])){

    //Assign Vars
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $author = mysqli_escape_string($db->link, $_POST['author']);
    $tags = mysqli_escape_string($db->link, $_POST['tags']);

    if ($title == '' || $body == '' || $category == '' || $author == ''){
        //Set error
        $error = 'Plies fill all required fields';
    }else {

        $query = "UPDATE posts 
                       SET title = '$title',
                           body = '$body',
                           category = '$category',
                           author = '$author',
                           tags = '$tags'
                           WHERE id =".$id;

        //Run Insert query
        $update_row = $db->update($query);
    }
}
?>
<?php
if (isset($_POST['delete'])){
    $query = "DELETE FROM posts
                    WHERE id=".$id;
    //Call delete method
    $delete_row = $db->delete($query);

}
?>

<form method="post" action="edit_post.php?id=<?php echo $id; ?>">
    <div class="form-group">
        <label>Title</label>
        <input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo $post['title']; ?>">
    </div>
    <div class="form-group">
        <label>Post Body</label>
        <textarea name="body" class="form-control" placeholder="Enter Post Body">
            <?php echo $post['body']; ?>
        </textarea>
    </div>
    <div class="form-group">
        <label>Category</label>
        <select name="category" class="form-control">
            <?php while($row = $categories->fetch_assoc()): ?>
                <?php
                   if ($row['id'] == $post['category']){
                       $selected = "selected";
                   }else{
                       $selected = "";
                   }
                ?>
            <option value="<?php echo $row['id'];?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Author</label>
        <input name="author" type="text" class="form-control" placeholder="Enter Author Name" value="<?php echo $post['author']; ?>">
    </div>
    <div class="form-group">
        <label>Tags</label>
        <input name="tags" type="text" class="form-control" placeholder="Enter Tags" value="<?php echo $post['tags']; ?>">
    </div>
    <div>
        <input name="submit" type="submit" class="btn btn-default" value="Submit">
        <a href="index.php" class="btn btn-default">Cancel</a>
        <input name="delete" type="submit" class="btn btn-default" value="Delete">
    </div>
    <br>
</form>

<?php include 'includes/footer.php'; ?>
