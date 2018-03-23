 <?php
date_default_timezone_set('Asia/Dhaka');

$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'lottery_sd';

$link = mysqli_connect($host, $user, $password, $database);


//OTHER CONST
define('UPLOADPATH_BN', '/applicants_img_bn/');
define('UPLOADPATH_EN', '/applicants_img_en/');



function file_up ($uploadpath)
{
    if ((! empty($_FILES['pic'])) && ($_FILES['pic']['error'] == 0) &&
    (! empty($_FILES['pic']['type']) == "image/jpeg")) {
        $pic = basename($_FILES['pic']['name']);
        $ext = substr($pic, strrpos($pic, '.') + 1);
        if (($ext == "jpg") && ($_FILES['pic']['type'] == "image/jpeg") &&
        ($_FILES['pic']['size']) < 1048576) {
            // move uploaded file
            $target = dirname(__FILE__) . $uploadpath . $pic;
            // ck the file already exists or not
            if (! file_exists($pic)) {
                // move to target
                move_uploaded_file($_FILES['pic']['tmp_name'], $target);
            } else {
                //replace file
                unlink($target);
                move_uploaded_file($_FILES['pic']['tmp_name'], $target);

                echo "<div class='alert'><strong>File already exists! Replaced old file and saved.</strong></div>";
            }
        } else {
            echo "<div class='alert'><strong>ERROR UPLOADING PHOTO! Large file size or Not JPEG Image!</strong></div>";
        }
    }
}

?>