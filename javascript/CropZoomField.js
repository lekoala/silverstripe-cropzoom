(function($) {
	$.entwine('ss', function($) {
		var $container = $('.crop-zoom-field .container');
		var options = $container.data('options');
		var id = $container.data('imageid');

		var cropzoom = $container.cropzoom(options);

		$('.crop-zoom-field .crop').entwine({
			onclick: function(e) {
				e.preventDefault();
				cropzoom.send('/admin/cropzoom/doCropZoom/' + id, 'POST', {}, function(rta) {
					window.location.reload();
				});
			}
		});

		$('.crop-zoom-field .restore').entwine({
			onclick: function(e) {

			}
		});

		$('.crop-zoom-field .container').entwine({
		});
	});
}(jQuery));
