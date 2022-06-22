function initMap(){
	$('.map-img-a').hover(function() {
		$('.map-img-secondary-' + $(this).attr('data-map')).stop().fadeIn('fast');
	}, function() {
		$('.map-img-secondary-' + $(this).attr('data-map')).stop().fadeOut('fast');
	});
};

initMap();
