<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>예약 확인</title>
    <link rel="stylesheet" type="text/css" href="./css/check.css">
</head>
<body>
    <?php
        $train_num = $_POST["train_num"];   //열차 번호 가져오기
        $seat_level = $_POST["seat_level"]; //좌석 등급 가져오기
        $seat_num = $_POST["seat_num"];     //좌석 번호 가져오기

        /* 열차 번호에 해당하는 출발, 도착지 및 출발 시각 검색 */
        $con = mysqli_connect("localhost:3310", "root", "phpadmin", "train_project");
        $sql = "select * from korail where train_num='$train_num'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
                    
        $depart = $row["depart"];
        $arrival = $row["arrival"];
        $time = $row["time"];
    ?>
    <!-- 예매 확인 테이블 -->
    <div id='title'><h2>예매 확인</h2></div>
    <table>
        <tr><td>방향</td><td id='route'><?=$depart?> -> <?=$arrival?></td></tr>
        <tr><td>출발 시각</td><td><?=$time?></td></tr>
        <tr><td>열차 번호</td><td><?=$train_num?>번</td></tr>
        <tr><td>좌석 등급</td><td><?=$seat_level?></td></tr>
        <tr><td>좌석 번호</td><td><?=$seat_num?></td></tr><br>
        <tr><td colspan=2 id='buttonCell'><button onclick="reserve();">예매 확정</button></td></tr>
    </table>
    <script>
        function reserve() {
            confirm = confirm("예매하시겠습니까?");
            if (confirm) {  //확인을 누른 경우
                <?php
                    session_start();
                    $userid = $_SESSION["userid"];  //로그인된 아이디 불러오기

                    /* 선택한 좌석에 해당하는 예약 번호 검색 */
                    if ($seat_level == "우등석") {
                        $sql_select_order_num = "SELECT order_num from train WHERE (train_num = '$train_num' and seat_business = '$seat_num' and seat_economy is null)";
                    }
                    else {
                        $sql_select_order_num = "SELECT order_num from train WHERE (train_num = '$train_num' and seat_economy = '$seat_num' and seat_business is null)";
                    }
                    $result = mysqli_query($con, $sql_select_order_num);
                    $row = mysqli_fetch_array($result);
                    $order_num = $row["order_num"];
                    
                    /* 예매 내역 업데이트 */
                    $sql_update_train = "UPDATE train SET check1 = 1 WHERE order_num = '$order_num'";
                    $sql_update_customer = "UPDATE customer SET order_num = '$order_num' WHERE id='$userid'";

                    mysqli_query($con, $sql_update_train);
                    mysqli_query($con, $sql_update_customer);
                ?>   
                alert("예매가 완료되었습니다.");
                location.replace("main.php");   //예매 완료 후 Home 페이지로 이동
            }
        }
    </script>
</body>
</html> 