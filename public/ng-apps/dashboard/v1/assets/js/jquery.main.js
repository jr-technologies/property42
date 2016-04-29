 
 $(function() {
	 if ($(".addPropertyFormContainer")[0]){
		handleAddPropertyFormScrolling();
	 }
});

$(".searchable-select").select2({
	placeholder: "Select",
  allowClear: true
});

// page init
jQuery(function(){
	initTabs();
});

// content tabs init
function initTabs() {
	jQuery('.tabset').contentTabs({
		tabLinks: 'a'
	});
}