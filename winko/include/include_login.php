<?
if($MEMBER_ID) {
	movepage("winko.php?code=$code&v=$v");
}
?>
<?if($v=="eng"||$v=="jp"){?>
<script>
function check_submit() {
	if(!login.PHP_AUTH_USER.value) {
		alert("Please enter your ID.");
		login.PHP_AUTH_USER.focus();
		return false;
	}
	if(!login.PHP_AUTH_PW.value) {
		alert("Please enter your Password.");
		login.PHP_AUTH_PW.focus();
		return false;
	}
	return true;
}
</script>
<?}else{?>
<script>
function check_submit() {
	if(!login.PHP_AUTH_USER.value) {
		alert("아이디를 입력하여 주세요");
		login.PHP_AUTH_USER.focus();
		return false;
	}
	if(!login.PHP_AUTH_PW.value) {
		alert("비밀번호를 입력하여 주세요");
		login.PHP_AUTH_PW.focus();
		return false;
	}
	return true;
}
</script>
<?}?>
<FORM action='winko/include/post_login.php' method='post' onsubmit='return check_submit();' name=login>
<input type='hidden' name='code' value='<?=$code?>'>
<input type='hidden' name='category' value='<?=$category?>'>
<input type='hidden' name='v' value='<?=$v?>'>
<?
  include $skin_folder."/login.php";
?>
</form>
