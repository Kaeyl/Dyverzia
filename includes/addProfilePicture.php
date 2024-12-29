<?php include "db.php"?>
<?php
if(isset($_POST['create_profile_picture'])){
  $user_profile_image = $_FILES['image']['name'];
  $user_profile_temp = $_FILES['image']['tmp_name'];
  $user_profile_temp = $_FILES['image']['tmp_name'];
  $user_profile_tags = $_POST['post_tags'];
  $user_profile_content = $_POST['post_content'];
  $user_profile_date = date('d-m-y');

  move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "INSERT INTO user_profile_images(user_profile_image_image, user_profile_image_summary, user_profile_image_content, user_profile_tags )";

  $query .= "VALUES({$user_profile_image}','{$post_summary}','{$user_profile_content}','{$user_profile_tags}') ";

  $create_post_query = mysqli_query($connection, $query);

  confirmQuery($create_post_query);

  $the_post_id = mysqli_insert_id($connection);

  echo "<p class='bg-success'>Post Created. <a href='../includes/post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit other Posts</a></p>";
}

?>


<?php
$query = "SELECT * FROM catagories";
$select_categories = mysqli_query($connection, $query);

confirmQuery($select_categories);

while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row ['cat_id'];
    $cat_title = $row ['cat_title'];

    echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }

?>