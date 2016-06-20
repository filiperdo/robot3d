$(document).ready(function(){
	
	var URL = 'http://localhost/robot3d/';
	
	$('.bt-sub-form').click(function(){
		
		var id = $(this).attr('id');
		
		$( "#result-"+id ).css('display','');
		
		$.post( URL + "comment/create", { content: $('#content-'+id).val(), comment_type: $('#comment_type-'+id).val(), id_item: id }, function( data ) {
			
			$( data ).insertAfter( "#result-"+id );
			$('#content-'+id).val('');
			$( "#result-"+id ).css('display','none');
			
		});
		
	});
	
});