<?php require_once 'dbcon.php';?>
<?php include 'header.php'; ?>

<?php 

//edit the data through post method
if (isset($_POST['submit']))
{
    $new_roll = $_POST['roll'];
    $new_name = $_POST['name'];
    $new_father = $_POST['father'];
    $new_mother = $_POST['mother'];
    $new_bd = $_POST['bd'];
    $medium = $_POST['medium'];
    $pic_name = $_FILES['pic']['name'];
    
    if ((empty($new_name)) && (empty($new_father)) && (empty($new_mother)) && (empty($medium)) && (empty($new_bd))) 
    {
        exit("<div class='alert'><strong>One or more form data is not entered! Fill up and save again</strong></div>");
    } else {
        if ($medium == "bangla") {
            file_up (UPLOADPATH_BN);
            $table_upd = "applicants_bn";
        }
        elseif ($medium == "english") {
            file_up (UPLOADPATH_EN);
            $table_upd = "applicants_en";
        }
    
        $query = "UPDATE 
                    $table_upd 
                SET 
                    name = '$new_name', 
                    father = '$new_father', 
                    mother = '$new_mother', 
                    bd = '$new_bd', 
                    pic = '$pic_name', 
                    add_dt = CURDATE() 
                WHERE 
                    roll = '$new_roll'";
        $result = mysqli_query($link, $query) or
        die("<div class='alert'>Error!</div>" . mysqli_error($link));
    
        if ($result) {
            echo "<div class='alert'><strong>SAVED!</strong></div>";
        }
    }
}
?>


<?php 
//View the current data through the get method
if (isset($_GET))
{
    $searching_roll = $_GET['roll'];
    $medium = $_GET['medium'];
    
    $table = ($medium == 'bangla') ? "applicants_bn" : "applicants_en";
    $img_folder = ($medium == 'bangla') ? "applicants_img_bn" : "applicants_img_en";
    
    $query = "SELECT * FROM $table WHERE roll = '$searching_roll' LIMIT 1";
    $result = mysqli_query($link, $query);
    while ($row_search = mysqli_fetch_array($result))
    {
?>
<form enctype="multipart/form-data" class="form-horizontal"
	action="edit.php" method="post">

	<fieldset>
		<legend>Edit Applicant Details - Roll : <?php echo $searching_roll;?></legend>
		<div class="control-group">
			<label class="control-label" for="name">Name</label>
			<div class="controls">
				<input type="text" name="name"
					placeholder="<?php echo $row_search['name']; ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="father">Father's Name</label>
			<div class="controls">
				<input type="text" name="father"
					placeholder="<?php echo $row_search['father']; ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="mother">Mother's Name</label>
			<div class="controls">
				<input type="text" name="mother"
					placeholder="<?php echo $row_search['mother']; ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bd">Birthday</label>
			<div class="controls">
				<input type="text" name="bd"
					placeholder="<?php echo $row_search['bd'];?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="medium">Medium</label>
			<div class="controls">
				<select name="medium">
					<option value="">---</option>
					<option value="bangla">Bangla</option>
					<option value="english">English</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="pic">Current Photo</label>
			<div class="controls">
				<img src=" <?php echo $img_folder ."/". $row_search ['pic']; ?>" width="200" /><br>
				Change<input type="file" name="pic"> 
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576">
		<button type="submit" name="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
	</fieldset>
</form>
<?php 
    } //while
}   //if get
?>
<?php include 'footer.php';?>
<?php mysqli_close($link); ?>