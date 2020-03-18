function initialize() {
	var latlng = new google.maps.LatLng(-33.3968508,-70.5975625);
	var settings = {
		zoom: 15,
		center: latlng,
		scrollwheel: false,
		mapTypeControl: true,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
		navigationControl: true,
		navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
		mapTypeId: google.maps.MapTypeId.ROADMAP};
	var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
	var contentString = '<div id="content">'+
		'<div id="bodyContent">'+
		'<p><strong>CERCAL</strong></p><p>AV. NUEVA COSTANERA Nº4011, ESQUINA ESPOZ, VITACURA.</p>'+
		'</div>'+
		'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});
	
		var companyMarker = new google.maps.Marker({
		position: latlng,
		map: map,
		icon: 'assets/img/icon-contactos.png',
		title:"Cercal",
		zIndex: 3});

google.maps.event.addListener(companyMarker, 'click', function() {
		infowindow.open(map,companyMarker);
	});
}