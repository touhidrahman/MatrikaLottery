<?php require 'dbcon.php'; ?>
<?php include 'header.php'; ?>

<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $bd = "20". $_POST['yr'] ."-". $_POST['mm'] ."-". $_POST['dd'];
    $roll = $_POST['roll'];
    $pic_name = $_FILES['pic']['name'];
    
    if ((empty($name)) && (empty($father)) && (empty($mother)) && (empty($bd)) && (empty($roll))) {
        exit("<div class='alert'><strong>One or more form data is not entered! Fill up and save again</strong></div>");
    } else {
        file_up (UPLOADPATH_EN);
        
        $query = "INSERT INTO applicants_en (roll, name, father, mother, bd, pic, add_dt) VALUES ('$roll', '$name', '$father', '$mother', '$bd', '$pic_name', CURDATE())";
        
        $result = mysqli_query($link, $query) or die("<div class='alert'>Error!</div>" . mysqli_error($link));
        
        if ($result) {
            echo "<div class='container'>
                <div class='row'>
                <div class='span12'>
                <div class='alert alert-success text-center'>
                <strong>ROLL $roll SAVED!</strong><br>
                <strong>Name: </strong><span>$name</span>
                <strong> Father: </strong><span>$father</span>
                <strong> Mother: </strong><span>$mother</span>
                <strong> Birthday: </strong><span>$bd</span>
            </div></div></div></div>";
        }
    }
}
?>
<div class="container">
	<div class="row">
		<div class="span12">
			<form enctype="multipart/form-data" class="form-horizontal"
				action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<fieldset>
					<legend>Add Applicant Details (For English Version)</legend>
					<div class="control-group">
						<label class="control-label" for="roll">Roll</label>
						<div class="controls">
							<input type="text" name="roll">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="name">Name</label>
						<div class="controls">
							<input type="text" name="name"
								placeholder="Full Name of the Applicant">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="father">Father's Name</label>
						<div class="controls">
							<input type="text" name="father"
								placeholder="Full Name of Applicant's Father">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mother">Mother's Name</label>
						<div class="controls">
							<input type="text" name="mother"
								placeholder="Full Name of Applicant's Mother">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="bd">Birthday</label>
						<div class="controls">
							<input class="input-mini" type="text" name="dd" placeholder="DD"> - <input class="input-mini"  type="text" name="mm" placeholder="MM"> - 
							20 <input class="input-mini" type="text" name="yr" placeholder="YY">
						</div>
					</div>
					<div class="control-group">
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576"> <label
							class="control-label" for="pic">Photo</label>
						<div class="controls">
							<input type="file" name="pic">
						</div>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Save</button>
					<button type="reset" name="reset" class="btn">Reset</button>
				</fieldset>
			</form>
		</div>
	</div>
</div>

<?php include 'footer.php';?>
<?php mysqli_close($link); ?>