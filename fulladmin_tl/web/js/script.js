$('#changeLang').on('click', function(){ // on change of state
	if(this.checked){
		$("#lang").prop("disabled", false);
	} else {
		$("#lang").prop("disabled", true);
	}
});

$('#changeDateCreated').on('click', function(){ // on change of state
	if(this.checked){
		$("#dateCreated").prop("disabled", false);
	} else {
		$("#dateCreated").prop("disabled", true);
	}
});

$('#changeDateUpdated').on('click', function(){ // on change of state
	if(this.checked){
		$("#dateUpdated").prop("disabled", false);
	} else {
		$("#dateUpdated").prop("disabled", true);
	}
});

/*
$('#fieldID4').on('change', function(){
	$('#dCover img').attr('src', $('#fieldID4').text());
});

function changeCover(){
	//alert($('#fieldID4').val());
	$('#dCover img').attr('src', $('#fieldID4').val());
}
*/


function responsive_filemanager_callback(field_id){
	//console.log(field_id);
	var url=jQuery('#'+field_id).val();
	//alert('update '+field_id+" with "+url);
	//alert(url);
	//$('#dCover img').attr('src', url);
	//$('#btnModal2').click();	
	$('#dCover-' + field_id + ' img').attr('src', url);
	$('#btn'+field_id).click();
}
