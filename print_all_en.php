<?php require_once 'dbcon.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Matrika School Admission Lottery</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="MatrikaSchool Admission Lottery">
<meta name="author" content="Matrika Technologies | matrika.technologies@gmail.com">

<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {
	padding-top: 60px;
	padding-bottom: 40px;
}
</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->


<body>
<h2 class="text-center">[SCHOOL NAME HERE]</h2>
<h3 class="text-center">ALL APPLICANTS (ENGLISH VERSION)</h3>
<hr>
<?php

$query = "SELECT * FROM applicants_en ORDER BY roll ASC";
$result = mysqli_query ( $link, $query );

?>
<div class="container">
	<div class="row">
		<div class="span12">
			<table class="table table-condensed table-bordered">
				<thead>
					<th>SL</th>
					<th>ROLL</th>
					<th>NAME</th>
					<th>FATHER</th>
					<th>MOTHER</th>
					<th>BIRTHDAY</th>
				</thead>
				<tbody>
<?php
$i = 0;
while ( $row = mysqli_fetch_array ( $result ) ) {
	$roll = $_row ['roll'];
	$i += 1;
	echo "<tr> <td>";
	echo $i;
	echo "</td> <td>";
	echo $row ['roll'];
	echo "</td> <td>";
	echo $row ['name'];
	echo "</td> <td>";
	echo $row ['father'];
	echo "</td> <td>";
	echo $row ['mother'];
	echo "</td> <td>";
	echo $row ['bd'];
	echo "</td> </tr>";
}

?>
            </tbody>
			</table>
		</div>
	</div>
</div>
</body>
<footer>
<hr>
<p class="text-center text-muted"><small>
&copy; Matrika Technologies | matrika.technologies@gmail.com
</small>
</p>
</footer>
<?php mysqli_close($link); ?>