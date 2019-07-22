<?php
//topic.php
include 'connect.php';
include 'header.php';
//display selected topic content post

$sql = "SELECT
posts.post_id,
posts.post_content,
posts.post_by,
posts.post_date,
topics.topic_subject

FROM
posts

-- LEFT JOIN
--         topics
--  ON
--         posts.post_topic = topics.topic_id
WHERE
posts.post_id = ". mysqli_real_escape_string($conn,$_GET['id'])  ;


$result = mysqli_query($conn, $sql);
 
if(!$result)
{
    echo 'The Topic could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'There is no post in the Topic.';
    }
    else
    {
        //display post data
        while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h1>'.$row['post_id'].'<h1> ';
                        echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td class="rightpart">';
                            echo '<h3>'.$row['post_content'].'<h3>';
                        echo '</td>';
                    echo '</tr>';
                }
     

    //     $sql = "SELECT
    //     posts.post_topic,
    //     posts.post_content,
    //     posts.post_date,
    //     posts.post_by,
    //     users.user_id,
    //     users.user_name
    // FROM
    //     posts
    // LEFT JOIN
    //     users
    // ON
    //     posts.post_by = users.user_id
    // WHERE
    //     posts.post_topic = " 
    //     . mysqli_real_escape_string($conn,$_GET['id']);
         
    //     $result = mysqli_query($conn, $sql);
         
        // if(!$result)
        // {
        //     echo 'The posts could not be displayed, please try again later.';
        // }
        // else
        // {
        //     if(mysqli_num_rows($result) == 0)
        //     {
        //         echo 'There are no posts in this category yet.';
        //     }
        //     else
        //     {
        //         //prepare the table
        //         echo '<table border="1">
        //               <tr>
        //                 <th>Topic</th>
        //                 <th>Created at</th>
        //               </tr>'; 
                     
        //         while($row = mysqli_fetch_assoc($result))
        //         {               
        //             echo '<tr>';
        //                 echo '<td class="leftpart">';
        //                     echo '<h3><a href="topic.php?id=' . $row['post_by'] . '">' . $row['post_content'] . '</a><h3>';
        //                 echo '</td>';
        //                 echo '<td class="rightpart">';
        //                     echo date('d-m-Y', strtotime($row['post_date']));
        //                 echo '</td>';
        //             echo '</tr>';
        //         }
        //     }
        // }
    }
}



include 'footer.php';
?>