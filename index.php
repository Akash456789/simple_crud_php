<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        name: <input type="text" name="name"/><br><br>
        email: <input type="text" name="email"/><br><br>
        gender:<input type="radio" name="gender" value="male"/>male
                <input type="radio" name="gender" value="female"/>female <br><br>

        language:<input type="checkbox" name="language[]" value="hindi"/>hindi
                <input type="checkbox" name="language[]" value="english"/>english 
                <input type="checkbox" name="language[]" value="american"/>american 
                <br><br>
  city:<select name="city">
    <option>delhi</option>
    <option>noida</option>
    <option>meerut</option>
  </select><br><br>
        password: <input type="text" name="password"/><br><br>
        cpassword: <input type="text" name="cpassword"/><br><br> 
        photo: <input type="file" name="photo"/><br><br> 
        <button type="submit" name="submit">submit</button>
    </form>
</body>
</html>


<?php
include('conn.php');

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $language=implode(',',$_POST['language']);
    $city=$_POST['city'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $photo=$_FILES['photo'];

$filename=$photo['name'];
$filetmp=$photo['tmp_name'];
$dis='upload/'.$filename;

move_uploaded_file($filetmp,$dis);

$query="insert into job (`name`, `email`,`gender`,`language`,`city` ,`password`,`cpassword`,`photo`) value ('$name','$email','$gender','$language','$city','$password','$cpassword','$dis')";

$insert=mysqli_query($con, $query);

if($insert){
    echo "data insert";
    header('location:display.php');
}else{
    echo "data nt insert";
}


}


?>