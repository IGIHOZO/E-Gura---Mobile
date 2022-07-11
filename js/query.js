$('.view').click(function(){
	$('.categoryList,.categoryLine').toggleClass('grid');
	$(this).toggleClass('active');
})
$(window).scroll(function(){
	if($(this).scrollTop()>400){
		$('.cat.item').addClass('fixed');
	}else{
		$('.cat.item').removeClass('fixed');
	}
})
$('.toggle').click(function(){
	$('.toggleContent').toggleClass('active');
})
$('.container').click(function(){
	$('.toggleContent').removeClass('active');
})
$('.account label').click(function(){
	$('.account label').removeClass('active');
	$(this).addClass('active');
})
$('.searchbtn').click(function(){
	$('.headdata').hide();
	$('.search.pane').show();
})
$('.search span').click(function(){
	$('.search.pane').hide();
	$('.headdata').show();
})
$('.thumb.sub img').click(function(){
	$('.thumb.nail img').attr('src',$(this).attr('src'));
})

$('.categoryIcons').slick({
  slidesToShow: 5,
  slidesToScroll: 4,
  autoplay: true,
  autoplaySpeed: 2000,
});
$('.categoryIcons button').remove();