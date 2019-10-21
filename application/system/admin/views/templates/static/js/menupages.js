$(function(){
	$('#nav a').bind('click',function(event){
		$('#nav li').removeClass('active');
		$(this).parents('li').addClass('active');
	});
});