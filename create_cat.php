<?php
//create_cat.php
include 'connect.php';
include 'header.php';

//check if user is logged in
if($_SESSION['signed_in'] == false)
{
    //ask the user to sign-in
    echo 'Please Login to use this feature, ' . '<a href="signin.php">Sign in</a>'; 
}

else {



if($_SESSION['user_level'] == 1){

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //the form hasn't been posted yet, display it
    echo "<form method='post' action=''>
        Category name: <input type='text' name='cat_name' />
        Category description: <textarea name='cat_description' /></textarea>
        <input type='submit' value='Add category' />
     </form>";
}
else
{
    //the form has been posted, so save it
    $sql = "INSERT INTO categories(cat_name, cat_description)
       VALUES('" . mysqli_real_escape_string($conn, $_POST['cat_name']) . "',
             '" . mysqli_real_escape_string($conn, $_POST['cat_description']) . "')";
    $result = mysqli_query($conn, $sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error' . mysqli_error($conn);
    }
    else
    {
        echo 'New category successfully added.';
    }
}
}
else if($_SESSION['user_level'] == '0')
{
    echo 'You are not authorised to create a Category, please forward the request to the authorised User.'; 
    
}
}






include 'footer.php';
?>