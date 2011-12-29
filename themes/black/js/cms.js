 $(function (){
 	picAuto(4000);
	var t = setInterval('AutoScroll("#scrollDiv")',1500);

	$('#scrollDiv').hover(
	  function () {
		clearInterval(t);
	  },
	  function () {
		t = setInterval('AutoScroll("#scrollDiv")',1500);
	  }
	);
	var screenHeight = window.screen.availHeight;
	var showheight = $("#sidebar").width();
	alert(windowsWidth);
});

//首页轮播图片
function picAuto(_AutoTime) {
    var t = n = 0; count = $("#play_list a").size();
	$("#play_list a:not(:first-child)").hide();
	$("#play_text li:first-child").addClass("selected");
	$("#play_text li").click(function() {
		var i = $(this).text() - 1;
		n = i;
		if (i >= count) return;
		$("#play_list a").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);
		$(this).addClass("selected").siblings().removeClass("selected");
	});
	t = setInterval("showAuto()", _AutoTime);
	$("#pic").hover(function(){clearInterval(t)}, function(){t = setInterval("showAuto()", _AutoTime);});
    //移动到图片上后不自动跳转图片
}
function showAuto() {
	n = n >= (count - 1) ? 0 : ++n;
	$("#play_text li").eq(n).trigger('click');
}

function AutoScroll(obj){
    var myheight = $('.new_prod_box').height();
    $(obj).find("ul:first").animate({
        marginTop:'-'+myheight
        },500,function(){
        $(this).css({marginTop:"0px"}).find("li:first").appendTo(this);
        }
    );
}
