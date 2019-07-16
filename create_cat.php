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


//displaying all the categories
$sql1 = "select cat_id, cat_name, cat_description from categories";
 
$result = mysqli_query($conn, $sql1);
 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>'; 
             
        while($row = mysqli_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                            echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
                echo '</td>';
            echo '</tr>';
        }
    }
}





include 'footer.php';
?>