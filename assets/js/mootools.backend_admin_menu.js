$(document).addEvent('domready', function() {
	$('backend_admin_menu').getElements('li.label').each(function(elem) {
		var list = elem.getElement('ul.actions');

		elem.addEvents({
			'mouseenter' : function(){
				$('header').setStyle('border-bottom-left-radius', '0');
				list.fade('in');
			},
			'mouseleave' : function(){
				list.fade('out');
				$('header').setStyle('border-bottom-left-radius', '3px');
			}
		});
	})
});