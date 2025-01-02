<?php
define("ETOS_MIN", 1805);
define("ETOS_MAX", 9993);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Anton+SC&family=Paytone+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="imerologio.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="imerologio.js"></script>
<title>Ημερολόγιο</title>
<link rel="icon" type="image/png" href="favicon.png">
</head>

<body>
<?php
Epilogi::
init()::
copyright()::
seletos()::
selminas()::
imerologio();
?>
</body>

</html>

<?php

Class Epilogi {
	public static $etos;
	public static $minas;

	public static function init() {
		self::init_etos();
		self::$minas = [
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
			"ΔΕΚΕΜΒΡΙΟΣ",
		];

		return __CLASS__;
	}

	private static function init_etos() {
		self::$etos = date("Y");

		if (!array_key_exists("etos", $_REQUEST))
		return __CLASS__;

		$etos = $_REQUEST["etos"];

		if (!is_numeric($etos))
		return __CLASS__;

		if ($etos < 0)
		return __CLASS__;

		if ($etos < ETOS_MIN) {
			self::$etos = ETOS_MIN;
			return __CLASS__;
		}

		if ($etos > ETOS_MAX) {
			self::$etos = ETOS_MAX;
			return __CLASS__;
		}

		self::$etos = $etos;
		return __CLASS__;
	}

	public static function copyright() {
		?>
		<div id="copyright">
			Copyright &copy; 2025- by Panos Papadopoulos.
			All rights reserverd.
		</div>
		<?php

		return __CLASS__;
	}

	public static function seletos() {
		?><div id="seletos"><?php

		$etosapo = self::$etos - 5;
		$etoseos = $etosapo + 12;

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

	public static function selminas() {
		?><div id="selminas"><?php

		for ($minas = 0; $minas < 12; $minas++) {
			?><div class="item minas" minas="<?php print $minas; ?>"><?php
				print self::$minas[$minas];
			?></div><?php
		}

		?></div><?php

		return __CLASS__;
	}

	public static function imerologio() {
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
				<button id="print" type="button">
				Print!
				</button>
			</div>
		</div>
		<?php

		return __CLASS__;
	}
}
?>
