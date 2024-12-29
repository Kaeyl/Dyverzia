<!-- INSERT INTO user_hobbies (user_id, hobby_id) VALUES (1, 2);
 this is a query to use when you are ready to implement the Hobby feature -->

<!-- 
 SELECT u.user_name
FROM user_hobbies uh
JOIN users u ON uh.user_id = u.user_id
WHERE uh.hobby_id = 2; 

this is how you will find other users with the same hobbies -->