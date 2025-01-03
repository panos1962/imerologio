"use strict";

const Imerologio = {};

Imerologio.init = function() {
	Imerologio.
	setup().
	printer().
	simera().
	display();

	return Imerologio;
};

Imerologio.setup = function() {
	Imerologio.copyrightDOM = $('#copyright');
	Imerologio.seletosDOM = $('#seletos');
	Imerologio.selminasDOM = $('#selminas');
	Imerologio.imerologioDOM = $('#imerologio');
	Imerologio.pinakasDOM = $('#pinakas');
	Imerologio.ektiposiDOM = $('#ektiposi');
	Imerologio.printDOM = $('#print');

	Imerologio.etosDOM = Imerologio.seletosDOM.find('.epilogi').first();
	Imerologio.minasDOM = undefined;

	$(document.body).
	on('mouseenter', '.item', function() {
		$(this).addClass('candy');
	}).
	on('mouseleave', '.item', function() {
		$(this).removeClass('candy');
	}).
	on('click', '.etos', Imerologio.etosEpilogi).
	on('click', '.minas', Imerologio.minasEpilogi);

	return Imerologio;
};

Imerologio.printer = function() {
	$(window).
	on('beforeprint', function() {
		Imerologio.copyrightDOM.css('display', 'none');
		Imerologio.seletosDOM.css('display', 'none');
		Imerologio.selminasDOM.css('display', 'none');
		Imerologio.ektiposiDOM.css('display', 'none');
		Imerologio.imerologioDOM.css('margin', '60px 0 0 20px');
		Imerologio.pinakasDOM.css('box-shadow', 'none');
	}).
	on('afterprint', function() {
		Imerologio.copyrightDOM.css('display', '');
		Imerologio.seletosDOM.css('display', '');
		Imerologio.selminasDOM.css('display', '');
		Imerologio.ektiposiDOM.css('display', '');
		Imerologio.imerologioDOM.css('margin', '');
		Imerologio.pinakasDOM.css('box-shadow', '');
	});

	Imerologio.printDOM.
	on('click', () => window.print());

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

Imerologio.dow = [
	'ΔΕΥ',
	'ΤΡΙ',
	'ΤΕΤ',
	'ΠΕΜ',
	'ΠΑΡ',
	'ΣΑΒ',
	'ΚΥΡ',
];

Imerologio.display = function() {
	if (!Imerologio.etosDOM)
	return Imerologio;

	if (!Imerologio.minasDOM)
	return Imerologio;

	let etos = Imerologio.etosDOM.text();
	let minas = Imerologio.minasDOM.attr('minas');
	let date = new Date(etos, minas);

	// Υπολογίζουμε την πρώτη μέρα του μήνα ως νούμερο
	// από 0 έως 6 ως εξής:
	//
	// 0: Δευτέρα
	// 1: Τρίτη
	// 2: Τετάρτη
	// 3: Πέμπτη
	// 4: Παρασκευή
	// 5: Σάββατο
	// 6: Κυριακή

	let dow = (date.getDay() + 6) % 7;

	// Εντοπίζουμε την Δευτέρα πριν την πρώτη του μήνα που μας
	// ενδιαφέρει.

	if (dow)
	date = new Date(date.getTime() - (dow * 24 * 60 * 60 * 1000));

	Imerologio.pinakasDOM.empty();

	// Στην πρώτη γραμμή του πίνακα τυπώνουμε τον μήνα και το έτος.

	Imerologio.pinakasDOM.
	append($('<tr>').
	append($('<td id="epikefalida" colspan="7">').
	text(Imerologio.minasDOM.text() + ' ' + etos)));

	// Στην επόμενη γραμμή εκτυπώνουμε τα ονόματα των ημερών ξεκινώντας
	// από την Δευτέρα.

	let gramiDOM = $('<tr>').appendTo(Imerologio.pinakasDOM);

	for (dow = 0; dow < 7; dow++)
	$('<td class="dow skiasi">').text(Imerologio.dow[dow]).appendTo(gramiDOM);

	// Ακολουθούν οι εβδομάδες του ζητούμενου μήνα.

	do {
		gramiDOM = $('<tr>').appendTo(Imerologio.pinakasDOM);

		for (dow = 0; dow < 7; dow++) {
			let m = date.getMonth();
			let klasi = "mera";

			// Οι ημέρες που ανήκουν στον προηγούμενο ή στον
			// επόμενο μήνα εμφανίζονται με αχνά νούμερα.

			if (m != minas)
			klasi += ' ektos';

			// Τα Σαββατοκύριακα εμφανίζονται σκιασμένα.

			if (dow > 4)
			klasi += ' skiasi';

			$('<td class="' + klasi + '">').text(date.getDate()).
			appendTo(gramiDOM);

			// Αυξάνουμε την ημερομηνία κατά μία ημέρα.

			date = new Date(date.getTime() + (24 * 60 * 60 * 1000));
		}
	} while (date.getMonth() == minas);

	Imerologio.printDOM.css('display', 'inline-block');
	return Imerologio;
};

$(Imerologio.init);
