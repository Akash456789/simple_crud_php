<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1px solid">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>email</th>
            <th>gender</th>
            <th>language</th>
            <th>city</th>
            <th>password</th>
            <th>cpassword</th>
            <th>photo</th>
            <th>update</th>
            <th>delete</th>
        </tr>
        <?php
include('conn.php');

$query="select * from job";
$select=mysqli_query($con, $query);
while($res=mysqli_fetch_array($select)){
    
?>

<tr>
            <td><?php  echo $res['id']  ?></td>
            <td><?php  echo $res['name']  ?></td>
            <td><?php  echo $res['email']  ?></td>
            <td><?php  echo $res['gender']  ?></td>
            <td><?php  echo $res['language']  ?></td>
            <td><?php  echo $res['city']  ?></td>
            <td><?php  echo $res['password']  ?></td>
            <td><?php  echo $res['cpassword']  ?></td>
            <td><img src="<?php  echo $res['photo']  ?>" width="100px"/></td>

<td><a href="update.php?id=<?php echo $res['id'] ?> ">Update</a></td>

<td><a href="delete.php?id=<?php echo $res['id'] ?> ">Delete</a></td>
        </tr>

<?php

}
?>

    </table>

    <button><a href="index.php">insert data</a></button>
</body>
</html>








