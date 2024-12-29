<?php include "../includes/db.php";?>

<?php


if(isset($_POST['create_post'])){
  $post_id = '';
  // $user_id = $_SESSION['user_id'];
  $user_id = 2;
  $media_type = 'image';
  // $url = 'test';
  // $post_author = $_POST['username'];
  // $post_category_id = $_POST['post_category'];
  // $post_status = $_POST['post_status'];

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  // $post_tags = $_POST['post_tags'];
  // $post_content = $_POST['post_content'];
  $post_content = 'test content';
  // $post_summary = $_POST['post_summary'];
  $post_date = date('d-m-y');

  move_uploaded_file($post_image_temp, "../includes/images/$post_image");

  // post_id	user_id	content	media_type	media_url	post_timestamp

  $query = "INSERT INTO user_posts(post_id, user_id, content, media_type, media_url, post_timestamp)";

  $query .= "VALUES('{$post_id}','{$user_id}','{$post_content}','{$media_type}', '{$post_image}', '{$post_date}') ";

// echo $query;

  $create_post_query = mysqli_query($connection, $query);

  // confirmQuery($create_post_query);

  $the_post_id = mysqli_insert_id($connection);
}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
  <label for="post_content">content</label>
  <input type="text" class="form-control" name="post_content">
</div>

</div>


<div class="form-group">
  <label for="post_image">Post Image</label>
  <input type="file" name="image">
</div>

<!-- <div class="form-group">
  <label for="post_tags">Post Tags</label>
  <input type="text" class="form-control" name="post_tags">
</div> -->

<div class="form-group">
  <input  class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>

</form>
