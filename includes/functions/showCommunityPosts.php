<?php
                // $query = "SELECT * FROM user_posts WHERE user_id = {$user_id}";
                $query = "SELECT * FROM community_posts WHERE community_id = {$community_id} AND status = 'approved' ORDER BY post_id DESC";

                $post_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($post_query)) {
                    echo '<li class="activePost">';
                    echo '<div class="postHeading">';
                    echo '<h3>' . htmlspecialchars($row['post_title']) . '</h3>';
                    echo '</div>';
                    echo '<div class="additionalInformation">';
                    echo '<p class="timeStamp">' . "Posted: " . htmlspecialchars($row['post_timestamp']) . '</p>';
                    echo '<p class="category">' . htmlspecialchars($row['community_post_category']) . '</p>';
                    echo '</div>';


                    echo '<p>' . nl2br(htmlspecialchars($row['content'])) . '</p>';
                    if (!empty($row['media_url'])) {
                        echo '<img src="./includes/images/uploads/' . htmlspecialchars($row['media_url']) . '" alt="user post image"><br>';

                    }
                    echo '<div class="userPostButtons">
                        <a href="#"><div class="like"><img src="./includes/images/icons/like.png" alt="thumbs up representing the like button"><p class="likeButton">like</p></div></a>
                        <a href="#"><div class="comment"><img src="./includes/images/icons/comment.png" alt="speech bubble representing the comment button"><p>comment</p></div></a>
                        <a href="#"><div class="share"><img src="./includes/images/icons/share.png" alt="share button"><p class="shareButton">share</p></div></a>
                    </div>';
                    echo '</li>';
                }
                ?>