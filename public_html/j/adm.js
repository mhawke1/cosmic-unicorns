$(document).ready(function()
{
	$('.refundform').submit(function()
	{
		return confirm('Are you sure you want to refund this payment?');
	});
	
	$('#purchasetable').DataTable({
		'order': [[0,'desc']]
	});
});