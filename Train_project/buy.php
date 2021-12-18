<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>열차 좌석 예약</title>
    <link rel="stylesheet" type="text/css" href="./css/buy.css">
</head>
<body> 
    <header>
        <?php include "header.php";?>
    </header>

    <div class='titles'><h3>열차 시간표</h3></div>
    <?php
        $con = mysqli_connect("localhost:3310", "root", "phpadmin", "train_project");
        $sql = "select * from korail";
        $result = mysqli_query($con, $sql);

        echo "<table id='trainTable'>";
        echo "<tr id='th'><td>열차 번호</td> <td>출발시각</td> <td>출발지</td> <td>도착지</td> </tr>";
        while ($row = mysqli_fetch_row($result)) {
            $train_num = $row[0];
            $depart = $row[1];
            $arrival = $row[2];
            $time = $row[3];
            echo "<tr><td>{$train_num}번</td> <td>$time</td> <td>$depart</td> <td>$arrival</td></tr>";
        }
        echo"</table>";
    ?>
    <div class='titles'><h3>예약</h3></div>
    <div id='select'>
        <form name="train_form" method="post" action="train.php">
            <select name="train_num">
                <option value=1000>1000번 열차</option>
                <option value=1001>1001번 열차</option>
                <option value=1002>1002번 열차</option>
                <option value=1003>1003번 열차</option>
                <option value=1004>1004번 열차</option>
                <option value=1005>1005번 열차</option>
                <option value=1006>1006번 열차</option>
            </select><br>
            <button type="submit">좌석 선택</button>
        </form>
    </div>
</body>
</html>