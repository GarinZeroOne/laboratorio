$(function() {

	$('#promt').val('');

	$('body').click(function(){
		$("#promt").focus();
	})

	$('input#promt').keypress(function(e) {

	  if (e.keyCode == '13')
	  {
	     e.preventDefault();

	     inputCommand($('#promt').val());

	     $('#promt').val('');
	  }

	});


	function inputCommand( valor )
	{
		switch (valor){

			case 'run':
				window.location.href = 'javascript/';
			break;

			default:
				$('#history').append('<li>'+valor+'</li>');
				$('#history').append('<li class="sysmsg">labError: '+valor+' is not defined</li>');
			break;
		}


	}
});