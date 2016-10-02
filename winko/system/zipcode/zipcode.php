<?
function search() {
global $form,$zip1,$zip2,$address,$target,$searchmode,$query,$ImgUrl,$Zipfile;
	if(!$query) {
		echo "<script>
				window.alert('검색할 지역명을 입력해 주세요');
				history.go(-1);
			  </script>";
		exit;
	}
	echo "<html>
	<head>
	<meta http-equiv='content-type' content='text/html; charset=euc-kr'>
	<TITLE>우편번호 찾기</TITLE>
	<link rel=StyleSheet HREF=../css/winko.css type=text/css title=style>
	<SCRIPT language=JavaScript>
		function Copy(zip1,zip2,address) {

			top.opener.document.$form.$zip1.value = zip1;
			top.opener.document.$form.$zip2.value = zip2;
			top.opener.document.$form.$address.value = address;
			top.opener.document.$form.$target.focus();

			// close this window
			parent.window.close();

		}
		</SCRIPT>
	</head>
	<body bgcolor='white' text='black' link='blue' vlink='purple' alink='red' leftmargin='0' marginwidth='0' topmargin='0' marginheight='0'>
	<table width='380' border='0' align='center'>
	<tr><td>
	
	<br>";

	$query = chop($query);
	$datum = file("$Zipfile");
    while ($data = each($datum)) {
        if(eregi("$query", $data[1])) {
		$all_code = split(" ",$data[1]);
		$zips = split("-", $all_code[0]);

		if ( ereg("~", $all_code[sizeof($all_code)-1] ) ) {
			$add = eregi_replace($all_code[sizeof($all_code)-1], "", $data[1]);
			$add = trim(substr($add, 8, 100));
		}
		else {
			$add = trim(substr($data[1], 8, 100));
		}
		echo "&nbsp; 
          <img src=$ImgUrl/dot.gif border=0>&nbsp;<a href=\"javascript: Copy('$zips[0]','$zips[1]','$add')\">$data[1]</a><BR>\n";
		 
		 $see = 1;
        }
    }
	if(!$see) {
		echo "<img src=$ImgUrl/dot.gif border=0> &nbsp;찾으시는 지역이 존재하지 않습니다.";
	}
	echo "<br><br></td></tr></table>";
}
//##########################################################################
function show_top() {
global $ImgUrl,$PhpUrl,$form,$zip1,$zip2,$address,$target;

	echo "<html>
	<head>
	<meta http-equiv='content-type' content='text/html; charset=euc-kr'>
	<TITLE>우편번호 검색</TITLE>
	<link rel=StyleSheet HREF=../css/winko.css type=text/css title=style>
	</head>
	<body leftmargin=0 marginwidth=0 topmargin=0 marginheight=0 scroll=no onLoad=document.gil.query.focus()>

	<table width=100% border=0 cellpadding=0 cellspacing=0>
	<tr><td align=center><img src=$ImgUrl/zipcode_01.jpg></td></tr>
	<tr><td align=center height=10></td></tr>
	<tr><td align=center>
	<FORM action=$PhpUrl method=post target=Down name=gil>
	<input type=hidden name=mode value=search>

	<input type=hidden name=form value=$form>
	<input type=hidden name=zip1 value=$zip1>
	<input type=hidden name=zip2 value=$zip2>
	<input type=hidden name=address value=$address>
	<input type=hidden name=target value=$target>
	<select name=searchmode onChange=document.gil.query.focus() style='FONT-SIZE: 9pt'>
	<option value=address>주소로 찾기
	<option value=code>우편번호로 찾기
	</select><input type=text name=query size=15 style='FONT-SIZE: 9pt'> <input type=image src='$ImgUrl/search.gif' border=0 align=absmiddle>

	</FORM>
	</td></tr></table>
	</body>
	</html>";

}

//##########################################################################
function show_down() {

	echo "<html>
	<meta http-equiv='content-type' content='text/html; charset=euc-kr' />
	<link rel=StyleSheet HREF=../css/winko.css type=text/css title=style>
	<body leftmargin=0 marginwidth=0 topmargin=0 marginheight=0 >
	<table width=400 height=100% border=0 cellpadding=0 cellspacing=0>
	<tr><td align=center height=100%><font color='#24a3e0'>동/읍/면의 이름을 입력하시고 \"검색\" 을 클릭하세요.<br>
	(예: 호계동 또는 부여읍 또는 외산면)</font>
	</td></tr>
	</table>
	</body>
	</html>";

}

//##########################################################################
function show_bottom() {

	echo "<html>
	<meta http-equiv='content-type' content='text/html; charset=euc-kr'>
	<body leftmargin=0 marginwidth=0 topmargin=0 marginheight=0 >
	<table width=400 border=0 cellpadding=0 cellspacing=0 align=center>
	<tr><td align=left background='../winko_img/zipcode/zipcode_04.gif'><img src='../winko_img/zipcode/zipcode_04.gif'></td></tr>
	</table>
	</body>
	</html>";

}

//#####################################################################################
function print_top() {
global $form,$zip1,$zip2,$address,$target;

	echo "<HTML>
	<HEAD>
	<meta http-equiv='content-type' content='text/html; charset=euc-kr'>
	<TITLE>우편번호 검색</TITLE>
	<FRAMESET ROWS=\"75,*,13\" border='0'>
		<FRAME SRC=zipcode.php?mode=top&form=$form&zip1=$zip1&zip2=$zip2&address=$address&target=$target NAME=Top scrolling='no' marginwidth='0' marginheight='0' >
		<FRAME SRC=zipcode.php?mode=down NAME=Down scrolling='auto' marginwidth='0' marginheight='0'>
		<FRAME SRC=zipcode.php?mode=bottom scrolling='no' marginwidth='0' marginheight='0'>
		</FRAMESET>
	</HEAD>
	</HTML>";
}
//##################################################################################


$PhpUrl = "./zipcode.php";
$ImgUrl = "../winko_img/zipcode";
$Zipfile = "./zipcode.db";

if($mode == 'top') { show_top(); }
elseif($mode == 'down') { show_down(); }
elseif($mode == 'bottom') { show_bottom(); }
elseif($mode == 'search') { search(); }
else {print_top(); }



?>
