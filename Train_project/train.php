<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>좌석 예약</title>
    <link rel="stylesheet" type="text/css" href="./css/train.css">
</head>
<body>
    <?php
        $train_num = $_POST["train_num"];
    ?>
    <!-- 선택한 열차 번호 표시 및 열차 변경 버튼 -->
    <h2>[ <?=$train_num?>번 열차 ]</h2>
    <div id='change'><button onclick="history.go(-1)">열차 변경</button></div>

    <?php
        $con = mysqli_connect("localhost:3310", "root", "phpadmin", "train_project");

        /* 좌석 등급에 따른 가격 검색 */
        $sql = "select * from seat_level where type='business'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $business_price = $row["price"];

        $sql = "select * from seat_level where type='economy'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $economy_price = $row["price"];

        echo "<div class='titles'><h3>좌석</h3></div>";
        echo "<div id='price'>[요금 안내] 우등석: {$business_price}원, 일반석: {$economy_price}원</div>";

        $sql = "select * from train where train_num='$train_num'";
        $result = mysqli_query($con, $sql);

        echo "<table>";
        echo "<tr id='th'><td>좌석 등급</td><td>좌석 번호</td><td>현황</td></tr>";
        while ($row = mysqli_fetch_row($result)) {
            if ($row[3] == null) {         //우등석인 경우
                $type = "business";
                $type_print = "우등석";
                $seat_num = $row[2];
                $price = $business_price;
            }
            else {                          //일반석인 경우
                $type = "economy";
                $type_print = "일반석";
                $seat_num = $row[3];
                $price = $economy_price;
            }
            if ($row[4] == 1) {             //check == 1이면 예매 불가
                $available = "예매 불가";
            }
            else {                          //check == 0이면 예매 가능
                $available = "예매 가능";
            }

            if ($available == "예매 불가") {    //예매 불가 좌석은 빨간색 표시
            ?>
                <tr><td><?=$type_print?></td><td><?=$seat_num?></td><td style="color: rgb(172, 14, 14);"><?=$available?></td></tr>
            <?php
                }
                else {                          //예매 가능 좌석은 파란색 표시
            ?>
                <tr><td><?=$type_print?></td><td><?=$seat_num?></td><td style="color: rgb(14, 51, 172);"><?=$available?></td></tr>
            <?php
                }
        }
                echo "</table>";
    ?>

    <div class='titles'><h3>예매</h3></div>
    <div id="reservation">
        <table>
            <tr><td>열차 번호</td><td><?=$train_num?>번</td></tr>
            <!-- 열차 번호, 좌석 등급, 좌석 번호 POST로 전달 -->
            <form name="seat_level_form" method="post" action="check.php">
                <input type="hidden" name="train_num" value="<?=$train_num?>">
                <tr><td>좌석 등급</td><td>
                    <select name="seat_level">
                        <option value="우등석">우등석</option>
                        <option value="일반석">일반석</option>
                    </select></td></tr>
                <tr><td>좌석 번호</td><td>
                    <select name="seat_num">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                    </select></td></tr>
                <!-- '확인' 버튼을 누르면 check.php로 POST -->
                <tr><td colspan=2><button id='ok' type="submit">확인</button></td></tr>
            </form>
        </table>
    </div>
</body>
</html>