"use strict";

const Imerologio = {};

Imerologio.init = function() {
	Imerologio.bodyDOM = $(document.body);
	Imerologio.imerologioDOM = $('#imerologio');

	Imerologio.bodyDOM.
	on('mouseenter', '.item', function() {
		$(this).addClass('candy');
	}).
	on('mouseleave', '.item', function() {
		$(this).removeClass('candy');
	}).
	on('click', '.etos', Imerologio.etosEpilogi).
	on('click', '.minas', Imerologio.minasEpilogi);

	Imerologio.etosDOM = undefined;
	Imerologio.minasDOM = undefined;

	Imerologio.
	simera().
	display();

	return Imerologio;
};

Imerologio.etosEpilogi = function() {
	if (Imerologio.etosDOM)
	Imerologio.etosDOM.removeClass('epilogi');

	Imerologio.etosDOM = $(this);
	Imerologio.etosDOM.addClass('epilogi');

	Imerologio.display();
	return Imerologio;
};

Imerologio.minasEpilogi = function() {
	if (Imerologio.minasDOM)
	Imerologio.minasDOM.removeClass('epilogi');

	Imerologio.minasDOM = $(this);
	Imerologio.minasDOM.addClass('epilogi');

	Imerologio.display();
	return Imerologio;
};

Imerologio.display = function() {
	if (!Imerologio.etosDOM)
	return Imerologio;

	if (!Imerologio.minasDOM)
	return Imerologio;

	let etos = Imerologio.etosDOM.text();
	let minas = Imerologio.minasDOM.text();

	Imerologio.imerologioDOM.text(etos + ' ' + minas);
	return Imerologio;
};

Imerologio.simera = function() {
	let simera = new Date();
	let etos = simera.getFullYear();
	let minas = simera.getMonth();
	let ektos = true;

	$('.etos').each(function() {
		if ($(this).text() == etos) {
			$(this).trigger('click');
			ektos = false;
			return false;
		}
	});

	if (ektos)
	return Imerologio;

	$('.minas').each(function() {
		if ($(this).attr('minas') == minas) {
			$(this).trigger('click');
			return false;
		}
	});

	return Imerologio;
};

$(Imerologio.init);
