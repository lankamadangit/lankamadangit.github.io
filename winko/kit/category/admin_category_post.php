<?
if($mode=="write"){

	if (!$name || !$_POST["name"]) {
		error2("알수없는 문제로 정보가 넘어오지 않았습니다.","admin.php?option=category&option2=write");
		exit;
	}

	if($hidden_part_index == "1") {
		$part1_row = mysql_fetch_array(mysql_query("SELECT MAX(part_ranking), MAX(menu_idx) FROM {$top}_category")); 
		if($part1_row[0]) { 
			$part_ranking = $part1_row[0] +1; 
		} else { 
			$part_ranking = 1; 
		}

		if($part1_row[1]) { 
			$menu_idx = $part1_row[1] +1; 
		} else { 
			$menu_idx = 1; 
		}

		$qry = "INSERT INTO {$top}_category(menu_idx, part_name, part1_code, part_index, part_low_check, part_ranking) VALUES(";
		$qry.= "'$menu_idx',";												//1차카테고리 idx
		$qry.= "'$_POST[name]',";										//카테고리명
		$qry.= "'$code',";														//카테고리 코드
		$qry.= "$_POST[hidden_part_index], ";					//카테고리 순위
		$qry.= "$_POST[part_low_check], ";						//하위 카테고리 설정
		$qry.= "$part_ranking";											//카테고리 순서
		$qry.= ")";

		$result_cate=mysql_query($qry);
		if($result_cate) {
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script> window.alert('1차 카테고리 등록완료 하였습니다.')</script>";
			movepage("admin.php?option=category");
		} else {
			echo "$qry";
		}
	} else if($hidden_part_index == "2") {
		$part2_row = mysql_fetch_array(mysql_query("SELECT MAX(part_ranking) FROM {$top}_category where part_index = '$hidden_part_index'")); 

		if($part2_row[0]) { 
			$part_ranking = $part2_row[0] +1; 
		} else { 
			$part_ranking = 1; 
		}

		$qry = "INSERT INTO {$top}_category(menu_idx, part_name, part1_code, part2_code, part_index, part_low_check, part_ranking) VALUES(";
		$qry.= "'$menu_idx1',";											//1차카테고리 idx
		$qry.= "'$_POST[name]',";										//카테고리명
		$qry.= "'$_POST[part1_code]',";								//1차 카테고리 코드
		$qry.= "'$code',";														//2차 카테고리 코드
		$qry.= "$_POST[hidden_part_index], ";					//카테고리 순위
		$qry.= "0, ";																//하위 카테고리 설정
		$qry.= "$part_ranking";											//카테고리 순서
		$qry.= ")";
		if(mysql_query($qry)) {
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script> window.alert('2차 카테고리 등록완료 하였습니다.')</script>";
			movepage("admin.php?option=category");
		} else {
			echo "$qry $reidArr[0]";
		}
	} else if($hidden_part_index == "3") {
		$part3_row = mysql_fetch_array(mysql_query("SELECT MAX(part_ranking) FROM {$top}_category where part_index = '$hidden_part_index'")); 

		if($part3_row[0]) { 
			$part_ranking = $part3_row[0] +1; 
		} else { 
			$part_ranking = 1; 
		}

		$qry = "INSERT INTO {$top}_category(menu_idx, part_name, part1_code, part2_code, part3_code, part_index, part_low_check, part_ranking) VALUES(";
		$qry.= "'$menu_idx2',";											//1차카테고리 idx
		$qry.= "'$_POST[name]',";										//카테고리명
		$qry.= "'$_POST[part1_code]',";								//1차 카테고리 코드
		$qry.= "'$_POST[part2_code]',";								//2차 카테고리 코드
		$qry.= "'$code',";														//3차 카테고리 코드
		$qry.= "$_POST[hidden_part_index], ";					//카테고리 순위
		$qry.= "0, ";																//하위 카테고리 설정
		$qry.= "$part_ranking";											//카테고리 순서
		$qry.= ")";
		if(mysql_query($qry)) {
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script> window.alert('3차 카테고리 등록완료 하였습니다.')</script>";
			movepage("admin.php?option=category");
		} else {
			echo "$qry $reidArr[0]";
		}
	}
} //if($mode=="write"){

elseif($mode=="edit") {
	$qry = "UPDATE {$top}_category SET ";
	$qry.= "part_name = '$name', ";
	$qry.= "part_low_check = '$part_low_check' ";
	$qry.= " WHERE idx='$idx' AND part_index='$hidden_part_index'";

	if(mysql_query($qry)) {
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script> window.alert('수정완료 하였습니다.')</script>";
		movepage("admin.php?option=category");
	} else {
		echo "$qry";
	}
} //elseif($mode=="edit"){

elseif($mode == "ranking") {

$_GET=&$HTTP_GET_VARS;
$_POST=&$HTTP_POST_VARS;

# $list1 # 1차 카테고리
# $list2 # 2차 카테고리
# $list3 # 3차 카테고리

	# 각 카테고리별 업데이트
	# 1차

	$arr_1 = explode("&&", $_POST[list1] );

	while ( list($key,$val) = each($arr_1) ) {
		$key++;
		$qry1 = "UPDATE {$top}_category SET ";
		$qry1.= "part_ranking = '$key'";
		$qry1.= " WHERE part1_code='$val' AND part_index='1'";

		if(mysql_query($qry1)) {
		} else {
			echo "$qry1";
		}
 
	}
	# 2차
	$arr_2 = explode("&&", $_POST[list2] );
	while ( list($key,$val) = each($arr_2) )
	{
		$key++;
		$qry2 = "UPDATE {$top}_category SET ";
		$qry2.= "part_ranking = '$key'";
		$qry2.= " WHERE part2_code='$val' AND part_index='2'";

		if(mysql_query($qry2)) {
		} else {
			echo "$qry2";
		}
	}	
	
	# 3차
	$arr_3 = explode("&&", $_POST[list3] );
	while ( list($key,$val) = each($arr_3) )
	{
		$key++;
	//	$db->update("cs_part", "part_ranking=$key where part_index=3 and part3_code='$val'");
		$qry3 = "UPDATE {$top}_category SET ";
		$qry3.= "part_ranking = '$key'";
		$qry3.= " WHERE part3_code='$val' AND part_index='3'";

		if(mysql_query($qry3)) {
		} else {
			echo "$qry3";
		}
	}
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script> window.alert('카테고리 순위 수정 완료 하였습니다.')</script>";
	movepage("admin.php?option=category");

}


elseif($mode=="del"){ 

	//상품 삭제
	if($hidden_part_index == "1") {
		$part1_qry = mysql_fetch_array(mysql_query("SELECT part1_code FROM {$top}_category WHERE idx='$idx'")); 
		$part1_code = $part1_qry[0];

		$part_cnt_qry = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM {$top}_category WHERE part1_code='$part1_code'")); 
		$part_cnt = $part_cnt_qry[0];

		if($part_cnt > 1) {
			$part_cnt_qry2 = "SELECT * FROM {$top}_category WHERE part1_code='$part1_code' AND part_index = 2";
			$part_result2 = mysql_query($part_cnt_qry2);

			while($part_row2 = mysql_fetch_array($part_result2)) {
				$goods_del_qry = "SELECT * FROM {$top}_product WHERE category_code ='$part_row2[part2_code]'";
				$goods_del_result = mysql_query($goods_del_qry); 
				while($goods_del_row = mysql_fetch_array($goods_del_result)) {
					@unlink("winko/data/product/$goods_del_row[goods_img]");
					$del_qry = "DELETE from {$top}_product WHERE category_code ='$part_row2[part2_code]'";
					mysql_query($del_qry);
				}
			}
		} else {
			$goods_del_qry2 = "SELECT * FROM {$top}_product WHERE category_code ='$part1_code'";
			$goods_del_result2 = mysql_query($goods_del_qry2); 
			while($goods_del_row2 = mysql_fetch_array($goods_del_result2)) {
				@unlink("winko/data/product/$goods_del_row2[goods_img]");
				$del_qry2 = "DELETE from {$top}_product WHERE category_code ='$part1_code'";
				mysql_query($del_qry2);
			}
		}
		
		//카테고리 삭제
		$cate_del_qry = "DELETE from {$top}_category WHERE part1_code='$part1_code'";
		mysql_query($cate_del_qry);

	} else { 
		//상품삭제
		$goods_del_qry3 = "SELECT * FROM {$top}_product WHERE part_idx ='$idx'";
		$goods_del_result3 = mysql_query($goods_del_qry3);
		while($goods_del_row3 = mysql_fetch_array($goods_del_result3)) {
			@unlink("winko/data/product/$goods_del_row3[goods_img]");
			$del_qry3 = "DELETE from {$top}_product WHERE part_idx ='$idx'";
			mysql_query($del_qry3);
		}

		//카테고리 삭제
		$cate_del_qry2 = "DELETE from {$top}_category WHERE idx='$idx' AND part_index = '$hidden_part_index'";
		mysql_query($cate_del_qry2);

	}

	OnlyMsgView("삭제완료 하였습니다.");
	ReFresh("admin.php?option=category");
	exit;
}

?>
