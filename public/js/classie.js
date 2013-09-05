$(document).ready(function(){
    $("input.focus").focus();

    var textAuto = $("textarea.autoexpand");
    var textExpandSize = { width:"500px", height:"100px" };

    textAuto.focus(function() {
  		$(this).animate(textExpandSize, 400);
	});

	if (textAuto.val() != '') {
		textAuto.css(textExpandSize);
	};

	// $('.markitup').markItUp(myMarkdownSettings);

	$('input[type="submit"].disabled').attr('disabled', 'disabled');
	$('textarea.disabled').attr('disabled','disabled');
});