var Site = {

    /**
     * Init Function
     */
    init: function() {
        $('html').removeClass('no-js');

		// Datepicker
		if($('.datepicker').length) {
			Site.datePicker();
		}
    },

	/**
     * Date picker
     */
	datePicker: function() {
		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd'
		});
	}
}

$(function() {
    Site.init();
});