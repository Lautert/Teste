$('body').on('click', 'fieldset legend', function(){
	$(this).parents('fieldset:eq(0)').find('div').toggle();
});