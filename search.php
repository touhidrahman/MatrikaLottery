<?php require 'dbcon.php'; ?>
<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="span12">
<form name="search" class="form-horizontal"
	action="<?php $_SERVER['PHP_SELF'];?>" method="post">
	<fieldset>
		<legend>Search for Applicant</legend>
		<div class="control-group">
			<label class="control-label" for="roll">By Roll</label>
			<div class="controls">
				<input type="text" name="roll">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="name">Or By Applicant's Name</label>
			<div class="controls">
				<input type="text" name="name">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="medium">Medium</label>
			<div class="controls">
				<select name="medium">
					<option value="bangla">Bangla</option>
					<option value="english">English</option>
				</select>
			</div>
		</div>
		<input type="hidden" name="searching" value="yes">
		<button type="submit" name="submit" class="btn btn-success">Search</button>
		<button type="reset" name="reset" class="btn btn-danger">Reset</button>
		<button type="submit" name="refresh" href="search.php"
			class="btn btn-primary">Refresh</button>
	</fieldset>
</form>

<?php

if (isset($_POST['submit']))

{
    $searching = $_POST['searching'];
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    
    if ($_POST['medium'] == "bangla")
		//select table
	{
        $table = "applicants_bn";
        $img_folder = "applicants_img_bn";
    } elseif ($_POST['medium'] == "english") {
        $table = "applicants_en";
        $img_folder = "applicants_img_en";
    }
    
    if ($searching == "yes")
		//if yes then show title- Search result
	{
        echo "<h2 class='text-success text-center'>Search Result</h2>";
        echo "<hr>";
    }
    
    // search query
    if (! empty($roll) && (empty($name))) {
        $query = "SELECT * FROM $table WHERE roll = '$roll'";
    } elseif (! empty($name) && (empty($roll))) {
        $query = "SELECT * FROM $table WHERE name LIKE '%$name%'";
    } elseif (! empty($name) && (! empty($roll))) {
        exit("<div class='alert alert-warning'>Please enter either roll number or name!</div>");
    } else {
        exit("<div class='alert alert-danger'>You have not entered any roll number or name!</div>");
    }
    
    $search_result = mysqli_query($link, $query);
    if (mysqli_num_rows($search_result) == 0)

    {
        echo "<div class='alert alert-danger'><h2 class='text-center'>No Matched Result!</h2></div>";
    } else {
        
        ?>
<form action="delete.php" method="get">
	<table class="table table-striped">
		<thead>
			<th>SL</th>
			<th>PHOTO</th>
			<th>ROLL</th>
			<th>NAME</th>
			<th>FATHER</th>
			<th>MOTHER</th>
			<th>SELECTED</th>
		</thead>
		<tbody>
<?php
        $i = 0;
        
        while ($row = mysqli_fetch_array($search_result))

        {
            $i += 1;
            echo "<tr> <td>";
            echo $i; // Ser No
            echo "</td> <td>";
            echo "<img src='" . $img_folder . "/" . $row['pic'] .
                     "' height='45' width='39'/>"; // pic
            echo "</td> <td>";
            echo $row['roll']; // Roll
            echo "</td> <td>";
            echo $row['name']; // name
            echo "</td> <td>";
            echo $row['father']; // father
            echo "</td> <td>";
            echo $row['mother']; // mother
            echo "</td> <td>";
            echo ($row['marked'] == 0) ? "<p class='btn btn-mini btn-danger'>No</p>" : "<p class='btn btn-mini btn-success'>Yes</p>"; // if
                                                                                                                                      // marked=yes
            echo "</td> <td>";
            echo "<a class='btn btn-mini btn-warning' href='delete.php?table=" .
                     $table . "&id=" . $row['id'] . "'>Delete</a>";
            echo "</td> </tr>";
        }
        ?>
		</tbody>
	</table>
</form>
</div>
</div>
</div>
<?php
    }
}

?>

<?php include 'footer.php';?>
<?php mysqli_close($link); ?>
