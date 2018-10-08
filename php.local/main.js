$(function() {
	$('#new_cat').click(function() {
		newCat = {
			name:     $('input[name=cat_name]').val(),
			sex:      $('select[name=cat_sex]').val(),
			chip:     $('select[name=cat_chip]').val(),
			birth:    $('input[name=cat_birth]').val(),
			neutered: $('select[name=cat_neutered]').val(),
			url:      location.href
		};
		if(newCat.name == '') {
			alert('A név mező kitöltése kötelező!');
			$('input[name=cat_name]').focus().parent().addClass('danger');
		} else if(newCat.sex == -1) {
			alert('A nem mező kitöltése kötelező!');
			$('select[name=cat_sex]').focus().parent().addClass('danger');
		} else if(newCat.chip == -1) {
			alert('A chip mező kitöltése kötelező!');
			$('select[name=cat_chip]').focus().parent().addClass('danger');
		} else if(newCat.birth == '') {
			alert('A születési dátum mező kitöltése kötelező!');
			$('input[name=cat_birth]').focus().parent().addClass('danger');
		} else if(newCat.neutered == -1) {
			alert('Az ivartalanítás mező kitöltése kötelező!');
			$('select[name=cat_neutered]').focus().parent().addClass('danger');
		} else {
			$.post('new_cat.php', newCat, function(data) {
				alert(data.message);
				if(data.statusNumber == 2) {
					$('input[name=cat_birth]').focus().parent().addClass('danger');
				} else if(data.statusNumber == 1) {
					// Adatok frissítése
					$('#cat_list').html('').append(data.tbody);
				};
			});
		};
	});
	$('button.del').click(function() {
		var delID = $(this).attr('id');
		var delTD = $(this).parent().parent();
		//alert(delID);
		del = {id: delID};
		$.post('del_cat.php', del, function(data) {
			if(data.status) {
				delTD.hide();
				setTimeout(alert, 1, data.message);
				//alert(data.message);
			} else {
				alert(data.message);
			};
		});
	});
	$('input[name=cat_name]').change(function() {
		if($('input[name=cat_name]').val() != '') {
			$('input[name=cat_name]').parent().removeClass('danger');
		};
	});
	$('select[name=cat_sex]').change(function() {
		if($('select[name=cat_sex]').val() != -1) {
			$('select[name=cat_sex]').parent().removeClass('danger');
		};
	});
	$('select[name=cat_chip]').change(function() {
		if($('select[name=cat_chip]').val() != -1) {
			$('select[name=cat_chip]').parent().removeClass('danger');
		};
	});
	$('input[name=cat_birth]').change(function() {
		if($('input[name=cat_birth]').val() != '') {
			$('input[name=cat_birth]').parent().removeClass('danger');
		};
	});
	$('select[name=cat_neutered]').change(function() {
		if($('select[name=cat_neutered]').val() != -1) {
			$('select[name=cat_neutered]').parent().removeClass('danger');
		};
	});
	$('.cat_text').change(function() {
		change = {
			name: $(this).attr('name'),
			value: $(this).val()
		};
		$.post('change_text.php', change, function(data) {
			alert(data.message);
		});
	});
	$('.cat_number').change(function() {
		change = {
			name: $(this).attr('name'),
			value: $(this).val()
		};
		$.post('change_number.php', change, function(data) {
			alert(data.message);
		});
	});
	$('.cat_date').change(function() {
		change = {
			name: $(this).attr('name'),
			value: $(this).val()
		};
		$.post('change_date.php', change, function(data) {
			alert(data.message);
		});
	});
});