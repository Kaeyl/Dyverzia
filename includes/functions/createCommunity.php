<?php
                if (isset($_POST['submit'])) {
                    $postContent = $_POST['textareaPostField'];
                    $userPicUpload = $_POST['user_pic'];
                    $userPostTitle = $_POST['titlePostField'];

                    if (!empty($postContent)) {
                        $postContent = mysqli_real_escape_string($connection, htmlspecialchars($postContent, ENT_QUOTES, 'UTF-8'));
                        $post_date = date('d-m-y');

                        $query = "INSERT INTO user_posts (user_id, post_title, content, media_url, post_timestamp) VALUES ('{$user_id}', '{$userPostTitle}', '{$postContent}', '{$userPicUpload}', '{$post_date}')";
                        $register_user_query = mysqli_query($connection, $query);
                        if (!$register_user_query) {
                            die("QUERY FAILED: " . mysqli_error($connection));
                        }
                    } else {
                        $message = "Fields cannot be empty";
                    }
                }
                ?>



