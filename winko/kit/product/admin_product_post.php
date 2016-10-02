<html>
<head>
<title>Korps SiteManager</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel=StyleSheet HREF="winko/system/css/winko_admin_utf.css" type=text/css title=style>
</head>
<body>
<?
if($mode=="write"){
	$part_code = addslashes(trim($part_code));
	$product_code = addslashes(trim($product_code));

	// 1차 카테고리 코드정보 얻기
	$part_row=mysql_fetch_array(mysql_query("SELECT * FROM {$top}_category WHERE part1_code='$part_code' or part2_code='$part_code' or part3_code='$part_code'"));

if(!empty($img1_name)) {
		$img_size1 = filesize($img1);

		if($img_size1 > 5242880) {
			issueError("제품 이미지는 5MB를 넘을 수 없습니다.", "history.go(-1);");
			$img1_name = "";
		} else {
			$arr_file1 = explode(".",$img1_name);
			$ext_no1 = count($arr_file1)-1;
			$file_ext1 = $arr_file1[$ext_no1];

			$img1_info=@getimagesize($img1);		//이미지 정보
			if(($img1_info[2]!=1) && ($img1_info[2]!=2)) {
				issueError("이미지 형식을 gif , jpg로 입력해 주세요", "history.go(-1);");
				exit;
			}
			$img1_name ="img1_".time().rand(100,999).".".$file_ext1;
			@move_uploaded_file($img1, "winko/data/product/".$img1_name); //파일복사
			@unlink($img1);
			
			/***** 썸네일 ******/
			$home_url = "winko/data/product/";
			$thumb_url = "thumb/";
			$gdimg_width = 133;
			$gdimg_height = 116;

			$tmp_src = explode(".",$img1_name);
			$tmp_src[0] = "gd_".$tmp_src[0];
			$dst_file = join(".",$tmp_src);

			if($tmp_src[1] == "jpg" || $tmp_src[1] == "JPG") {
				$src = imagecreatefromjpeg($home_url.$img1_name); 
				$dst = imagecreatetruecolor($gdimg_width, $gdimg_height); //GD 2.0
				ImageColorAllocate($dst, 255, 255, 255); 
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $gdimg_width, $gdimg_height, imagesx($src), imagesy($src)); //GD 2.0 이상 
				imagejpeg($dst, $home_url.$thumb_url.$dst_file, 60); 
				ImageDestroy($dst);
			} elseif($tmp_src[1] == "gif" || $tmp_src[1] == "GIF") {
				$src = ImageCreateFromGIF($home_url.$img1_name); 
				$dst = imagecreatetruecolor($gdimg_width, $gdimg_height); //GD 2.0
				ImageColorAllocate($dst, 255, 255, 255); 
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $gdimg_width, $gdimg_height, imagesx($src), imagesy($src)); //GD 2.0 이상 
				imagegif($dst, $home_url.$thumb_url.$dst_file, 60); 
				ImageDestroy($dst); 
			}
		}
	}

	##### PDF  업로드 #######
if($userfile) { // 파일 첨부를 허용했을 경우
	$upload = "winko/data/pdf";

	if(file_exists("$upload/$userfile_name")) {
		//error2("동일한 이름의 파일이 존재합니다.");
		$userfile_name = time()."_".$userfile_name;
	}

	if("10485760" <$userfile_size) error2("10MB 이상은 업로드 할 수 없습니다.");

	$file_name = substr( strrchr($userfile_name,"."),1);

	if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
		error2("Html, PHP 관련파일은 업로드할수 없습니다");
	} // 보안을 위해 확장자를 확인 하는 루틴

	$userfile_name=str_replace(" ","_",$userfile_name);
	$userfile_name=str_replace("-","_",$userfile_name);

	//한글파일 엔코드
	$userfile_name_ecd=urlencode($userfile_name); 
	if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
		error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
	}
	copy($userfile, "$upload/$userfile_name");
	unlink($userfile);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
	$filename = $userfile_name_ecd;
	$filesize = $userfile_size;
}

	$ip=$REMOTE_ADDR; // 아이피값 구함;
	$signdate = time();

	$qry = "INSERT INTO {$top}_product(menu_idx,part_idx,category_code,product_code,product_name,product_img1,userfile,filesize,summary,content1,content2,Reg_date,ip";
	$qry.= ") VALUES(";
	$qry.= "$part_row[menu_idx],";					//상위메뉴
	$qry.= "$part_row[idx],";							//카테고리 idx
	$qry.= "'$part_code',";								//카테고리 코드
	$qry.= "'$product_code',";							//상품코드
	$qry.= "'$product_name',";							//상품 Name
	$qry.= "'$img1_name',";								//리스트 이미지
	$qry.= "'$filename',";										//pdf
	$qry.= "'$filesize',";										//pdf 파일 사이즈
	$qry.= "'$summary',";										//Feature
	$qry.= "'$content1',";									//Details
	$qry.= "'$content2',";									//Details
	$qry.= "$signdate,";									//등록일
	$qry.= "'$ip";												//ip
	$qry.= "')";
	
	if(mysql_query($qry)) {
		OnlyMsgView("제품 등록을 완료 하였습니다.");
		ReFresh("admin.php?option=product&part_idx=$part_row[idx]"); 
		exit;
	} else {
		echo "Err. : $qry";
	}
}

elseif($mode=="edit"){ 

	$part_code = addslashes(trim($part_code));
	$part_row=mysql_fetch_array(mysql_query("SELECT * FROM {$top}_category WHERE part1_code='$part_code' or part2_code='$part_code' or part3_code='$part_code'"));
	$goods_row=mysql_fetch_array(mysql_query("SELECT * FROM {$top}_product WHERE idx='$idx' AND menu_idx='$menu_idx'"));

	if($del_check) {
		$img_url = "winko/data/product/$goods_row[product_img1]";
		@unlink($img_url);
		$img_url_thumb = "winko/data/product/thumb/gd_$goods_row[product_img1]";
		@unlink($img_url_thumb);
	}

	if(!empty($img1_name)) {
		
		if(!$del_check) {
			$img_url = "winko/data/product/$goods_row[product_img1]";
			@unlink($img_url);
			$img_url_thumb = "winko/data/product/thumb/gd_$goods_row[product_img1]";
			@unlink($img_url_thumb);
		}

		$img_size1 = filesize($img1);

		if($img_size1 > 5242880) {
			issueError("제품 이미지는 5MB를 넘을 수 없습니다.", "history.go(-1);");
			$img1_name = "";
		} else {
			$arr_file1 = explode(".",$img1_name);
			$ext_no1 = count($arr_file1)-1;
			$file_ext1 = $arr_file1[$ext_no1];

			$img1_info=@getimagesize($img1);		//이미지 정보
			if(($img1_info[2]!=1) && ($img1_info[2]!=2)) {
				issueError("이미지 형식을 gif , jpg로 입력해 주세요", "history.go(-1);");
				exit;
			}
			$img1_name ="img1_".time().rand(100,999).".".$file_ext1;
			@move_uploaded_file($img1, "winko/data/product/".$img1_name); //파일복사
			@unlink($img1);
			@unlink("winko/data/product/$goods_row[goods_img]");		//본이미지 삭제
			@unlink("winko/data/product/thumb/gd_".$goods_row[goods_img].""); //썸네일이미지삭제
			
			/***** 썸네일 ******/
			$home_url = "winko/data/product/";
			$thumb_url = "thumb/";
			$gdimg_width = 118;
			$gdimg_height = 100;

			$tmp_src = explode(".",$img1_name);
			$tmp_src[0] = "gd_".$tmp_src[0];
			$dst_file = join(".",$tmp_src);

			if($tmp_src[1] == "jpg" || $tmp_src[1] == "JPG") {
				$src = imagecreatefromjpeg($home_url.$img1_name); 
				$dst = imagecreatetruecolor($gdimg_width, $gdimg_height); //GD 2.0
				ImageColorAllocate($dst, 255, 255, 255); 
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $gdimg_width, $gdimg_height, imagesx($src), imagesy($src)); //GD 2.0 이상 
				imagejpeg($dst, $home_url.$thumb_url.$dst_file, 60); 
				ImageDestroy($dst);
			} elseif($tmp_src[1] == "gif" || $tmp_src[1] == "GIF") {
				$src = ImageCreateFromGIF($home_url.$img1_name); 
				$dst = imagecreatetruecolor($gdimg_width, $gdimg_height); //GD 2.0
				ImageColorAllocate($dst, 255, 255, 255); 
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $gdimg_width, $gdimg_height, imagesx($src), imagesy($src)); //GD 2.0 이상 
				imagegif($dst, $home_url.$thumb_url.$dst_file, 60); 
				ImageDestroy($dst); 
			}
		}
	}

	if($del_check1) {
		$product_url = "winko/data/pdf/$goods_row[userfile]";
		@unlink($product_url);
	}

	##### 업로드 one #######
	if($userfile) { // 파일 첨부를 허용했을 경우
		if(!$del_check1) {
			$product_url2 = "winko/data/pdf/$goods_row[userfile]";
			@unlink($product_url2);
		}

		$upload = "winko/data/pdf";

		if(file_exists("$upload/$userfile_name")) {
			//error2("동일한 이름의 파일이 존재합니다.");
			$userfile_name = time()."_".$userfile_name;
		}

		if("10485760"<$userfile_size) error2("10MB 이상은 업로드 할 수 없습니다.");
		$file_name = substr( strrchr($userfile_name,"."),1);
		
		if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
			error2("Html, PHP 관련파일은 업로드할수 없습니다");
		} // 보안을 위해 확장자를 확인 하는 루틴

		$userfile_name=str_replace(" ","_",$userfile_name);
		$userfile_name=str_replace("-","_",$userfile_name);

		$userfile_name_ecd=urlencode($userfile_name);    

		if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
			error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
		}

		copy($userfile, "$upload/$userfile_name");
		unlink($userfile);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
		$n_filename = $userfile_name_ecd;
		$n_filesize = $userfile_size;
	}


	$qry = "UPDATE {$top}_product SET ";
	$qry.= " menu_idx = '$part_row[menu_idx]',";
	$qry.= " part_idx = '$part_row[idx]',";
	$qry.= " category_code = '$part_code',";
	$qry.= " product_name = '$product_name',";
	if($del_check) {
		$qry.= " product_img1 	= '',";
	}
	if(!empty($img1_name)) {
		$qry.= " product_img1 	= '$img1_name',";
	}
	if($del_check1) {
		$qry.= " userfile 	= '',";
		$qry.= " filesize 	= '',";
	}
	if(!empty($n_filename)) {
		$qry.= " userfile 	= '$n_filename',";
	}
	if(!empty($n_filesize)) {
		$qry.= " filesize 	= '$n_filesize',";
	}
	$qry.= " summary = '$summary',";
	$qry.= " content1 = '$content1',";
	$qry.= " content2 	= '$content2'";
	$qry.= " WHERE idx='$idx' AND menu_idx='$menu_idx'";

	if(mysql_query($qry)) {
		OnlyMsgView("수정을 완료 하였습니다.");
		ReFresh("admin.php?option=product&part_idx=$goods_row[part_idx]"); 
		exit;
	} else {
		echo "Err. : $qry";
	}
} 

elseif($mode=="del"){ 

	$goods_row2=mysql_fetch_array(mysql_query("SELECT * FROM {$top}_product WHERE idx='$idx' AND menu_idx='$menu_idx'"));
	$img_url = "winko/data/product/$goods_row2[product_img1]";
	@unlink($img_url);
	$img_url_thumb = "winko/data/product/thumb/gd_$goods_row2[product_img1]";
	@unlink($img_url_thumb);
	$pdf_url = "winko/data/pdf/$goods_row2[userfile]";
	@unlink($pdf_url);
//	$thum_img_name = "gd_".$goods_row2[product_img1];
//	$thum_img_url = "winko/data/product/thum/$thum_img_name";
//	@unlink($thum_img_url);

	$qry = "DELETE FROM {$top}_product WHERE idx='$idx' AND menu_idx='$menu_idx'";

	if(mysql_query($qry)) {
		OnlyMsgView("삭제완료 하였습니다.");
		ReFresh("admin.php?option=product&part_idx=$goods_row2[part_idx]");
		exit;
	} else {
		echo"Err. : $qry";
	}
}

?>
</body>
</html>