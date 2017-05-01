$(function(){
$(".shuxing").change(function(){
	var value = $(this).val();
	$(this).parent().parent().next().children(".controls.about").load("index.php?g=Admin&m=Goods&a=shuxing&value="+value);
});
$(".deleteOne").click(function(){
	$(this).parent().parent().parent().next().remove();
	$(this).parent().parent().parent().remove();
	
})
		
})
$(function(){
	$(".promotion-sku li").click(function(){
		$(this).addClass("active").siblings("li").removeClass("active");
		})
	})