<?php require 'dbcon.php'; ?>
<?php include 'header.php'; ?>

<?php
if (isset($_POST['submit'])) {
    $vacancy_bn = $_POST['vacancy_bn'];
    $vacancy_bn_sby = $_POST['vacancy_bn_sby'];
    $vacancy_en = $_POST['vacancy_en'];
    $vacancy_en_sby = $_POST['vacancy_en_sby'];
    
    if (! empty($vacancy_bn)) {
        // ck if vacancy db has data already...
        $query = "SELECT * FROM vacancy WHERE vacancy_bn IS NOT NULL";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) == 1)         // if there is data in the vacancy
        {
            $query2 = "UPDATE vacancy SET vacancy_bn = '$vacancy_bn', vacancy_bn_sby = '$vacancy_bn_sby' LIMIT 1";
            mysqli_query($link, $query2);
            echo "<div class='alert alert-success'> <strong>Vacancy data for Bangla medium updated.</strong></div>";
        } else {
            $query2 = "INSERT INTO vacancy (vacancy_bn, vacancy_bn_sby) VALUES ('$vacancy_bn', '$vacancy_bn_sby')";
            $result = mysqli_query($link, $query2) or
                     die("<div class='alert'>Error! Try again.</div>");
            echo "<div class='alert alert-success'> <strong>SAVED!</strong> </div>";
        }
    }

    if (! empty($vacancy_en)) {
        // ck if vacancy db has data already...
        $query = "SELECT * FROM vacancy WHERE vacancy_en IS NOT NULL";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) == 1)         // if there is data in the vacancy
        {
            $query2 = "UPDATE vacancy SET vacancy_en = '$vacancy_en', vacancy_en_sby = '$vacancy_en_sby' LIMIT 1";
            mysqli_query($link, $query2);
            echo "<div class='alert alert-success'> <strong>Vacancy data for English medium updated.</strong></div>";
        } else {
            $query2 = "INSERT INTO vacancy (vacancy_en, vacancy_en_sby) VALUES ('$vacancy_en', '$vacancy_en_sby')";
            $result = mysqli_query($link, $query2) or
                     die("<div class='alert'>Error! Try again.</div>");
            echo "<div class='alert alert-success'> <strong>SAVED!</strong> </div>";
        }
    }
  
}
?>

<div class="container">
<div class="row">
	<div class="span12">
		<h2 class="text-center">Add Vacancy of Seats</h2>
		<form class="form-horizontal"
			action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset>
				<legend>Bangla Medium</legend>
				<div class="control-group">
					<label class="control-label" for="vacancy_bn">Main</label>
					<div class="controls">
						<input type="text" name="vacancy_bn"
							placeholder="Add amount of vacant seats">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="vacancy_bn_sby">Waiting</label>
					<div class="controls">
						<input type="text" name="vacancy_bn_sby"
							placeholder="Add amount of waiting seats">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>English Medium</legend>
				<div class="control-group">
					<label class="control-label" for="vacancy_en">Main</label>
					<div class="controls">
						<input type="text" name="vacancy_en"
							placeholder="Add amount of vacant seats">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="vacancy_en_sby">Waiting</label>
					<div class="controls">
						<input type="text" name="vacancy_en_sby"
							placeholder="Add amount of waiting seats">
					</div>
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Save</button>
			</fieldset>
		</form>
	</div>
</div>
</div>


<?php include 'footer.php';?>
<?php mysqli_close($link); ?>