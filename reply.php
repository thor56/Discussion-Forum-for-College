
<div class="container bg-dark rounded shadow p-2"> 
<form method="post" action="">
    
    <div class="form-group">
    <textarea name="reply-content" class="form-control input-lg" rows="7" required></textarea>
    
  
  </div>
  <button type="submit" class="btn btn-success " style="width:100px;">Reply</button>
  </form>
</div>
<!-- <form method="post" action="">
   
    <textarea name="reply-content" required></textarea>
    <input type="submit" value="Submit reply" />
</form> -->
<?php


 // Start the session
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

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
        echo 'Sign in to reply';
    }
    else
    {
       

        $sql = "
        INSERT INTO reply (reply,reply_to,reply_by) VALUES ("
        .$_POST['reply-content'].",".$_GET['id']."," .$_SESSION['user_id'] .")";
     
                //         $sql = "INSERT INTO 
                //     reply(reply,reply_to,reply_by) 
                // VALUES ('" . $_POST['reply-content'] . "',
                //         " . mysqli_real_escape_string($conn,$_GET['id']) . ",
                //         " . $_SESSION['user_id'] . ")";
                         
                          
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