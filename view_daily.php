<?php require_once 'dbcon.php';?>
<?php include 'header.php'; ?>

<div class="text-center">
	<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>"
		method="post">
		View applicants added on <input type="text" class="input-small" name="add_dt"
			placeholder="YYYY-MM-DD"> for medium <select class="input-small" name="medium">
			<option value="bangla">Bangla</option>
			<option value="english">English</option>
		</select> sort by <select class="input-medium" name="sortby">
			<option value="id">Last Edited</option>
			<option value="roll">Roll</option>
			<option value="name">Applicant Name</option>
			<option value="father">Fathers' Name</option>
			<option value="mother">Mothers' Name</option>
		</select> <input type="checkbox" class="checkbox-inline" name="view_pic" value="yes"> View Photo* 

		<button class="btn" type="submit" name="submit">View</button>
	</form>
	<?php 
	if (!isset($_POST['submit']))
	{
	   echo '<p class="text-error text-center"><small><em>* Might load slowly if "View Photo" is checked!</em></small>';
	}
	?>
</div>

<?php

if (isset($_POST['submit'])) {
    $add_dt = $_POST['add_dt'];
    if ($_POST['medium'] == "bangla") {
        $table = 'applicants_bn';
        $img_folder = "applicants_img_bn";
    } elseif ($_POST['medium'] == "english") {
        $table = 'applicants_en';
        $img_folder = "applicants_img_en";
    }
    
    ?>
<form action="delete.php" method="get">
	<table class="table table-striped">
		<thead>
			<th>SL</th>
			<?php
    if ($_POST['view_pic'] == "yes") {
        echo '<th>PHOTO</th>';
    }
    ?>
			<th>ROLL</th>
			<th>NAME</th>
			<th>FATHER</th>
			<th>MOTHER</th>
		</thead>
		<tbody>
	<?php
    $sortby = $_POST['sortby'];
    
    switch ($sortby) {
        case 'name':
            $query = "SELECT * FROM $table WHERE add_dt = '$add_dt' ORDER BY name ASC, id ASC";
            break;
        case 'father':
            $query = "SELECT * FROM $table WHERE add_dt = '$add_dt' ORDER BY father ASC, id ASC";
            break;
        case 'mother':
            $query = "SELECT * FROM $table WHERE add_dt = '$add_dt' ORDER BY mother ASC, id ASC";
            break;
        case 'roll':
            $query = "SELECT * FROM $table WHERE add_dt = '$add_dt' ORDER BY roll ASC";
            break;
        default:
            $query = "SELECT * FROM $table WHERE add_dt = '$add_dt' ORDER BY id DESC";
    }
    
    $result = mysqli_query($link, $query);
    
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $i += 1;
        echo "<tr> <td>";
        echo $i; // Ser No
        
        if ($_POST['view_pic'] == "yes") {
            echo "</td> <td>";
            echo "<img src='" . $img_folder . "/" . $row['pic'] . "' width='60' height='25'/>"; // pic
        }
        
        echo "</td> <td>";
        echo $row['roll']; // Roll
        echo "</td> <td>";
        echo $row['name']; // name
        echo "</td> <td>";
        echo $row['father']; // father
        echo "</td> <td>";
        echo $row['mother']; // mother
        echo "</td> <td>";
        echo "<a class='btn btn-mini btn-warning' href='delete.php?table=" . $table . "&id=" . $row['id'] . "'>Delete</a>"; // mother
        echo "</td> </tr>";
    }
    ?>
	</tbody>
	</table>
</form>

<?php
}
?>


<?php include 'footer.php'?>
<?php mysqli_close($link); ?>