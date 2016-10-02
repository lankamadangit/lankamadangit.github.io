
function onlyNumberInput2( Ev ) {
	if (window.event) // IE코드
		var code = window.event.keyCode;
	else // 타브라우저
		var code = Ev.which;

	if ((code > 34 && code < 41) || (code > 47 && code < 58) || (code > 95 && code < 106) || code == 8 || code == 9 || code == 13 || code == 46) {
		window.event.returnValue = true;
		return;
	}

	if (window.event)
		window.event.returnValue = false;
	else
		Ev.preventDefault();    
}

/* 이메일 유효성 체크1 */
function checkEmail(email) {
	
	var a = email.indexOf("@");

	email_account = email.substring(0,a);
	email_domain = email.substring(a+1);

	if(!checkEmailAccount(email_account))
	{
		return false;
	}
	if(!checkEmailDomain(email_domain))
	{
		return false;
	}

	return true;

}

/* 이메일 유효성 체크2 */
function checkEmailAccount(email) {

	var comp="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-.";
	var t = email;
	var ValidFlag = false
	var atCount = 0
	var SpecialFlag
	var atLoop
	var atChr
	var BadFlag
	var len = t.length;

	if ( t.length > 0 ) {
		atCount = 0
		SpecialFlag = false

		for( atLoop=1; atLoop<=t.length; atLoop++ ) {

			if(comp.indexOf(t.substring(atLoop,atLoop+1))<0)
			{
				return false;
				break;
			}
			atChr = t.substring( atLoop, atLoop+1 )

			if ( (atChr >= 32) && (atChr <= 44) ) SpecialFlag = true 
			if ( (atChr == 47) || (atChr == 96) || (atChr >= 123) ) SpecialFlag = true 
			if ( (atChr >= 58) && (atChr <= 63) ) SpecialFlag = true 
			if ( (atChr >= 91) && (atChr <= 94) ) SpecialFlag = true 
		}

		if ( SpecialFlag == false ) {
			BadFlag = false
			ValidFlag = true
		}

	}
	
	if ( BadFlag == true ) ValidFlag = false

	return ValidFlag
}

/* 이메일 유효성 체크3 */
function checkEmailDomain(email) {

	var comp="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-.";
	var t = email;
	var ValidFlag = false
	var atCount = 0
	var SpecialFlag
	var atLoop
	var atChr
	var BadFlag = true
	var len = t.length;
	
	if ( t.length > 0 && t.indexOf(".") > 0 ) {
		atCount = 0
		SpecialFlag = false

		for( atLoop=1; atLoop<=t.length; atLoop++ ) {

			if(comp.indexOf(t.substring(atLoop,atLoop+1))<0)
			{
				return false;
				break;
			}
			atChr = t.substring( atLoop, atLoop+1 )
			if ( atChr == "." ) atCount = atCount + 1

			if ( (atChr >= 32) && (atChr <= 44) ) SpecialFlag = true 
			if ( (atChr == 47) || (atChr == 96) || (atChr >= 123) ) SpecialFlag = true 
			if ( (atChr >= 58) && (atChr <= 63) ) SpecialFlag = true 
			if ( (atChr >= 91) && (atChr <= 94) ) SpecialFlag = true 
		}

		if ( ( atCount > 0 ) && (SpecialFlag == false ) ) {


			BadFlag = false

			if ( t.substring( 1, 2 ) == "." ) BadFlag = true
			if ( t.substring( t.length-1, t.length) == "." ) BadFlag = true
			ValidFlag = true
		}
	}
	if ( BadFlag == true ) ValidFlag = false

	return ValidFlag
}

function FormCheck(){
	if(!document.UserInfo.check1.checked) {
		alert("Collecting personal information must agree to the estimate will be contact.");
		document.UserInfo.check1.focus();
		return false;
	}	
	if(!document.UserInfo.Subject.value) { 
		alert("Please enter the Subject."); 
		document.UserInfo.Subject.focus(); 
		return false; 
	}
	if(!document.UserInfo.Name.value) { 
		alert("Please enter the name."); 
		document.UserInfo.Name.focus(); 
		return false; 
	}
	if(!document.UserInfo.Email.value) {
		alert("Please enter the e-mail.");
		document.UserInfo.Email.focus();
		return	false;
	} else if (!checkEmail(document.UserInfo.Email.value)) {
		alert("Please enter Email address to suit the type.");
		document.UserInfo.Email.value = "";
		document.UserInfo.Email.focus();
		return false;
	}
	if(!document.UserInfo.Phone.value) { 
		alert("Please enter the telephone number."); 
		document.UserInfo.Phone.focus(); 
		return false; 
	}
	if(!document.UserInfo.Company.value) { 
		alert("Please enter the company."); 
		document.UserInfo.Company.focus(); 
		return false; 
	}
	if(!document.UserInfo.Country.value) { 
		alert("Please enter the country."); 
		document.UserInfo.Country.focus(); 
		return false; 
	}
	if(!document.UserInfo.Comment.value) { 
		alert("Please enter the Message."); 
		document.UserInfo.Comment.focus(); 
		return false; 
	}
	if(document.UserInfo.sFullString.value != document.UserInfo.autoJoin.value) {
		alert("Security code does not match.");
		document.UserInfo.autoJoin.value = "";
		document.UserInfo.autoJoin.focus();
		return false;
	}
	return true;
}
