<?php 

session_start();
if($_SESSION['is_loggedin'] == 1)
{

}
else
{
    header('Location:login.php');
}

?>