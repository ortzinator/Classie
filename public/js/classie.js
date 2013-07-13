$(document).ready(function(){
    $("input.focus").focus();

    $("textarea.autoexpand").focus(function() {
  		$(this).animate({width:"500px", height:"100px"},400);
	});

	if ($("textarea.autoexpand").val() != '') {
		$("textarea.autoexpand").css({width:"500px", height:"100px"});
	};

	$('.markitup').markItUp(myMarkdownSettings);

	$('input[type="submit"].disabled').attr('disabled','disabled');
	$('textarea.disabled').attr('disabled','disabled');
});