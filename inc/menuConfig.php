<?
$folderPieces = split("/", $_SERVER["PHP_SELF"]);
$curDirectory = $folderPieces[1];
$curFile = $folderPieces[2];

$GlobalNavigation = "";
$GlobalNaviUrl = "";
$GlobalNavigation2 = "";
$Lefton = "";

if($curDirectory == "bidet") {
	$GlobalNavigation = "bidet";
	$GlobalNaviUrl = "../bidet/digital-bidet-BW103R.html";

	if($curFile == "digital-bidet-BW103R.html" || $curFile == "digital-bidet-BW-103.html" || $curFile == "digital-bidet-BW-102.html" || $curFile == "digital-bidet-BW-101.html" || $curFile == "digital-bidet-BW-950.html" || $curFile == "digital-bidet-BW-930.html" || $curFile == "digital-bidet-BW-910.html") {
		$GlobalNavigation2 = "Digital Bidet";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "1";
	} else if($curFile == "non-electric-bidet-BW1100.html" || $curFile == "non-electric-bidet-BW1000.html") {
		$GlobalNavigation2 = "Non-Electric Bidet";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "2";
	} else if($curFile == "smart-bidet-SM100.html") {
		$GlobalNavigation2 = "Smart Bidet";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "3";
	} else if($curFile == "portable-bidet.html") {
		$GlobalNavigation2 = "Portable Bidet";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "4";
	}

} else if($curDirectory == "hand-dryer") {
	$GlobalNavigation = "hand dryer";
	$GlobalNaviUrl = "../hand-dryer/introduction.html";

	if($curFile == "introduction.html") {
		$GlobalNavigation2 = "Introduction";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "1";
	} else if($curFile == "application.html") {
		$GlobalNavigation2 = "Application";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "2";
	}

} else if($curDirectory == "shower-head") {
	$GlobalNavigation = "shower head";
	$GlobalNaviUrl = "../shower-head/collagen-shower-head.html";

	if($curFile == "collagen-shower-head.html") {
		$GlobalNavigation2 = "Collagen Shower Head";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "1";
	} else if($curFile == "eco-shower-head.html") {
		$GlobalNavigation2 = "Eco Shower Head";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "2";
	}

} else if($curDirectory == "company") {
	$GlobalNavigation = "company";
	$GlobalNaviUrl = "../company/greetings.html";

	if($curFile == "greetings.html") {
		$GlobalNavigation2 = "Greetings";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "1";
	} else if($curFile == "history.html") {
		$GlobalNavigation2 = "History";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "2";
	} else if($curFile == "certificates.html") {
		$GlobalNavigation2 = "Certificates";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "3";
	} else if($curFile == "location.html") {
		$GlobalNavigation2 = "Location";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "4";
	}

} else if($curDirectory == "contact-us") {
	$GlobalNavigation = "contact us";
	$GlobalNaviUrl = "../contact/contact-us.html";

	if($curFile == "contact-us.html") {
		$GlobalNavigation2 = "";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "1";
	}
} else if($curDirectory == "privacy-policy") {
	$GlobalNavigation = "privacy policy";
	$GlobalNaviUrl = "../privacy-policy/index.html";

	if($curFile == "index.html") {
		$GlobalNavigation2 = "";
		$titleTxt = "";
		$keywordTxt = "";
		$descriptionTxt = "";
		$Lefton = "1";
	}
}

?>