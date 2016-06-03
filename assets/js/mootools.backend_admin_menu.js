$(document).addEvent('domready', function() {
	var $menu = $('backend_admin_menu');

	if ($menu == null)
		return;

	$menu.getElements('li.label').each(function(elem) {
		var list = elem.getElement('ul.actions');

		list.set('tween', {duration: 200});

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