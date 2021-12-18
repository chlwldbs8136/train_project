<?php
    $id = $_POST["id"];
    $pw = $_POST["pw"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];

              
    $con = mysqli_connect("localhost:3310", "root", "phpadmin", "train_project");

	$sql = "insert into customer(id, pw, name, phone) values ('$id', '$pw', '$name', '$phone')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'main.php';
	      </script>
	  ";
?>