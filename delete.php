<?php
require_once 'dbcon.php';
include 'header.php';



if ((isset($_GET['id'])) && isset($_GET['table']))
{
    $table = $_GET['table'];
    $id = $_GET['id'];
    
    $query = "SELECT pic FROM $table WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($link, $query);
    while ($r = mysqli_fetch_array($result))
    {
        $pic = $r['pic'];    //outputs $pic
    }
    if ($table == "applicants_bn")
    {
        $target = dirname(__FILE__) . UPLOADPATH_BN . $pic;
    } elseif ($table == "applicants_en")
    {
        $target = dirname(__FILE__) . UPLOADPATH_EN . $pic;
    }
    
    unlink ($target);
    
    
    
    $query = "DELETE FROM $table WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($link, $query);
    
    if ($result)
    {
        echo "<div class='container'>
                <div class='row'>
                <div class='span12'>
                <div class='alert alert-success text-center'><h2>Deleted! <a href='";
        echo $_SERVER['HTTP_REFERER'];
        echo "'>Go Back.</a></h2></div></div></div></div>";
    }
}

include 'footer.php';
mysqli_close($link);
?>