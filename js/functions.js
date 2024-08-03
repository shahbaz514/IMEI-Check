$(function() {
	$( "#sortable-rows" ).sortable({
		placeholder: "ui-state-highlight",
		update: function( event, ui ) {
			updateDisplayOrder();
		}
	});
});
  
// function to save display sort order  
function updateDisplayOrder() {
	var selectedLanguage = new Array();
	$('ul#sortable-rows li').each(function() {
		selectedLanguage.push($(this).attr("id"));		
	});	
	var dataString = 'sort_order='+selectedLanguage;
	$.ajax({
	  type: "GET",
	  url: "update_order.php",
	  data: dataString,
	  cache: false,	  
	  success: function(data){		  
	  }
	});
}