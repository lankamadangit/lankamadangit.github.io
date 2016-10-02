<?php
        // 이미지 사이즈
        $cWidth = "80";
        $cHeight = "40";

        // 캔버스 BG & line color setting ( BG random )
        $bImgLine = array(225,225,225);
        $bImgRand = array(
            array(189,162,198), array(206,158,156), array(165,158,132), array(206,199,189),
            array(189,174,165), array(173,182,156), array(181,186,173), array(173,186,123)
        );


        // Font GET ( Font random)
        $useFont = array('arial.ttf','tahoma.ttf','GOTHICB.TTF','georgia.ttf');

        $useFontPath = "font";

        $fontSize=13;
        $params = explode("/", $_GET['autoStrParam']);
        // 랜덤 문자 뽑아오기
		//배열을 뽑아 오고 나서
		//키값과  value값으로 가지고 온다음에
        foreach($params as $key=>$val)
        {
        	if($val >= 0)
        	{
				//뽑아 온값이 0보다 크면 그 값들을 저장 한다
                $str[]= $val;
        	}
        }
        $sString = $str;

        // 캔버스 생성
        $randKey = mt_rand(1, count($bImgRand) ) - 1;
        $bgCanvas = ImageCreate($cWidth+2, $cHeight+2);

        $color['white']=ImageColorAllocate($bgCanvas, 255, 255, 255);
        $color['grey']=ImageColorAllocate($bgCanvas, 85, 85, 85);
        $color['black']=ImageColorAllocate($bgCanvas, 0, 0, 0);
        $color['line']= ImageColorAllocate($bgCanvas, $bImgLine[0], $bImgLine[1], $bImgLine[2]);
        $color['rand']= ImageColorAllocate($bgCanvas, $bImgRand[$randKey][0], $bImgRand[$randKey][1], $bImgRand[$randKey][2]);

        ImageFilledRectangle($bgCanvas, 0, 0, $cWidth, $cHeight, $color['line']);
        ImageFilledRectangle($bgCanvas, 1, 1, $cWidth-1, $cHeight-1, $color['white']);

        // 격자 생성
        /// 가로줄 만들기
        $initX = mt_rand($min=2, $max=4);
        $space = mt_rand($min=4, $max=12);
        for( $left=$initX; $left < $cWidth ; $left+=$space)
        {
            if( $left < $cWidth ) ImageLine($bgCanvas, $left, 0, $left, $cHeight, $color['line']);
        }

        /// 세로줄 만들기
        $initY = mt_rand($min=2, $max=4);
        for( $top=$initY; $top < $cHeight ; $top+=$space )
        {
            if( $top < $cHeight ) ImageLine($bgCanvas, 0, $top, $cWidth, $top, $color['line']);
        }

        // 문자 그리기
        /// String Draw
        for( $i=0; $i < count($sString); $i++ )
        {
            $stringFont = $useFontPath . "/".$useFont[mt_rand(0, 3)];
            $stringAngle = mt_rand($min=-8, $max=8);
            ImageTTFText($bgCanvas, $fontSize, $stringAngle , ImageFontWidth($fontSize) * ($i * 3)+20, $cHeight - $fontSize,$color['grey'],$stringFont,$sString[$i]);
        }
header("Content-type: image/jpeg");
imagejpeg($bgCanvas);
imagedestroy($bgCanvas);
?>