<?php
define("ETOS_MIN", 1805);
define("ETOS_MAX", 9993);

define("MINAS_MIN", 1);
define("MINAS_MAX", 12);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rancho&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="imerologio.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="imerologio.js"></script>
<title>Ημερολόγιο</title>
<link rel="icon" type="image/png" href="favicon.png">
</head>

<body<?php
if (array_key_exists("color", $_GET))
print ' style="background-color: ' . Epilogi::random_color() . '"';
?>>

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
	public static $minas_name;

	public static function init() {
		self::
		init_etos()::
		init_minas()::
		post_init();

		self::$minas_name = [
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
		self::$etos = intval(date("Y"));
		self::$minas = intval(date("m"));

		if (!array_key_exists("etos", $_GET))
		return __CLASS__;

		self::$minas = NULL;
		$etos = $_GET["etos"];

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

	private static function init_minas() {
		if (!array_key_exists("minas", $_GET))
		return __CLASS__;

		self::$minas = NULL;
		$minas = $_GET["minas"];

		if (!is_numeric($minas))
		return __CLASS__;

		if ($minas < 0)
		return __CLASS__;

		if ($minas < MINAS_MIN)
		return __CLASS__;

		if ($minas > MINAS_MAX)
		return __CLASS__;

		self::$minas = intval($minas);
		return __CLASS__;
	}

	private static function post_init() {
		if (isset(self::$minas))
		self::$minas--;

		return __CLASS__;
	}

	public static function copyright() {
		?>
		<div id="copyright">
			Copyright &copy; 2025- by Panos Papadopoulos.
			<br>
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
			$klasi = "item minas";

			if ($minas === self::$minas)
			$klasi .= " epilogi";

			?><div class="<?php print $klasi; ?>"
				minas="<?php print $minas; ?>"><?php
				print self::$minas_name[$minas];
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
				<div id="panel">
				<input type="radio" id="light" value="light" name="tonos">
				<label for="light">Light</label>
				<input type="radio" id="bold" value="bold" name="tonos" checked>
				<label for="bold">Bold</label>

				<input type="button" id="print" value="Print!">
				</div>
			</div>
		</div>
		<?php

		return __CLASS__;
	}

	public static function random_color() {
		$colors = [
			"aliceblue",
			"antiquewhite",
			"aquamarine",
			"bisque",
			"burlywood",
			"cadetblue",
			"chocolate",
			"coral",
			"darkkhaki",
			"darkorange",
			"darksalmon",
			"darkseagreen",
			"darkslategray",
			"forestgreen",
			"ghostwhite",
			"gold",
			"goldenrod",
			"lemonchiffon",
			"lightblue",
			"lightcoral",
			"lightsalmon",
			"lightseagreen",
			"lightsteelblue",
			"linen",
			"mediumaquamarine",
			"mediumseagreen",
			"moccasin",
			"peachpuff",
			"peru",
			"sandybrown",
			"seagreen",
			"seashell",
			"sienna",
			"silver",
			"skyblue",
			"slategray",
			"snow",
			"steelblue",
			"tan",
			"teal",
			"thistle",
			"tomato",
			"turquoise",
			"wheat",
			"whitesmoke",
			"yellowgreen"
		];

		return $colors[rand(1, count($colors)) - 1];
	}
}
?>
