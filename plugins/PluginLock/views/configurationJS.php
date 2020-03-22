$( document ).ready(function() {
    var $maincontent = $('#maincontent'),
		$configForm = $maincontent.find('#configForm'),
		$queriesInput = $configForm.find('input[name="queries"]');
		
	//prepare fields on start
	if ($queriesInput.val()){
		var vals = $queriesInput.val().split('||');
		
		$.each(vals, function( index, value ) {
			$configForm.find('.queries').append(queryRow(value));
		});
	}
		
	
	//delete click handler
	$configForm.on('click', 'button.delete', function(event){
		$(this).closest('.table-row').remove();
	});	
	
	//add
	$configForm.on('click', 'button.add', function(event){
		$configForm.find('.queries').append(queryRow());
	});
	
	//on submit
	$configForm.submit(function(event){
		var vals = [];

		$configForm.find('.queries .cell input[type="text"]').each(function(){
			var val = $(this).val().trim(); //remove empty fields
			
			if (val)
				vals.push(val);
		});
                
		$queriesInput.val(vals.join('||'));
	});
	
	
	function queryRow(value){
		var $row = $('<div class="table-row"><div class="cell"><input type="text" /></div><div class="cell"><button class="delete" type="button" title="' + '<?php i18n('PluginLock/CONF_DELETE')?>' + '">&times;</button></div></div>');
		
		if (value)
			$row.find('input').val(value);
			
		return $row;
	}

});