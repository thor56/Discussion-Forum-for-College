<div class="container bg-dark rounded shadow p-2"> 
<form method="post" action="reply.php?id=5">
    
    <div class="form-group">
    <textarea name="reply-content" class="form-control input-lg" rows="7" required></textarea>
    
  
  </div>
  <button type="submit" class="btn btn-success " style="width:100px;">Reply</button>
</form>
</div>
<?php

 // Start the session
session_start();
include 'connect.php';


if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //someone is calling the file directly, which we don't want
    // echo 'This file cannot be called directly.';
}
else
{
    //check for sign in status
    if(!$_SESSION['signed_in'])
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
     
                        $sql = "INSERT INTO 
                    reply(reply,reply_to,reply_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        " . mysqli_real_escape_string($conn,$_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
                         
        $result = mysqli_query($conn,$sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            Header("Location: topic.php?id=".$_GET['id']);
           
        }
    }
}
 

?>