<!-- If this were a real application, we would probably have some links embedded into the form or just below it that would allow us to update, delete or add to our posts, but this is not a fully functioning application.

So we'll just create a field to speciy the id that we want to update. -->


<!-- Change all the table names, i.e. posts to blog_posts -->

<?php
require 'classes/database.php';

//Need to require the Tags class so that we can use the overloaded execute()
require 'classes/tags.php';

$database = new Database;

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(@$_POST['delete']){
    $delete_id = $_POST['delete_id'];
    $database->query('DELETE FROM blogs WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}

// when a post gets submitted, this block is going to check to see if the information is submitted, if it is it's going to get the title and body

//the @ supresses the warning that there is no array key to update in post
if(@$post['update']){
    $id = $post['id'];
    $title = $post['title'];
    $post = $post['post'];


    $database->query('UPDATE blogs SET title = :title, body = :post WHERE id = :id');
    $database->bind(':title', $title);
    ///Change body to post
    $database->bind(':post', $post);

    $database->bind(':id', $id);
    $database->execute();

}
//(4) but now we need to grab the id as well and that is when you will add $id = $post['id'];
if(@$post['submit']){
    $title = $post['title'];

    //Change blog to post.
    $post = $post['post'];

//(5) instead of saying ('INSERT INTO posts (title, body) VALUES(:title, :body)');
    //Change body to post.
    $database->query('INSERT INTO blogs (title, body) VALUES(:title, :post)');
    // (6) title is not bound at this point, copy and paste the bind statement for the title and change :title to title
    $database->bind(':title', $title);
    $database->bind(':post', $post);

    //$database->bind(':id', $id);
    $database->execute();
    if($database->lastInsertId()){
        echo '<p>Post Added!</p>';
    }
}

//Instantiate the Tags class. Use it to make the posts query from the Tags overloaded
// resultset() so that it will merge the tags into the main result set.
//$Tags = new Tags();
//$Tags->query('SELECT * FROM blogs');
//$rows = $Tags->resultset();

$Tags = new Tags;
$Tags->query('SELECT * FROM blogs');
$rows = $Tags->resultset();
?>
<h1>Add Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

    <!-- (2) update this copied form element from Post Title to Post ID and then change the placeholder to "Specify ID", then change the name to "id" instead of "title"... check in the browser -->

    <!-- (3) refresh the browser window to show the newly added form field-->
    <!--this actually make little sense because the id is set to autoincrement... therefore if you submit a string it will still record it as 1,2,3 etc.  -->
    <!-- <label>Post ID</label><br />
    <input type="text" name="id" placeholder="Specify ID" /><br /><br /> -->

    <!-- (1) copy and paste the form element to create a new form feild-->
    <label>Post Title</label><br />
    <input type="text" name="title" placeholder="Add a Title..." /><br /><br />

    <label>Post Body</label><br />
    <textarea name="post"></textarea><br /><br />
    <input type="submit" name="submit" value="Submit" />
</form>

<h1>Posts</h1>
<div>
    <?php foreach($rows as $row) : ?>
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['body']; ?></p>

    <!-- Added the display for tags -->
    <p>Tags: <?php echo $row['tags']; ?></p>

    <br />
    <!--here we are creating a form with the delete button so that we can delete specific conent  -->
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <!--this is sending the id as a hidden input, the value will be the id itself -->
        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
        <input type="submit" name="delete" value="Delete" />
    </form>
</div>
<?php endforeach; ?>
</div>

