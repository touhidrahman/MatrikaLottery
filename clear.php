<?php require 'dbcon.php'; ?>
<?php include 'header.php'; ?>

<div class="alert alert-warning text-center">
  <h2>HANDLE WITH CARE! PAGE ONLY FOR ADMINS!</h2>
</div>

<div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<button class="btn btn-large btn-danger btn-block" id="large-button" type="submit" name="clear_bn">DELETE LOTTERY RESULT (BANGLA VERSION)</button>
	<button class="btn btn-large btn-danger btn-block" id="large-button" type="submit" name="clear_en">DELETE LOTTERY RESULT (ENGLISH VERSION)</button>
</form>
</div>
<?php

if (isset($_POST['clear_bn']))
{
	$query = "UPDATE applicants_bn SET marked = 0";
	$query2 = "TRUNCATE TABLE result_bn";
	mysqli_query($link, $query);
	mysqli_query($link, $query2);
	echo "<div class='alert alert-success text-center'><h2>Bangla Version Lottery Result Deleted</h2></div>";
}
elseif (isset($_POST['clear_en']))
{
	$query = "UPDATE applicants_en SET marked = 0";
	$query3 = "TRUNCATE TABLE result_en";
	mysqli_query($link, $query);
	mysqli_query($link, $query3);
	echo "<div class='alert alert-success text-center'><h2>English Version Lottery Result Deleted</h2></div>";
}
?>

<?php include 'footer.php';?>
<?php mysqli_close($link); ?>