//자바함수 라이브러리에 추가했으면 하는 함수덜..
function lpad(str,fill,leng)
{
    var n = leng - str.length;
    var out ="";
    for (i =0; i < n; i++)  out = out + fill;
    out=out+str;
    return out;
}
//parseInt에서는 '08'을 8진수로 인식해서 0이나 NaN을 돌려준다
function toInt(str)
{
    i=0;
    while(1)
    {
        if(str.substr(0,1)=='0') {str=str.substr(1,str.length)};
        else break;
        i++;
    }
    return parseInt(str);
}

//정훈이(sizers)와 함께 달력소스 후루꾸로 뱃기기.. ㅋㅋ


//기념일에 해당하는 배열 전역변수(이는 서버사이드에서 동적으로 생성시켜줘야함);
//알아서 적용시킬것...
//var anniversary = new Array(3,7,9,23,25);

function show_cal(selectDate,calDivObj,flag) //selectDate이슈가 되는 날짜, calDivObj달력을 뿌릴 DIV태그 아이디
{
    //전역변수들 세팅
    var selectDate = ''+selectDate; //전역변수1 - 이슈가 되는 날짜 지정
    today = new Date();
    toDate = today.getYear() + lpad(''+(today.getMonth()+1),'0',2) + lpad(''+today.getDate(),'0',2); // 오늘날짜 지정
	toDate_m = lpad(''+(today.getMonth()+1),'0',2);
	toDate_d = lpad(''+today.getDate(),'0',2);
    //alert(toDate);
    if (selectDate == '')
    {
        selectDate=toDate;
    }

    var preMonDate;
    var nextMonDate;
    preMonDate= selectDate.substr(0,4)+lpad(''+(toInt(selectDate.substr(4,2))-1),'0',2)+selectDate.substr(6,2);
    nextMonDate= selectDate.substr(0,4)+lpad(''+(toInt(selectDate.substr(4,2))+1),'0',2)+selectDate.substr(6,2);
    //alert(selectDate+":"+ preMonDate +":"+ nextMonDate);
    if(selectDate.substr(4,2)=='01') preMonDate= (toInt(selectDate.substr(0,4))-1) + '12' + selectDate.substr(6,2);
    if(selectDate.substr(4,2)=='12') nextMonDate= (toInt(selectDate.substr(0,4))+1) + '01' + selectDate.substr(6,2);

    //alert(selectDate+":"+ preMonDate +":"+ nextMonDate);

    var firstDay = getFirstDay(selectDate.substr(0,4), selectDate.substr(4,2));            // 첫번째 요일의 숫자값        
    var lastDay = getLastDay(selectDate.substr(0,4), selectDate.substr(4,2));            // 마지막 요일의 숫자값
    var daysOfMonth = getDaysOfMonth(selectDate.substr(0,4), selectDate.substr(4,2));    // 28, 29, 30, 31 중 하나
    //alert(firstDay+":"+ lastDay +":"+ daysOfMonth);
    var calString;//달력 HTML을 저장하기 위한 변수다.
    calString="<table bgcolor=#DCDCDC border='0' cellspacing='1' cellpadding='2' width='150'>";

    calString+="<tr style='color=#0000C6'><td colspan='7' align=center>";
    calString+="<a href=\"javascript:show_cal('"+ (parseInt(selectDate.substr(0,4))-1)+ selectDate.substr(4,4) +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>◀◀</font></a> ";
    calString+="<a href=\"javascript:show_cal('"+ preMonDate +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>◀</font></a> ";
    calString+="<font color='#990000'><b>"+selectDate.substr(0,4)+" "+selectDate.substr(4,2)+"</b></font> ";
    calString+="<a href=\"javascript:show_cal('"+ nextMonDate +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>▶</font></a> ";
    calString+="<a href=\"javascript:show_cal('"+ (parseInt(selectDate.substr(0,4))+1)+ selectDate.substr(4,4) +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>▶▶</font></a>";
    calString+="</td></tr>";
    calString+="<tr height=19 bgcolor=#8DCFF4>";
    calString+="<td width='19' align=center>일</td>";
    calString+="<td width='19' align=center>월</td>";
    calString+="<td width='19' align=center>화</td>";
    calString+="<td width='19' align=center>수</td>";
    calString+="<td width='19' align=center>목</td>";
    calString+="<td width='19' align=center>금</td>";
    calString+="<td width='19' align=center>토</td>";
    calString+="</tr>";
    
    // 달력 textfield 출력
    for (var i=0; i < Math.ceil( (firstDay+daysOfMonth)/7 ); i++) {
        calString+="<tr valign='middle' height='19' bgcolor='#F6F9F3'>";
        for (var j=1; j <= 7; j++) {         
            colNum=i*7+j; //달력의 각 칸의 칼럼을 번호로 지정
            
            if (colNum>firstDay && colNum<firstDay+daysOfMonth+1) //달력에 날짜가 나와야 되는 조건
            {
                thisDay=colNum-firstDay; //이날의 날짜(숫자)

				 if ((thisDay==1)||(thisDay==2)||(thisDay==3)||(thisDay==4)||(thisDay==5)||(thisDay==6)||(thisDay==7)||(thisDay==8)||(thisDay==9)) {
					 newDay="0"+thisDay;
				 }
				 else {newDay=thisDay;}
                
                //요일의 색깔을 결정하자 ㅋㅋ
                if(colNum%7==1) {tdColor="C60000";}
                else if(colNum%7==0) {tdColor="0000C6";}
                else {tdColor="333333";}

				if((toDate_m==selectDate.substr(4,2))&&(toDate_d==thisDay)) {tdBgColor="facd8a";}
				else {tdBgColor="F6F9F3";}

                
                //기념일일 경우에 링크를 걸어주자..  ㅋㅋ 스타일을 않걸었더니 색깔이 파란색으로@@;; 스타일도 알아서..
                /*
                                for(k=0;k<anniversary.length;k++)
                {
                    if(thisDay==anniversary[k])
                    {
                        thisDay="<a href='http://어디로 갈까.. ㅠ.ㅠ;;'><b>"+thisDay+"</b></a>";
                        break;
                    }
                }
                                */
                                /*
                                년도 : selectDate.substr(0,4)
                                달 : selectDate.substr(4,2)
                                날짜 : thisDay
                                */
                                //calString+="<td align=center><a href=\"javascript:insert('"+selectDate.substr(0,4)+"','"+selectDate.substr(4,2)+"','"+newDay+"','"+flag+"')\">"+thisDay+"</a></td>";
								calString+="<td align='right' onclick=\"javascript:insert('"+selectDate.substr(0,4)+"-"+selectDate.substr(4,2)+"-"+newDay+"','"+flag+"')\" onMouseOver=this.style.background='#facd8a'; onMouseOut=this.style.background='#F6F9F3'; style='CURSOR: hand' bgcolor=#"+tdBgColor+">"+"<font color=#"+tdColor+">"+thisDay+"</font></td>";
            }
            else
            {
                calString+="<td></td>";
            }
            //calString+="<td>"+colNum+"</td>";
        }
        calString+="</tr>";
    }
    calString+="</table>";

    //저장된 스트링변수를 DIV레이어에 올리자.. 
    calDivObj.innerHTML=calString;
}

/////////////////////////날짜 관련된 연산 함수들////////////////////////////
function getDaysOfMonth(year, month) { 
    var DOMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];        // Non-Leap year Month days.. 
    var lDOMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];    // Leap year Month days.. 
    /* 
    Check for leap year .. 
    1.Years evenly divisible by four are normally leap years, except for... 
    2.Years also evenly divisible by 100 are not leap years, except for... 
    3.Years also evenly divisible by 400 are leap years. 
    */ 
    if ((year % 4) == 0) {
        if ((year % 100) == 0 && (year % 400) != 0)
            return DOMonth[toInt(month)-1];
     
        return lDOMonth[toInt(month)-1];
    } else 
        return DOMonth[toInt(month)-1];
} 

// 첫번째 요일 구하기
function getFirstDay(year, month) {
    var tmpDate = new Date(); 
    tmpDate.setDate(1); 
    tmpDate.setMonth(toInt(month)-1); 
    tmpDate.setFullYear(year); 
    return tmpDate.getDay(); 
}

// 마지막 요일 구하기
function getLastDay(year, month) {
    var tmpDate = new Date(); 
    tmpDate.setDate( getDaysOfMonth(year,month) ); 
    tmpDate.setMonth(toInt(month)-1); 
    tmpDate.setFullYear(year); 
    return tmpDate.getDay(); 
}
/////////////////////////날짜 관련된 연산 함수들////////////////////////////