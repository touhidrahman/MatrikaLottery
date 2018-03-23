<?php require_once 'dbcon.php';?>
<?php include 'header.php'; ?>
<?php

if (isset($_POST['submit'])) {
    // determine whether lottery is being done
    // for standby or main queue
    $result_rows = mysqli_query($link, "SELECT * FROM result_en");
    $c = mysqli_num_rows($result_rows);
    
    $result_vacancy = mysqli_query($link, "SELECT * FROM vacancy");
    while ($row_vacancy = mysqli_fetch_array($result_vacancy)) {
        extract($row_vacancy);
    }
    
    if ($c < $vacancy_en) {
        $queue = "Main";
    } elseif (($c >= $vacancy_en) && ($c < $vacancy_en + $vacancy_en_sby)) {
        $queue = "Waiting";
    } else {
        echo '<h1 class="text-center">All vacant and stand by seats are filled up! <a href="result_en.php">View Result</a></h1>';
        break;
    }
    // if go button is clicked, randomly select a roll no and info and view
    // through bootstrap well
    // $r = mysqli_query($link, "SELECT count(*) FROM applicants_en");
    // $d = mysqli_fetch_row($r);
    // $rand = mt_rand(0, $d[0]);
    $query = "SELECT * FROM applicants_en WHERE marked = 0 ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($result)) { // update result_en and
                                                 // show roll and info
        global $winner_roll, $name, $father, $mother;
        $winner_roll = $row['roll'];
        $name = $row['name'];
        $father = $row['father'];
        $mother = $row['mother'];
        
        $query_c = "SELECT roll FROM result_en";
        $result_c = mysqli_query($link, $query_c);
        $c = mysqli_num_rows($result_c);
        
        echo '<div class="container">
        <div class="row">
        <div class="span6 pull-left">';
        
        echo '<div class="well well-large text-center"><h2 class="custom-result">';
        echo $winner_roll;
        echo "<hr>";
        // add pic
        if (is_file(dirname(__FILE__) . UPLOADPATH_EN . $row['pic'])) {
            echo '<img src="applicants_img_en/' . $row["pic"] . '" alt="' .
                    $row["roll"] . '"><br>';
        }
        echo '</h2></div></div>';
        // name, father , mother
        echo '<div class="span6 pull-right">';
        echo '<div class="well well-large">';
        echo '<table class="table table-condensed">';
        echo '<tr><td>';
        echo "<h1>Name:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . ucfirst($row['name']) . "</h1>";
        echo '</td></tr>';
        echo '<tr><td>';
        echo "<h1>Father:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . ucfirst($row['father']) . "</h1>";
        echo '</td></tr>';
        echo '<tr><td>';
        echo "<h1>Mother:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . ucfirst($row['mother']) . "</h1>";
        echo '</td></tr>';
        echo '<tr><td>';
        echo "<h1>Queue:</h1>";
        echo '</td><td>';
        echo "<h1 class='text-success'>" . $queue . "</h1>";
        echo '</td></tr>';
        echo '</table>';
        echo '<hr class="solid">';
        echo "<h1 class='text-info'>Draw No: " . ($c + 1) . " of " .($vacancy_en + $vacancy_en_sby). "</h1>";
        echo '</div></div></div></div>';
        
        $query_upd_result = "INSERT INTO result_en (roll, name, father, mother, timestamp, queue)
         VALUES ('$winner_roll', '$name', '$father', '$mother', NOW(), '$queue')"; // insert
                                                                                  // into
                                                                                  // result
                                                                                  // table
        mysqli_query($link, $query_upd_result);
        
        $query_mark_std = "UPDATE applicants_en SET marked = 1 WHERE roll = '$winner_roll'"; // flag
                                                                                             // the
                                                                                             // applicant
        mysqli_query($link, $query_mark_std);
    }
}

?>
<div class="container">
	<div class="row">
		<div class="span12">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<button class="btn btn-large btn-danger" id="large-button"
					type="submit" name="submit">GO!</button>
			</form>
		</div>
	</div>
</div>

<?php include 'footer.php';?>
<?php mysqli_close($link); ?>