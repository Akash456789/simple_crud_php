<?php
include('conn.php');

$id = $_GET['id'];

$query = "SELECT * FROM job WHERE id='$id'";
$select = mysqli_query($con, $query);
$resar = mysqli_fetch_array($select);

if ($resar) { // Checking if $resar is not empty
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $language=implode(',',$_POST['language']);
        $city = $_POST['city'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword']; // Corrected variable name
        
        // Handling file upload
        if (!empty($_FILES['photo']['name'])) {
            $photo = $_FILES['photo'];
            $filename = $photo['name'];
            $filetmp = $photo['tmp_name'];
            $dis = 'upload/' . $filename;
            move_uploaded_file($filetmp, $dis);
        } else {
            // If no new photo is uploaded, retain the old photo
            $dis = $resar['photo'];
        }

        $query = "UPDATE job SET name='$name', email='$email', gender='$gender',language='$language',city='$city' ,password='$password', cpassword='$cpassword', photo='$dis' WHERE id='$id'";
        $update = mysqli_query($con, $query);
        if ($update) {
            echo "Data updated successfully";
            header('location:display.php');
        } else {
            echo "Failed to update data";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Job</title>
</head>
<body>
    <h2>Update Job</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value='<?php echo $resar['name']; ?>'/><br><br>
        
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value='<?php echo $resar['email']; ?>' /><br><br>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="male" <?php if($resar['gender'] == 'male') echo 'checked'; ?>/>Male
        <input type="radio" name="gender" value="female" <?php if($resar['gender'] == 'female') echo 'checked'; ?>/>Female <br><br>
        
        language:
<input type="checkbox" name="language[]" value="hindi" <?php if(in_array('hindi', explode(',', $resar['language']))) echo 'checked'; ?>/>hindi
<input type="checkbox" name="language[]" value="english" <?php if(in_array('english', explode(',', $resar['language']))) echo 'checked'; ?>/>english 
<input type="checkbox" name="language[]" value="american" <?php if(in_array('american', explode(',', $resar['language']))) echo 'checked'; ?>/>american 
<br><br>

city:<select name="city">
    <option <?php if($resar['city'] == 'delhi') echo 'selected'; ?>>delhi</option>
    <option <?php if($resar['city'] == 'noida') echo 'selected'; ?>>noida</option>
    <option <?php if($resar['city'] == 'meerut') echo 'selected'; ?>>meerut</option>
</select><br><br>



        <label for="password">Password:</label>
        <input type="text" name="password" id="password" value='<?php echo $resar['password']; ?>'/><br><br>
        
        <label for="cpassword">Confirm Password:</label>
        <input type="text" name="cpassword" id="cpassword" value='<?php echo $resar['cpassword']; ?>' /><br><br> 
        
        <?php if (!empty($resar['photo'])) { ?>
            <p>Current Photo: <?php echo $resar['photo']; ?></p>
        <?php } ?>
        
        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" /><br><br> 
        
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
