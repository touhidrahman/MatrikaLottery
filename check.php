<?php require 'dbcon.php'; ?>
<?php include 'header.php'; ?>
<!-- //This script shows details of the entered roll no -->

<div class="text-center">
	<form class="form-inline" action="check.php" method="post">
		View One by One: Starting Roll <input type="text" name="roll"
			placeholder="Enter roll no or leave it empty"> Medium <select name="medium">
			<option value="bangla">Bangla</option>
			<option value="english">English</option>
		</select>

		<button class="btn" type="submit" name="submit">View</button>
	</form>
</div>
<?php 

if (isset ($_POST['submit']))
{
    if ($_POST['medium'] == "bangla") {
        $medium = "bangla";
        $table = 'applicants_bn';
        $img_folder = "applicants_img_bn";
    } elseif ($_POST['medium'] == "english") {
        $medium = "english";
        $table = 'applicants_en';
        $img_folder = "applicants_img_en";
    }
    
    
    if ($_POST['roll'] != "")
    {
        $start_roll = $_POST['roll'];
        $query = "SELECT * FROM $table WHERE roll = '$start_roll' LIMIT 1";
    }
    else
    {
        $query = "SELECT * FROM $table ORDER BY roll ASC LIMIT 1";
    }
    
    
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($result))
    {
        
        echo '<div class="container">
        <div class="row">
        <div class="span6 pull-left">';
        
        echo '<div class="well well-large text-center"><h2 class="custom-result">';
        echo $row['roll'];
        echo "<hr>";
        // add pic
       
        echo '<img src="' .$img_folder .'/' . $row["pic"] . '" alt="' . $row["roll"] . '"><br>';
        
        echo '</h2></div></div>';
        // name, father , mother
        echo '<div class="span6 pull-right">';
        echo '<div class="well well-large">';
        echo '<table class="table table-condensed">';
        echo '<tr><td>';
        echo "<h1>Name:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . $row['name'] . "</h1>";
        echo '</td></tr>';
        echo '<tr><td>';
        echo "<h1>Father:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . $row['father'] . "</h1>";
        echo '</td></tr>';
        echo '<tr><td>';
        echo "<h1>Mother:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . $row['mother'] . "</h1>";
        echo '</td></tr>';
        
        echo '<tr><td>';
        echo "<h1>Birthday:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . $row['bd'] . "</h1>";
        echo '</td></tr>';
        
        echo '<tr><td>';
        echo "<h1>Medium:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . ucfirst($medium) . "</h1>";
        echo '</td></tr>';
        
        echo '<tr><td>';
        echo "<h1>Selected:</h1>";
        echo '</td><td>';
        $selected = ($row['marked'] == 0)  ? 'No' : 'Yes';
        echo "<h1 class='text-success'>" . $selected . "</h1>";
        echo '</td></tr>';
        
        echo '</table>';
        echo '</div>';
        $start_roll = $row['roll'];
        $id = $row['id'];
        ?>
        <a href="check.php?medium=<?php echo $medium; ?>&roll=<?php echo $start_roll; ?>&nav=prev" class="btn btn-large btn-primary pull-left">Previous</a>
        <a href="delete.php?table=<?php echo $table; ?>&id=<?php echo $id; ?>" class="btn btn-large btn-link  pull-center">Delete</a>
        <a href="check.php?medium=<?php echo $medium; ?>&roll=<?php echo $start_roll; ?>&nav=next" class="btn btn-large btn-primary pull-right">Next</a>
        <?php 
        echo '</div></div></div>';
    }
}



$start_roll = $_GET['roll'];

if ($_GET['medium'] == "bangla") {
    $medium = "bangla";
    $table = 'applicants_bn';
    $img_folder = "applicants_img_bn";
} elseif ($_GET['medium'] == "english") {
    $medium = "english";
    $table = 'applicants_en';
    $img_folder = "applicants_img_en";
}

if ($_GET['nav'] == 'next')
{
    $query2 = "SELECT * FROM $table WHERE roll > '$start_roll' ORDER BY roll ASC LIMIT 1";

} elseif ($_GET['nav'] == 'prev') {

    $query2 = "SELECT * FROM $table WHERE roll < '$start_roll' ORDER BY roll DESC LIMIT 1";
}


$result2 = mysqli_query($link, $query2);
while ($row2 = mysqli_fetch_array($result2))
{
    echo '<div class="container">
        <div class="row">
        <div class="span6 pull-left">';

    echo '<div class="well well-large text-center"><h2 class="custom-result">';
    echo $row2['roll'];
    echo "<hr>";
    // add pic
    
    echo '<img src="' .$img_folder .'/' . $row2["pic"] . '" alt="' . $row2["roll"] . '"><br>';
    
    echo '</h2></div></div>';
    // name, father , mother
    echo '<div class="span6 pull-right">';
    echo '<div class="well well-large">';
    echo '<table class="table table-condensed">';
    echo '<tr><td>';
    echo "<h1>Name:</h1>";
    echo '</td><td>';
    echo "<h1 class='text-success'>" . $row2['name'] . "</h1>";
    echo '</td></tr>';
    echo '<tr><td>';
    echo "<h1>Father:</h1>";
    echo '</td><td>';
    echo "<h1 class='text-success'>" . $row2['father'] . "</h1>";
    echo '</td></tr>';
    echo '<tr><td>';
    echo "<h1>Mother:</h1>";
    echo '</td><td>';
    echo "<h1 class='text-success'>" . $row2['mother'] . "</h1>";
    echo '</td></tr>';
    
    echo '<tr><td>';
    echo "<h1>Birthday:</h1>";
    echo '</td><td>';
    echo "<h1 class='text-success'>" . $row2['bd'] . "</h1>";
    echo '</td></tr>';
    
    echo '<tr><td>';
    echo "<h1>Medium:</h1>";
    echo '</td><td>';
    echo "<h1 class='text-success'>" . ucfirst($medium) . "</h1>";
    echo '</td></tr>';
    
    echo '<tr><td>';
    echo "<h1>Selected:</h1>";
    echo '</td><td>';
    $selected = ($row2['marked'] == 0)  ? 'No' : 'Yes';
    echo "<h1 class='text-success'>" . $selected . "</h1>";
    echo '</td></tr>';
    
    echo '</table>';
    echo '</div>';
    global $start_roll;
    $start_roll = $row2['roll'];
    $id = $row2['id'];
    ?>
       <a href="check.php?medium=<?php echo $medium; ?>&roll=<?php echo $start_roll; ?>&nav=prev" class="btn btn-large btn-primary pull-left">Previous</a>
       <a href="delete.php?table=<?php echo $table; ?>&id=<?php echo $id; ?>" class="btn btn-large btn-link  pull-center">Delete</a>
       <a href="check.php?medium=<?php echo $medium; ?>&roll=<?php echo $start_roll; ?>&nav=next" class="btn btn-large btn-primary pull-right">Next</a>
       <?php 
    echo '</div></div></div>';
    }

?>

<?php include 'footer.php';?>
    