$(document).ready(function(){
	
	if( window.location.hostname == 'localhost' )
	{
		var URL = 'http://localhost/vitrinekar/';
	}
	else
	{
		var URL = 'http://www.vitrinekar.com.br/';
	}

	$('#id_manufacturer').change(function(){
		//alert( $(this).val() );
		//$('#id_modelo').load('http://localhost/vitrinekar/car/listModelByManufacturer/' + $(this).val());
		$('#id_modelo').load(URL + 'car/listModelByManufacturer/' + $(this).val());
	});
	
});