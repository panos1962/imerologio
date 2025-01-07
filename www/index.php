<!DOCTYPE html>
<html>
<head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Rancho&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<link rel="stylesheet" href="imerologio.css">
<script src="imerologio.js"></script>

<title>Ημερολόγιο</title>
<link rel="icon" type="image/png" href="favicon.png">

</head>
<?php Imerologio::init(); ?>
<body style="background-color: <?php print Imerologio::$xroma; ?>">
<?php
Imerologio::
copyright()::
seldeka()::
seletos()::
selminas()::
pinakas();
?>
</body>
</html>
<?php

Class Imerologio {
	public static $etos;	// default έτος
	public static $minas;	// default μήνας
	private static $sanim;	// ονόματα μηνών
	public static $xroma;	// χρώμα σελίδας

	public static function init() {
		self::
		init_ante()::
		init_etos()::
		init_minas()::
		init_post();

		return __CLASS__;
	}

	// Η function "init_ante" εκκινεί τη διαδικασία θέτοντας
	// αρχικές τιμές και παραμέτρους;

	private static function init_ante() {
		srand();

		// Δίνουμε τιμές στα ονόματα των μηνών με δείκτες
		// από 0 μέχρι 11.

		self::$sanim = [
			"ΙΑΝΟΥΑΡΙΟΣ",
			"ΦΕΒΡΟΥΑΡΙΟΣ",
			"ΜΑΡΤΙΟΣ",
			"ΑΠΡΙΛΙΟΣ",
			"ΜΑΪΟΣ",
			"ΙΟΥΝΙΟΣ",
			"ΙΟΥΛΙΟΣ",
			"ΑΥΓΟΥΣΤΟΣ",
			"ΣΕΠΤΕΜΒΡΙΟΣ",
			"ΟΚΤΩΒΡΙΟΣ",
			"ΝΟΕΜΒΡΙΟΣ",
			"ΔΕΚΕΜΒΡΙΟΣ"
		];

		// Αν έχει δοθεί παράμετρος "color" στο url, τότε η σελίδα
		// χρωματίζεται με τυχαίο χρώμα από παλέτα ήπιων χρωμάτων.

		if (array_key_exists("color", $_GET))
		self::$xroma = self::random_xroma();

		else
		self::$xroma = self::random_xroma(0);

		return __CLASS__;
	}

	// Η function "init_etos" αρχικοποιεί το default έτος του
	// ημερολογίου.

	private static function init_etos() {
		// Εκκινούμε θέτοντας ως default έτος το τρέχον έτος και ως
		// default μήνα τον τρέχοντα μήνα.

		self::$etos = intval(date("Y"));
		self::$minas = intval(date("m"));

		// Ελέγχουμε αν έχει δοθεί έτος στο url.

		if (!array_key_exists("etos", $_GET))
		return __CLASS__;

		// Αν έχει δοθεί έτος στο url ακυρώνουμε τον default μήνα,
		// ακόμη και αν το έτος που δόθηκε είναι λανθασμένο,
		// ωστόσο αφήνουμε το default έτος στο τρέχον έτος.

		self::$minas = NULL;
		$etos = $_GET["etos"];

		// Ελέγχουμε το έτος που δόθηκε όσον αφορά τόσο την
		// συντακτική όσο και την αριθμητική του ορθότητα.

		if (!is_numeric($etos))
		return __CLASS__;

		if ($etos < 0)
		return __CLASS__;

		// Αν το έτος που δόθηκε είναι μικρότερο από την ελάχιστη
		// επιτρεπόμενη τιμή, θέτουμε ως default έτος την ελάχιστη
		// επιτρεπόμενη τιμή ώστε ο χρήστης λάβει γνώση του κάτω
		// ορίου.

		if ($etos < 1600) {
			self::$etos = 1600;
			return __CLASS__;
		}

		// Λειτουργούμε ανάλογα και στην περίπτωση που το έτος που
		// δόθηκε υπερβαίνει την ανώτερη επιτρπόμενη τιμή.

		if ($etos > 9999) {
			self::$etos = 9999;
			return __CLASS__;
		}

		// Το έτος που δόθηκε είναι δεκτό, οπότε το θέτουμε ως
		// default έτος.

		self::$etos = $etos;
		return __CLASS__;
	}

	// Η function "init_minas" αρχικοποιεί τον default μήνα, αφού
	// έχει προηγηθεί η αρχικοποίηση του default έτους.

	private static function init_minas() {
		// Ελέγχουμε αν έχει δοθεί μήνας στο url.

		if (!array_key_exists("minas", $_GET))
		return __CLASS__;

		// Αν έχει δοθεί μήνας στο url, ακυρώνουμε τον default
		// μήνα πριν προβούμε στον έλεγχο του δοθέντος μήνα.

		self::$minas = NULL;
		$minas = $_GET["minas"];

		// Αν υπάρχει οποιοδήποτε σφάλμα στον καθορισμό του
		// default μήνα, φήνουμε απροσδιόριστο τον default
		// μήνα.

		if (!is_numeric($minas))
		return __CLASS__;

		if ($minas < 0)
		return __CLASS__;

		if ($minas < 1)
		return __CLASS__;

		if ($minas > 12)
		return __CLASS__;

		// Ο μήνας που δόθηκε ήταν ορθογραφικά και αριθμητικά
		// ορθός, οπότε θέτουμε τον default μήνα.

		self::$minas = intval($minas);
		return __CLASS__;
	}

	// Η function "init_post" κλείνει το κεφάλαιο της αρχικοποίησης
	// επιτελώντας κάποιες συμπληρωματικές διεργασίες.

	private static function init_post() {
		// Εφόσον έχει καθοριστεί default μήνας, τον προσαρμόζουμε
		// στο εύρος από 0 μέχρι 11.

		if (isset(self::$minas))
		self::$minas--;

		return __CLASS__;
	}

	// Η function "copyright" εκτυπώνει μήνυμα copyright στο επάνω
	// δεξιά μέρος της σελίδας.

	public static function copyright() {
		?>
		<div id="copyright">
			Copyright &copy; 2025- by Panos Papadopoulos.<br>
			All rights reserverd.
			<div id="fonto"><?php print self::$xroma; ?></div>
		</div>
		<?php

		return __CLASS__;
	}

	// Η function "seldeka" εκτυπώνει τη στήλη επιλογής δεκαετίας. Στη
	// στήλη αυτή εκτυπώνοντια δώδεκα δεκαετίες με κεντρική δεκαετία
	// αυτήν του default έτους.

	public static function seldeka() {
		?><div id="seldeka" title="Επιλογή δεκαετίας"><?php

		$aked = self::$etos - (self::$etos % 10);
		$dekaapo = $aked - 50;

		while ($dekaapo < 1600)
		$dekaapo += 10;

		$dekaeos = $dekaapo + 120;

		while ($dekaeos > 10000)
		$dekaeos -= 10;

		$dekaapo = $dekaeos - 120;

		for ($deka = $dekaapo; $deka < $dekaeos; $deka += 10) {
			$klasi = "item deka";

			if ($deka == $aked)
			$klasi .= " epilogi";

			?><div class="<?php print $klasi; ?>"><?php
				print $deka;
			?></div><?php
		}

		?></div><?php

		return __CLASS__;
	}

	// Η function "seletos" εκτυπώνει τη στήλη επιλογής έτους. Στη στήλη
	// αυτή εκτυπώνονται δώδεκα έτη με κεντρικό έτος το default έτος.

	public static function seletos() {
		?><div id="seletos" title="Επιλογή έτους"><?php

		$etosapo = self::$etos - 6;

		if ($etosapo < 0)
		$etosapo = 0;

		$etoseos = $etosapo + 12;

		if ($etoseos > 9999)
		$etoseos = 9999;

		$etosapo = $etoseos - 12;

		for ($etos = $etosapo; $etos < $etoseos; $etos++) {
			$klasi = "item etos";

			if ($etos == self::$etos)
			$klasi .= " epilogi";

			?><div class="<?php print $klasi; ?>"><?php
				print $etos;
			?></div><?php
		}

		?></div><?php

		return __CLASS__;
	}

	// Η function "selminas" εκτυπώνει τη στήλη επιλογής μήνα. Στη
	// στήλη αυτή απλώς εκτυπώνονται τα ονόματα των δώδεκα μηνών.

	public static function selminas() {
		?><div id="selminas" title="Επιλογή μήνα"><?php

		for ($minas = 0; $minas < 12; $minas++) {
			$klasi = "item minas";

			if ($minas === self::$minas)
			$klasi .= " epilogi";

			?><div class="<?php print $klasi; ?>"
				minas="<?php print $minas; ?>"><?php
				print self::$sanim[$minas];
			?></div><?php
		}

		?></div><?php

		return __CLASS__;
	}

	// Η function "pinakas" εκτυπώνει την περιοχή στην οποία εμφανίζεται
	// το μηνιαίο ημερολόγιο με τη μορφή πλέγματος όπου οι κάθετες στήλες
	// αναφέρονται στις ημέρες τηε εβδομάδας ξεκινώντας από τη Δευτέρα.

	public static function pinakas() {
		?>
		<div id="imerologio">
			<table id="pinakas"></table>
			<div id="ektiposi">
				<div id="info">
				Η εκτύπωση είναι προσαρμοσμένη σε μέγεθος
				χαρτιού A4 με προσανατολισμό portrait.
				Μην αμελήσετε να ενεργοποιήσετε τα «background
				graphics» από τις επιλογές εκτύπωσης.
				</div>
				<div id="panel">

				<input type="radio" id="typo" value="Typo" name="font" checked>
				<label for="typo">Typo</label>
				<input type="radio" id="hand" value="Hand" name="font">
				<label for="hand">Hand</label>

				<input type="radio" id="bold" value="Bold" name="tonos" checked>
				<label for="bold">Bold</label>
				<input type="radio" id="light" value="Light" name="tonos">
				<label for="light">Light</label>

				<input type="button" id="print" value="Print!">
				</div>
			</div>
		</div>
		<?php

		return __CLASS__;
	}

	// Η function "random_color" επιστρέφει ένα τυχαίο χρώμα από την
	// παλέτα χρωμάτων. Τα χρώματα που έχουν επιλεγεί είναι απαλά
	// χρώματα που δεν δημιουργούν ανεπιθύμητες αντιθέσεις.

	public static function random_xroma($idx = NULL) {
		$xroma = [
			"darkseagreen",
			"antiquewhite",
			"bisque",
			"burlywood",
			"cadetblue",
			"coral",
			"darkkhaki",
			"darksalmon",
			"forestgreen",
			"ghostwhite",
			"goldenrod",
			"lemonchiffon",
			"lightcoral",
			"lightsalmon",
			"lightseagreen",
			"linen",
			"mediumaquamarine",
			"mediumseagreen",
			"moccasin",
			"peachpuff",
			"peru",
			"sandybrown",
			"seagreen",
			"seashell",
			"silver",
			"skyblue",
			"slategray",
			"snow",
			"steelblue",
			"tan",
			"teal",
			"tomato",
			"wheat",
			"whitesmoke",
		];

		if (!isset($idx))
		$idx = rand(0, count($xroma) - 1);

		return $xroma[$idx];
	}
}
?>
