$(function(){
$(".shuxing").change(function(){
	var value = $(this).val();
	$(this).parent().parent().next().children(".controls.about").load("index.php?g=Admin&m=Goods&a=shuxing&value="+value);
});
$(".deleteOne").click(function(){
	$(this).parent().parent().parent().next().hide();
	$(this).parent().parent().parent().hide();
	
})
		
})