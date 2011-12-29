$(document).ready(function(){
	//ckfinder初始化ckediter
    
    $("textarea[fmt='fck']").each(function(i){
    	CKFinder.SetupCKEditor( null, '/yiicms/ckfinder/' );
        var myname = this.name;
        CKEDITOR.replace(myname,
        {
        width : '750px',
    	});
     });
     


    $("#browseServer").bind("click", function(){
    var finder = new CKFinder('/yiicms/ckfinder/');
    finder.SelectFunction = SetFileField;    
        finder.Popup();
	});



});

function SetFileField(fileUrl) {
	$('#xFilePath').val(fileUrl);
}

function captcha_click() {$("#captcha").click(
      function () {
        $(this).attr("src",$(this).attr("src") + "/");

      }
    );
}
