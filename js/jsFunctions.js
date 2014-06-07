$(document).ready(function(){

	var previousStyle = "";
	var toggled = "";
	var currentImg = ""; // fwdImg id
	
	$(document).on('click', '.item', function resizeImg(e){
	
		toggled = $(this).attr("data-toggled");
		if(toggled == "off"){
			var windowW = $(window).width();
			var windowH = $(window).height();
			var itemW = $(this).width();
			var itemH = $(this).height();
			
			var windowRatio = windowW / windowH;
			var itemRatio = itemW / itemH;
						
			previousStyle = $(this).css(["position", "height", "width", "top", "left", "margin-left", "zIndex"]);
			
			// If gif is vertical
			if(windowRatio > itemRatio){
				$(this).removeClass("opacity");
			
				var offset = (windowH / itemH)
				var ww = String(Math.round(itemW * offset));
				var hh = String(windowH);
				
				var centerW = Math.round(ww / 2);
				centerW = String(centerW);

				$(this).css({position: "fixed", top: "0", left: "50%", width: ww, height: hh, zIndex: "1000"});
				$(this).css("margin-left", -centerW);
				$(this).attr("data-toggled", "on");
				darkenBack();
				returnImgToBack();
				console.log("1");
				currentImg = $(this).attr("data-gfyid");
				return;
			}
			
			// If gif is horizontal
			else if(windowRatio <= itemRatio){
				$(this).removeClass("opacity");

				var wRatio  = windowW / itemW;
				var tp = Math.round((itemH * wRatio)/2);

				$(this).css({position: "fixed", top: "50%", left: "0", width: "100%", height: "auto", zIndex: "1000"});
				//$(this).css({position: "fixed", top: "45", left: "0", width: "100%", height: "auto", zIndex: "1000"});
				$(this).css("margin-top", -tp);
				$(this).attr("data-toggled", "on");
				darkenBack();
				returnImgToBack();
				currentImg = $(this).attr("data-gfyid");
				return;
			}
		}
	});
	// Close fwdImg
	$(document).on('click', '[class="item"]', function(e){
		returnImgToBack();
	});
	
	function returnImgToBack(){
		var fwdImg = $("[data-gfyid='"+currentImg+"']");
		
		// If current img is fwd
		if(fwdImg.attr("data-toggled") == "on"){
			fwdImg.addClass("opacity");
			fwdImg.css(previousStyle);
			fwdImg.css({marginLeft: 0, width: "100%", height: "auto", marginTop: "auto"});
			
			fwdImg.attr("data-toggled", "off");
			
			// change back opacity of background only if there isn't any in the foreground
			var numOfImgOpen = $("[data-toggled='on']").length;
			if(numOfImgOpen == 0 ) $(".item.opacity").css("opacity", "1");
			
			currentImg = ""; // reset current img id
		}
	}
	
	function darkenBack(){
		$(event.target).parent().css({opacity: 1});
		$(".item.opacity").animate({opacity: 0.2}, 300);
	};
			
});