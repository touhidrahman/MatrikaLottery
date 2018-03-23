<?php require_once 'dbcon.php';?>
<?php include 'header.php'; ?>
<?php
$sortby = $_GET['sortby'];

switch ($sortby)
{
	case 'name':
	    $query = "SELECT * FROM applicants_en ORDER BY name ASC, roll ASC";
	    break;
	case 'father':
	    $query = "SELECT * FROM applicants_en ORDER BY father ASC, roll ASC";
	    break;
	case 'mother':
	    $query = "SELECT * FROM applicants_en ORDER BY mother ASC, roll ASC";
	    break;
	case 'roll':
	    $query = "SELECT * FROM applicants_en ORDER BY roll DESC";
	    break;
	default:
	    $query = "SELECT * FROM applicants_en ORDER BY marked DESC, roll ASC";
}


$result = mysqli_query($link, $query);

// this code deletes applicants (multiple) from the db
if (isset($_POST['submit'])) {
    
    foreach ($_POST['todelete'] as $delete_id) {
        //delete pic
        $q = "SELECT pic FROM applicants_en WHERE id = '$delete_id' LIMIT 1";
        $result = mysqli_query($link, $q);
        while ($r = mysqli_fetch_array($result))
        {
            $pic = $r['pic'];    //outputs $pic
        }
        $target = dirname(__FILE__) . UPLOADPATH_EN . $pic;
        
        unlink ($target);
        
        
        // stores selected results' id in todelete array and deletes
        $query2 = "DELETE FROM applicants_en  WHERE id = '$delete_id'";
        mysqli_query($link, $query2);
        
        /*
         * add here a block of code which will auto refresh the page after
         * deleting entries from db
         */
    }
    echo "<div class='alert text-center'> <strong>DELETED!</strong> Refresh the page.</div>";
}
?>
<div class="container">
	<div class="row">
		<div class="span12">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table class="table table-striped table-condensed">
					<thead>
						<th>SL</th>
						<th><a href="view_en.php?sortby=roll">ROLL</a></th>
						<th>PHOTO</th>
						<th><a href="view_en.php?sortby=name">NAME</a></th>
						<th><a href="view_en.php?sortby=father">FATHER</a></th>
						<th><a href="view_en.php?sortby=mother">MOTHER</a></th>
						<th>SELECTED</th>
						<th>DELETE</th>
					</thead>
					<tbody>
<?php
$i = 0;
while ($row = mysqli_fetch_array($result)) { // use $result_paginated
                                             // instead while using
                                             // pagination
    $i += 1;
    echo "<tr> <td>";
    echo $i; // Ser No
    echo "</td> <td>";
    echo $row['roll']; // Roll
    echo "</td> <td>";
    echo $row['pic']; // Roll
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
    echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
    echo "</td> </tr>";
}
?>
</tbody>
				</table>
				<button class="btn btn-danger" name="submit" type="submit">REMOVE</button>
				<button class="btn btn-success" name="refresh" href="view_en.php">REFRESH</button>
			</form>
			
		</div>
	</div>
</div>

<?php include 'footer.php';?>
<?php mysqli_close($link); ?>