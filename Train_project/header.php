<head>
    <meta charset='uft-8'>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
</head>
<body>
    <?php
        session_start();
        /* 로그인 상태 확인 */
        if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
        else $userid = "";
        if (isset($_SESSION["username"])) $username = $_SESSION["username"];
        else $username = "";
    ?>
    <div>
        <ul id='header_ul'>
            <li><a href="main.php">Home</a></li>    <!--Main 페이지 연결-->
            <li> | </li>
            <li><a href="buy.php"><h3>열차 시간표 조회 및 예매</h3></a></li> <!--열차표 시간 조회 및 예매 페이지 연결-->
            <li> | </li>
        <?php
            if(!$userid) {          //로그인 상태가 아닌 경우
                ?>                
                    <li><a href="login_form.php"><h3>로그인</h3></a></li>       <!--로그인 페이지 연결-->
                    <li> | </li>
                    <li><a href="member_form.php"><h3>회원가입</h3></a></li>    <!--회원가입 페이지 연결-->
                <?php
                    } else {        //로그인 상태인 경우
                ?>
                    <li><?=$username?>님</li>                                   <!--사용자 이름 표시-->
                    <li><a href="logout.php"><h3>로그아웃</h3></a></li>         <!--로그아웃 페이지 연결-->
                    <li> | </li>
                    <li><a href="mypage.php"><h3>예매 내역 조회</h3></a></li>   <!--예매 내역 조회 페이지 연결-->
                <?php
                    }
                ?>
        </ul>
    </div>
</body>