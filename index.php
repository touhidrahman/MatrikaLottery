<?php include 'dbcon.php'; ?>
<?php include 'header.php'; ?>
<?php

$query = "SELECT roll FROM applicants_bn";
$result = mysqli_query($link, $query);
$total_bn = mysqli_num_rows($result);

$query2 = "SELECT roll FROM applicants_en";
$result2 = mysqli_query($link, $query2);
$total_en = mysqli_num_rows($result2);

$result_vacancy = mysqli_query($link, "SELECT * FROM vacancy");
while ($row_vacancy = mysqli_fetch_assoc($result_vacancy)) {
    extract($row_vacancy);
}
?>
<div class="container">
	<!--in the footer file -->
	<div class="row">
		<div class="span12 text-center">
			<h1 class="text-center text-success">BANGLA VERSION</h1>
			<h2 class="text-center">Total Applicants: <?php echo $total_bn; ?></h2>
			<h2 class="text-center text-info">Vacancy: <?php echo $vacancy_bn; ?></h2>
			<h2 class="text-center text-info">Waiting: <?php echo $vacancy_bn_sby; ?></h2>
			<a class="btn btn-large btn-success btn-block" id="large-button"
				href="lottery_bn.php">Start Lottery (Bangla Version)</a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="span12 text-center">
			<h1 class="text-center text-error">ENGLISH VERSION</h1>
			<h2 class="text-center">Total Applicants: <?php echo $total_en; ?></h2>
			<h2 class="text-center text-info">Vacancy: <?php echo $vacancy_en; ?></h2>
			<h2 class="text-center text-info">Waiting: <?php echo $vacancy_en_sby; ?></h2>
			<a class="btn btn-large btn-danger btn-block" id="large-button"
				href="lottery_en.php">Start Lottery (English Version)</a>
		</div>
	</div>

</div>

<?php include 'footer.php';?>
<?php mysqli_close($link); ?>