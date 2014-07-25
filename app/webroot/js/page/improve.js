$(document).ready(function() {
	$('#ItemItemDate').datepicker({
		dateFormat: 'yy-mm-dd',
		beforeShowDay: function(date) {
			return [date.getDay() === 3, ''];
		}
	}).attr('readonly', true)
		.css('cursor', 'pointer');
});