<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>로그인</title>
	<link rel="stylesheet" type="text/css" href="./css/login_form.css">
</head>
<body> 
	<header>
		<?php include "header.php";?>
    </header>
	<section>
		<h2>로그인</h2>
        <form name="login_form" method="post" action="login.php">		       	
			<div id="container">
                <div><input type="text" name="id" placeholder="아이디" ></div>
				<div><input type="password" id="pass" name="pass" placeholder="비밀번호" ></div>
                <button onclick="check_input();">로그인</button>	    	
           	</form>
    	</div>
		<script>
			function check_input() {
				if (!document.login_form.id.value)
				{
					alert("아이디를 입력하세요");    
					document.login_form.id.focus();
					return;
				}

				if (!document.login_form.pass.value)
				{
					alert("비밀번호를 입력하세요");    
					document.login_form.pass.focus();
					return;
				}
				document.login_form.submit();
			}
		</script>
	</section> 
</body>
</html>

