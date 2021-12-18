<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>회원가입</title>
    <link rel="stylesheet" type="text/css" href="./css/member_form.css">
</head>
<body>
    <header>
        <?php include "header.php";?>
    </header>

    <script>
        function check_input()
        {
            if (!document.member_form.id.value) {
                alert("아이디를 입력하세요!");    
                document.member_form.id.focus();
                return;
            }

            if (!document.member_form.pass.value) {
                alert("비밀번호를 입력하세요!");    
                document.member_form.pass.focus();
                return;
            }

            if (!document.member_form.pass_confirm.value) {
                alert("비밀번호확인을 입력하세요!");    
                document.member_form.pass_confirm.focus();
                return;
            }

            if (!document.member_form.name.value) {
                alert("이름을 입력하세요!");    
                document.member_form.name.focus();
                return;
            }

            if (!document.member_form.phone.value) {
                alert("번호를 입력하세요!");    
                document.member_form.phone.focus();
                return;
            }

            if (document.member_form.pass.value != 
                    document.member_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return;
            }

            document.member_form.submit();
        }

        function reset_form() {
            document.member_form.id.value = "";  
            document.member_form.pass.value = "";
            document.member_form.pass_confirm.value = "";
            document.member_form.name.value = "";
            document.member_form.id.focus();
            return;
        }

        function check_id() {
            window.open("member_check_id.php?id=" + document.member_form.id.value,
                "IDcheck",
                "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
        }
    </script>

	<section>
        <h2>회원 가입</h2>
        <div id="container">
          	<form  name="member_form" method="post" action="member_insert.php">
                    <div class="form">
				        <div class="col1">아이디</div>
				        <div class="col2">
							<input type="text" name="id">
				        </div>
			       	</div>
			       	<div class="form">
				        <div class="col1">비밀번호</div>
				        <div class="col2">
							<input type="password" name="pass">
				        </div>                 
			       	</div>
			       	<div class="form">
				        <div class="col1">비밀번호 확인</div>
				        <div class="col2">
							<input type="password" name="pass_confirm">
				        </div>                 
			       	</div>
			       	<div class="form">
				        <div class="col1">이름</div>
				        <div class="col2">
							<input type="text" name="name">
				        </div>                 
			       	</div>
			       	<div class="form">
				        <div class="col1">전화번호</div>
				        <div class="col2">
							<input type="text" name="phone">
				        </div>                 
			       	</div>
			       	<button id='ok' onclick="check_input()">확인</button>
           	</form>
        </div>
	</section>
</body>
</html>

