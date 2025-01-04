"use strict";

const Imerologio = {};

Imerologio.init = function() {
	Imerologio.
	setup().
	printer().
	display();

	return Imerologio;
};

Imerologio.setup = function() {
	Imerologio.bodyDOM = $(document.body);
	Imerologio.copyrightDOM = $('#copyright');
	Imerologio.seldekaDOM = $('#seldeka');
	Imerologio.seletosDOM = $('#seletos');
	Imerologio.selminasDOM = $('#selminas');
	Imerologio.imerologioDOM = $('#imerologio');
	Imerologio.pinakasDOM = $('#pinakas');
	Imerologio.ektiposiDOM = $('#ektiposi');
	Imerologio.panelDOM = $('#panel');
	Imerologio.tonosDOM = $('input[name=tonos]');
	Imerologio.printDOM = $('#print');

	Imerologio.dekaDOM = Imerologio.seldekaDOM.children('.epilogi').first();
	Imerologio.etosDOM = Imerologio.seletosDOM.children('.epilogi').first();
	Imerologio.minasDOM = Imerologio.selminasDOM.children('.epilogi').first();

	$(document.body).
	on('mouseenter', '.item', function() {
		$(this).addClass('candy');
	}).
	on('mouseleave', '.item', function() {
		$(this).removeClass('candy');
	}).
	on('click', '.deka', Imerologio.dekaEpilogi).
	on('click', '.etos', Imerologio.etosEpilogi).
	on('click', '.minas', Imerologio.minasEpilogi);

	Imerologio.tonosDOM.on('change', function() {
		switch ($('input[name=tonos]:checked').val()) {
		case 'light':
			$('.mera').css({
				"font-weight": 'normal',
				"font-size": '42px',
			});
			break;
		default:
			$('.mera').css({
				"font-weight": '',
				"font-size": '',
			});
			break;
		}
	});

	return Imerologio;
};

Imerologio.printer = function() {
	let bodyColor;

	$(window).
	on('beforeprint', function() {
		bodyColor = Imerologio.bodyDOM.css('background-color');
		Imerologio.bodyDOM.css('background-color', '#FFF');
		Imerologio.copyrightDOM.css('display', 'none');
		Imerologio.seldekaDOM.css('display', 'none');
		Imerologio.seletosDOM.css('display', 'none');
		Imerologio.selminasDOM.css('display', 'none');
		Imerologio.ektiposiDOM.css('display', 'none');
		Imerologio.imerologioDOM.css('margin', '60px 0 0 20px');
		Imerologio.pinakasDOM.css('box-shadow', 'none');

		if (Imerologio.simeraDOM)
		Imerologio.simeraDOM.css('display', 'none');
	}).
	on('afterprint', function() {
		Imerologio.bodyDOM.css('background-color', bodyColor);
		Imerologio.copyrightDOM.css('display', '');
		Imerologio.seldekaDOM.css('display', '');
		Imerologio.seletosDOM.css('display', '');
		Imerologio.selminasDOM.css('display', '');
		Imerologio.ektiposiDOM.css('display', 'block');
		Imerologio.imerologioDOM.css('margin', '');
		Imerologio.pinakasDOM.css('box-shadow', '');

		if (Imerologio.simeraDOM)
		Imerologio.simeraDOM.css('display', '');
	});

	Imerologio.printDOM.
	on('click', () => window.print());

	return Imerologio;
};

Imerologio.dekaEpilogi = function() {
	if ($(this).hasClass('epilogi'))
	return Imerologio;

	Imerologio.seldekaDOM.empty();

	let aked = parseInt($(this).text());
	let dekaapo = aked - 50;

	while (dekaapo < 0)
	dekaapo += 10;

	let dekaeos = dekaapo + 120;

	while (dekaeos > 10000)
	dekaeos -= 10;

	dekaapo = dekaeos - 120;

	for (let deka = dekaapo; deka < dekaeos; deka += 10) {
		let klasi = "item deka";

		if (deka == aked)
		klasi += ' epilogi';

		$('<div>').addClass(klasi).text(deka).
		appendTo(Imerologio.seldekaDOM);
	}

	let sote = undefined;

	if (Imerologio.etosDOM.length) {
		sote = parseInt(Imerologio.etosDOM.text());

		if ((sote % 10) == 0)
		sote = undefined;
	}

	let etosapo = aked - 1;

	while (etosapo < 0)
	etosapo++;

	if (etosapo > 9988)
	etosapo = 9988;

	let etoseos = etosapo + 12;
	let entos = false;

	Imerologio.seletosDOM.empty();

	for (let etos = etosapo; etos < etoseos; etos++) {
		let klasi = 'item etos';

		if (etos === sote) {
			entos = true;
			klasi += ' epilogi';
		}

		$('<div>').addClass(klasi).text(etos).
		appendTo(Imerologio.seletosDOM);
	}

	if (entos)
	return Imerologio;

	if (Imerologio.etosDOM.length) {
		let etosIndex;

		switch (aked) {
		case 0:
			etosIndex = 0;
			break;
		case 9990:
			etosIndex = 2;
			break;
		default:
			etosIndex = 1;
			break;
		}

		Imerologio.etosDOM.removeClass('epilogi');
		Imerologio.etosDOM = $(Imerologio.seletosDOM.children().
			get(etosIndex));
		Imerologio.etosDOM.addClass('epilogi');
	}

	Imerologio.display();
	return Imerologio;
};

Imerologio.etosEpilogi = function() {
	if ($(this).hasClass('epilogi'))
	return Imerologio;

	Imerologio.seletosDOM.children('.epilogi').removeClass('epilogi');
	Imerologio.etosDOM = $(this);
	Imerologio.etosDOM.addClass('epilogi');

	Imerologio.display();
	return Imerologio;
};

Imerologio.minasEpilogi = function() {
	if ($(this).hasClass('epilogi'))
	return Imerologio;

	Imerologio.selminasDOM.children('.epilogi').removeClass('epilogi');
	Imerologio.minasDOM = $(this);
	Imerologio.minasDOM.addClass('epilogi');

	Imerologio.display();
	return Imerologio;
};

Imerologio.simera = function() {
	if (Imerologio.etosDOM.length)
	return Imerologio;

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
	if (!Imerologio.etosDOM.length)
	return Imerologio;

	if (!Imerologio.minasDOM.length)
	return Imerologio;

	let etos = Imerologio.etosDOM.text();
	let minas = Imerologio.minasDOM.attr('minas');
	let date = new Date(etos, minas);

	Imerologio.pinakasDOM.empty();
	Imerologio.simeraDOM = undefined;

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

	let simera = Imerologio.date2ymd();

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

			let dom = $('<div class="' + klasi + '">').
			text(date.getDate());

			klasi = 'keli';

			// Τα Σαββατοκύριακα εμφανίζονται σκιασμένα.

			if (dow > 4)
			klasi += ' skiasi';

			$('<td class="' + klasi + '">').append(dom).
			appendTo(gramiDOM);

			if (Imerologio.date2ymd(date) === simera)
			Imerologio.simeraDOM = $('<img id="simera">').
			attr('src', 'simera.png').
			appendTo(dom);

			// Αυξάνουμε την ημερομηνία κατά μία ημέρα.

			date = new Date(date.getTime() + (24 * 60 * 60 * 1000));
		}
	} while (date.getMonth() == minas);

	Imerologio.ektiposiDOM.css('display', 'inline-block');
	Imerologio.tonosDOM.trigger('change');

	return Imerologio;
};

Imerologio.date2ymd = function(date) {
	if (!date)
	date = new Date();

	let ymd = date.getFullYear() * 10000;
	ymd += date.getMonth() * 100;
	ymd += date.getDate();

	return ymd;
};

$(Imerologio.init);
