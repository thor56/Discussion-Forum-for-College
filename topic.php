<?php
//topic.php
include 'connect.php';
include 'header.php';
//display selected topic content post



$sql = "SELECT * FROM posts WHERE post_id = ". mysqli_real_escape_string($conn, $_GET['id']);
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
                    $sql2="SELECT topic_subject FROM topics WHERE topic_id = $row[post_topic]";
                    $result2 = mysqli_query($conn, $sql2);
                    $sql3="SELECT user_name FROM users WHERE user_id = $row[post_by]";
                    $result3 = mysqli_query($conn, $sql3);
                    $sql4="SELECT reply FROM reply WHERE reply_to = $row[post_topic]";
                    $result4 = mysqli_query($conn, $sql4);
                    while($row2 = mysqli_fetch_assoc($result2)){
                    $post_title = $row2['topic_subject'];
                    }
                    while($row3 = mysqli_fetch_assoc($result3)){
                        $posted_by = $row3['user_name'];
                        }
                        
                        

                    echo '<div class="container bg-custom-new rounded "> ';
                        echo '<tr><td class="Title">';
                            echo '<h1 class="display-3">'.$post_title.'</h1> <p class="font-weight-lighter">by ' .$posted_by. ' On '.$row['post_date'].'</p>
                               <hr class="my-4 ">
                               ';
                        echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td class="post_body">';
                            echo '<h3 class="font-weight-light">'.$row['post_content'].'<h3> <hr class="my-4   ">';
                        echo '</td>';
                    echo '</tr>';
//reply content
                        
                        echo '<tr><td class="Title">';
                        echo '<h1 class="display-3 ">-- Replies --</h1> 
                        <hr class="my-4 ">
                        ';
                        echo '</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td class="replies_body">';
                        while($row4 = mysqli_fetch_assoc($result4)){
                            echo '<h3 class="font-weight-light">'.$row4['reply'].'<h3><hr class="my-2 ">';
                            }
                        echo '</td>';
                        echo '</tr>';

                    echo '</div>';
                }
     

    }
}


include 'reply.php';
include 'footer.php';
?>