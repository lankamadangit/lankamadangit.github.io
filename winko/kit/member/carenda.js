//�ڹ��Լ� ���̺귯���� �߰������� �ϴ� �Լ���..
function lpad(str,fill,leng)
{
    var n = leng - str.length;
    var out ="";
    for (i =0; i < n; i++)  out = out + fill;
    out=out+str;
    return out;
}
//parseInt������ '08'�� 8������ �ν��ؼ� 0�̳� NaN�� �����ش�
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

//������(sizers)�� �Բ� �޷¼ҽ� �ķ�ٷ� ����.. ����


//����Ͽ� �ش��ϴ� �迭 ��������(�̴� �������̵忡�� �������� �������������);
//�˾Ƽ� �����ų��...
//var anniversary = new Array(3,7,9,23,25);

function show_cal(selectDate,calDivObj,flag) //selectDate�̽��� �Ǵ� ��¥, calDivObj�޷��� �Ѹ� DIV�±� ���̵�
{
    //���������� ����
    var selectDate = ''+selectDate; //��������1 - �̽��� �Ǵ� ��¥ ����
    today = new Date();
    toDate = today.getYear() + lpad(''+(today.getMonth()+1),'0',2) + lpad(''+today.getDate(),'0',2); // ���ó�¥ ����
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

    var firstDay = getFirstDay(selectDate.substr(0,4), selectDate.substr(4,2));            // ù��° ������ ���ڰ�        
    var lastDay = getLastDay(selectDate.substr(0,4), selectDate.substr(4,2));            // ������ ������ ���ڰ�
    var daysOfMonth = getDaysOfMonth(selectDate.substr(0,4), selectDate.substr(4,2));    // 28, 29, 30, 31 �� �ϳ�
    //alert(firstDay+":"+ lastDay +":"+ daysOfMonth);
    var calString;//�޷� HTML�� �����ϱ� ���� ������.
    calString="<table bgcolor=#DCDCDC border='0' cellspacing='1' cellpadding='2' width='150'>";

    calString+="<tr style='color=#0000C6'><td colspan='7' align=center>";
    calString+="<a href=\"javascript:show_cal('"+ (parseInt(selectDate.substr(0,4))-1)+ selectDate.substr(4,4) +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>����</font></a> ";
    calString+="<a href=\"javascript:show_cal('"+ preMonDate +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>��</font></a> ";
    calString+="<font color='#990000'><b>"+selectDate.substr(0,4)+" "+selectDate.substr(4,2)+"</b></font> ";
    calString+="<a href=\"javascript:show_cal('"+ nextMonDate +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>��</font></a> ";
    calString+="<a href=\"javascript:show_cal('"+ (parseInt(selectDate.substr(0,4))+1)+ selectDate.substr(4,4) +"',"+ calDivObj.id +",'"+ flag +"');\"><font color=#006699>����</font></a>";
    calString+="</td></tr>";
    calString+="<tr height=19 bgcolor=#8DCFF4>";
    calString+="<td width='19' align=center>��</td>";
    calString+="<td width='19' align=center>��</td>";
    calString+="<td width='19' align=center>ȭ</td>";
    calString+="<td width='19' align=center>��</td>";
    calString+="<td width='19' align=center>��</td>";
    calString+="<td width='19' align=center>��</td>";
    calString+="<td width='19' align=center>��</td>";
    calString+="</tr>";
    
    // �޷� textfield ���
    for (var i=0; i < Math.ceil( (firstDay+daysOfMonth)/7 ); i++) {
        calString+="<tr valign='middle' height='19' bgcolor='#F6F9F3'>";
        for (var j=1; j <= 7; j++) {         
            colNum=i*7+j; //�޷��� �� ĭ�� Į���� ��ȣ�� ����
            
            if (colNum>firstDay && colNum<firstDay+daysOfMonth+1) //�޷¿� ��¥�� ���;� �Ǵ� ����
            {
                thisDay=colNum-firstDay; //�̳��� ��¥(����)

				 if ((thisDay==1)||(thisDay==2)||(thisDay==3)||(thisDay==4)||(thisDay==5)||(thisDay==6)||(thisDay==7)||(thisDay==8)||(thisDay==9)) {
					 newDay="0"+thisDay;
				 }
				 else {newDay=thisDay;}
                
                //������ ������ �������� ����
                if(colNum%7==1) {tdColor="C60000";}
                else if(colNum%7==0) {tdColor="0000C6";}
                else {tdColor="333333";}

				if((toDate_m==selectDate.substr(4,2))&&(toDate_d==thisDay)) {tdBgColor="facd8a";}
				else {tdBgColor="F6F9F3";}

                
                //������� ��쿡 ��ũ�� �ɾ�����..  ���� ��Ÿ���� �ʰɾ����� ������ �Ķ�������@@;; ��Ÿ�ϵ� �˾Ƽ�..
                /*
                                for(k=0;k<anniversary.length;k++)
                {
                    if(thisDay==anniversary[k])
                    {
                        thisDay="<a href='http://���� ����.. ��.��;;'><b>"+thisDay+"</b></a>";
                        break;
                    }
                }
                                */
                                /*
                                �⵵ : selectDate.substr(0,4)
                                �� : selectDate.substr(4,2)
                                ��¥ : thisDay
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

    //����� ��Ʈ�������� DIV���̾ �ø���.. 
    calDivObj.innerHTML=calString;
}

/////////////////////////��¥ ���õ� ���� �Լ���////////////////////////////
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

// ù��° ���� ���ϱ�
function getFirstDay(year, month) {
    var tmpDate = new Date(); 
    tmpDate.setDate(1); 
    tmpDate.setMonth(toInt(month)-1); 
    tmpDate.setFullYear(year); 
    return tmpDate.getDay(); 
}

// ������ ���� ���ϱ�
function getLastDay(year, month) {
    var tmpDate = new Date(); 
    tmpDate.setDate( getDaysOfMonth(year,month) ); 
    tmpDate.setMonth(toInt(month)-1); 
    tmpDate.setFullYear(year); 
    return tmpDate.getDay(); 
}
/////////////////////////��¥ ���õ� ���� �Լ���////////////////////////////