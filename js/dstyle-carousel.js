function dstyleCarousel(objDiv,h){
	jQuery(function(){
		// object setting
		var obj = {
				id:objDiv.get(0).id,
				div:objDiv,
				ul:objDiv.find("ul"),
				li:objDiv.find("ul li"),
				first:objDiv.find("ul > li")
			};
		obj.li.css({"float":"left"});
		
		// clone object setting
		var cbj = {id:"carouselClone"+obj.id};
		obj.div.append("<ul id='"+cbj.id+"' style='display:none;'></ul>");
		var cc = jQuery("#"+cbj.id);
		obj.li.clone().appendTo(cc);
		jQuery.extend(cbj,{ul:cc,li:cc.find("li")});
		cc=null;
		
		//default value setting
		var val = {
				length:obj.li.length,
				speed:500,
				viewitem:1,
				moveitem:1,
				itemWidth:(obj.first.outerWidth(true)),
				itemHeight:(obj.first.outerHeight(true)),
				prevBtn:null,
				nextBtn:null,
				interval:true,
				intervalTime:3000,
				create:function(){}, //callback function
				prevClick:function(){},
				nextClick:function(){},
				moveStart:function(){},
				moveEnd:function(){},
				itemHover:function(){},
				href:null
			};
		jQuery.extend(val,h);
		var valAdd = {
				length:(val.href) ? val.href.length : val.length,
				idx:val.moveitem,
				use:true,
				viewWidth:(val.itemWidth*val.viewitem),
				ulWidth:(val.itemWidth*(val.viewitem*3)),
				ulLeft:((val.itemWidth*val.moveitem)*-1),
				count:0,
				intervalTime:(val.intervalTime/100),
				hover:false
		};
		jQuery.extend(val,valAdd);
		valAdd=h=null; // closer 
		
		
		// function setting
		var fn = {
				start:function(){
					fn.resetCase();
					fn.resetDOM();
					val.create.call(null,obj);
				},
				hrefStart:function(){
					fn.resetCase();
					cbj.ul.empty();
					jQuery(val.href).each(function(hrefNum,hrefUrl){
						var li = document.createElement("li");
						jQuery(li).css({"float":"left","margin":"0","padding":"0"});
						jQuery(li).load(hrefUrl,function(){
							cbj.ul.append(li);
							if((val.href.length-1)==hrefNum){
								jQuery.extend(cbj,{li:cbj.ul.find("li")});
								fn.resetDOM();
							};
						});
					});
				},
				prevIdx:function(num){
					return (((num%val.length)-(val.moveitem*2))+val.length)%val.length;
				},
				nextIdx:function(num){
					return num%val.length;
				},
				prevMove:function(){
					if(val.use){
						val.count = 0;
						val.use = false;
						val.moveStart.call(null,obj);
						obj.ul.animate({"left":"0"},val.speed,function(){
							fn.resetDOM("prev");
							val.use = true;
							val.moveEnd.call(null,obj);
						});
					};
				},
				nextMove:function(){
					if(val.use){
						val.count = 0;
						val.use = false;
						val.moveStart.call(null,obj);
						obj.ul.animate({"left":(val.ulLeft*2)+"px"},val.speed,function(){
							fn.resetDOM("next");
							val.use = true;
							val.moveEnd.call(null,obj);
						});
					};
				},
				resetDOM:function(type){
					type = (!type) ? "prev" : type ;
					var setArr = [];
					var n = val.idx;
					for(i=0;i<(val.viewitem*3);i++){
						setArr.push(fn[type+"Idx"](n+i));
					};
					val.idx = setArr[val.moveitem];
					obj.ul.empty();
					jQuery(setArr).each(function(n,nm){
						cbj.li.eq(nm).clone().appendTo(obj.ul);
					});
					
					obj.ul.css({"left":val.ulLeft+"px"});
					if(val.interval){
						obj.ul.find("li").mouseover(function(){
							val.count = 0;
							val.hover = true;
							val.itemHover.call(null,obj);
						});
						obj.ul.find("li").mouseout(function(){
							val.count = 0;
							val.hover = false;
						});
					};
					
				},
				resetCase:function(){
					obj.div.css({"position":"relative","width":val.viewWidth+"px","height":val.itemHeight+"px","overflow":"hidden"});
					obj.ul.css({"position":"absolute","top":"0","left":val.ulLeft+"px","width":val.ulWidth+"px","height":val.itemHeight+"px","overflow":"hidden"});
				},
				intervalMove:function(){
					setInterval(function(){
						if(val.count<val.intervalTime){
							val.count = val.count+1;
						}else{
							val.count = 0;
							if(!val.hover){
								fn.nextMove();
							};
						};
					},100);
				}
		}
		
		// carousel Start
		// ajax href use AJAX Call
		if(val.href){
			fn.hrefStart();
		}else{
			if(val.length<=val.viewitem){
				val.prevBtn.hide();
				val.nextBtn.hide();
				val.interval = false;
				
			}else{
				fn.start();
			};
		};
		
		// action
		if(val.prevBtn){
			var prevDOM = document.getElementById(val.prevBtn.get(0).id);
			prevDOM.onclick = function(){return false;};
			val.prevBtn.click(function(){
				val.prevClick.call(null,obj);
				fn.prevMove();
			});
		};
		if(val.nextBtn){
			var nextDOM = document.getElementById(val.nextBtn.get(0).id);
			nextDOM.onclick = function(){return false;};
			val.nextBtn.click(function(){
				val.nextClick.call(null,obj);
				fn.nextMove();
			});
		};
		
		if(val.interval){
			fn.intervalMove();
		};
		
	});
};

jQuery.extend(jQuery.dstyle,{carousel:dstyleCarousel})
jQuery.fn.carousel = function(h){
	dstyleCarousel(this,h);
};