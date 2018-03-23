<?php require_once 'dbcon.php';?>
<?php include 'header.php'; ?>
<?php

$query = "SELECT * FROM result_bn ORDER BY id ASC, timestamp DESC";
$result = mysqli_query($link, $query);

?>
<h2 class="text-center">Lottery Result - Bangla Medium</h2>
<div class="container">
	<div class="row">
		<div class="span12">
			<p class="text-right"><a href="print_bn.php">Print Result</a></p>
			<table class="table table-striped">
				<thead>
					<th>SL</th>
					<th>PHOTO</th>
					<th>ROLL</th>
					<th>NAME</th>
					<th>FATHER</th>
					<th>MOTHER</th>
					<th>QUEUE</th>
				</thead>
				<tbody>
<?php
$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $roll = $row['roll'];
    // view Photo
    $result_pic = mysqli_query($link,
            "SELECT pic FROM applicants_bn WHERE roll = '$roll' LIMIT 1");
    while ($row_pic = mysqli_fetch_array($result_pic)) {
        global $img;
        $img = $row_pic['pic'];
    }
    
    $i += 1;
    echo "<tr> <td>";
    echo $i;
    echo "</td> <td>";
    echo "<img src='applicants_img_bn/" . $img . "' width='60'>";
    echo "</td> <td>";
    echo $row['roll'];
    echo "</td> <td>";
    echo $row['name'];
    echo "</td> <td>";
    echo $row['father'];
    echo "</td> <td>";
    echo $row['mother'];
    echo "</td> <td>";
    echo $row['queue'];
    echo "</td> </tr>";
}

?>
            </tbody>
			</table>
		</div>
	</div>
</div>
<?php include 'footer.php';?>
<?php mysqli_close($link); ?>