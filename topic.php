<?php
//topic.php
include 'connect.php';
include 'header.php';
//display selected topic content post

$sql = "SELECT
post_id,
post_content,
post_by,
post_date

FROM
posts
WHERE
post_id = ". mysqli_real_escape_string($conn,$_GET['id']);



include 'footer.php';
?>