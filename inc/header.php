<? include "head.php";?>
<body style="background:url(../img/common/sub-bg.gif) left top repeat-x;">
	<header>
		<div class="top">
			<a href="../"><img src="../img/common/logo.png" class="logo" alt="bluwash"/></a>
			<nav id="gnb">
				<div class="top_gnb">
					<ul>
						<li><a href="../bidet/digital-bidet-BW103R.html" class="menu gnb1<?=($curDirectory == "bidet" ? "on" : "")?>" title="Bidet" >Bidet</a></li>
						<li><a href="../hand-dryer/introduction.html" class="menu gnb2<?=($curDirectory == "hand-dryer" ? "on" : "")?>" title="Hand Dryer">Hand Dryer</a></li>
						<li><a href="../shower-head/collagen-shower-head.html" class="menu gnb3<?=($curDirectory == "shower-head" ? "on" : "")?>" title="Shower Head">Shower Head</a></li>
						<li><a href="../company/greetings.html" class="menu gnb4<?=($curDirectory == "company" ? "on" : "")?>" title="Company">Company</a></li>
						<li><a href="../contact-us/contact-us.html" class="menu gnb5<?=($curDirectory == "contact-us" ? "on" : "")?>" title="Contact us">Contact us</a></li>
					</ul>
				</div><!--E:top_gnb-->
			</nav>
		</div><!--E:top-->
	</header>
	<section>
	<div id="wrap" class="sub_wrap">
		<div class="lnb">
			<p><?=$GlobalNavigation?></p>
			<ul>
				<? include "leftMenu.php";?>
				<!--li class="lnb-on"><a href="#" title="Digital Bidet">Digital Bidet</a></li>
				<li><a href="#" title="Non-Electric Bidet">Non-Electric Bidet</a></li>
				<li><a href="#" title="Smart Bidet">Smart Bidet</a></li>
				<li><a href="#" title="Portable Bidet">Portable Bidet</a></li-->
			</ul>
			<div class="collection_Catalogue">
				<a href="../menual/BLUWASHCOLLECTIONS_Catalogue.pdf" title="BLUWASH COLLECTION Download" target="_blank"><img src="../img/common/collection_Catalogue_btn.png" alt="BLUWASH COLLECTION Download"></a>
			</div>
		</div><!--E:lnb-->
		<div class="contents_wrap">
			<div class="sub_title">
				<h1><?=($GlobalNavigation2 ? $GlobalNavigation2 : $GlobalNavigation)?></h1>
					<?
					if($GlobalNavigation3) {
						$GlobalNavi = "<a href=\"$GlobalNaviUrl\" title=\"$GlobalNavigation\">$GlobalNavigation</a> &gt; <a href=\"$GlobalNaviUrl2\" title=\"$GlobalNavigation2\">$GlobalNavigation2</a> &gt; <span class=\"current\">$GlobalNavigation3</span>";
					}else if($GlobalNavigation2) {
						$GlobalNavi = "<a href=\"$GlobalNaviUrl\" title=\"$GlobalNavigation\">$GlobalNavigation</a> &gt; <span class=\"current\">$GlobalNavigation2</span>";
					} else {
						$GlobalNavi = "<span class=\"current\">$GlobalNavigation</span>";
					}
					?>
				<nav class="brad"><a href="../" class="go-home">Home</a> > <?=$GlobalNavi?></nav>
			</div>
			<div class="substance">