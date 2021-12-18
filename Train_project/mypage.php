<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>예매 내역 조회</title>
        <link rel="stylesheet" type="text/css" href="./css/mypage.css">
    </head>
    <body>
        <header>
            <?php include "header.php";?>
        </header>
        <?php
            session_start();
            $userid = $_SESSION["userid"];  //로그인된 아이디 불러오기

            $con = mysqli_connect("localhost:3310", "root", "phpadmin", "train_project");
            $sql = "select order_num from customer where id='$userid'"; //회원의 예매 번호 검색
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $order_num = $row["order_num"];

            if ($order_num == null) {   //예매 내역이 없는 경우
                echo "<h2 id='no'>예매 내역이 없습니다.</h2>";
            }
            else {                      //예매 내역이 있는 경우
            
                /* 예매 번호에 해당하는 열차 및 좌석 번호 검색 */
                $sql = "select train_num, seat_business, seat_economy from train where order_num = '$order_num'" ;
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                
                $train_num = $row["train_num"];         //열차 번호 불러오기
                if ($row["seat_business"] == null) {    //좌석 등급 및 좌석 번호 불러오기
                    $seat_level = "일반석";
                    $seat_num = $row["seat_economy"];
                }
                else {
                    $seat_level = "우등석";
                    $seat_num = $row["seat_business"];
                }

                /* 열차 번호에 해당하는 출발, 도착지 및 출발 시각 검색 */
                $sql = "select depart, arrival, time from korail where train_num='$train_num'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                $depart = $row["depart"];
                $arrival = $row["arrival"];
                $time = $row["time"];
            ?>

            <h2 id='title'>예매 내역 조회</h2>
            <table> <!--예매 내역 조회 테이블-->
                <tr><td>방향</td><td id='route'><?=$depart?> -> <?=$arrival?></td></tr>
                <tr><td>출발 시각</td><td><?=$time?></td></tr>
                <tr><td>열차 번호</td><td><?=$train_num?>번</td></tr>
                <tr><td>좌석 등급</td><td><?=$seat_level?></td></tr>
                <tr><td>좌석 번호</td><td><?=$seat_num?></td></tr><br>
            </table>
            <?php
            }
        ?>
    </body>
</html>