<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ElePHPant Number</title>
	<link rel="stylesheet" href="style.css">
	<!-- Create the style and see to join with js to set caret default position at the end of the input -->
</head>

<body>
	<header>
		<h1>
			<?php
					$userInput = (int) $_POST["userInput"];
					$toGuess = (int) $_POST["toGuess"];
					$attempts = getAttempts();
					
					if (checkWin()) echo "&bigstar; You guessed the number &bigstar;";
					elseif (in_array((string) $userInput, $attempts)) echo "&rArr; Alredy tried that number &lArr;";
					elseif($userInput > $toGuess) echo "&uArr;  number was higher &uArr;";
					elseif($userInput < $toGuess) echo "&dArr; Your number was lower &dArr;";
					else echo "&blacklozenge; Find the Number &blacklozenge;";
				?>
		</h1>
	</header>
	<main>
		<section>
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<input type="number" name="userInput" min="0" max="50" minlength="1" maxlength="2" pattern="\d{1}"
					value="<?php echo isset($_POST["userInput"])? $_POST["userInput"]:"0";?>" autocomplete="off"
					step="1" required <?php echo isset($_POST["userInput"])? "autofocus":"";?>
					title="Enter numbers in the range of &OpenCurlyDoubleQuote;0-50&CloseCurlyDoubleQuote;" />
				<input type="hidden" name="toGuess"
					value="<?php echo isset($_POST["toGuess"])? $_POST["toGuess"]:random_int(0, 50)?>">
				<input type="hidden" name="attempts" value="<?php
					$attempts = getAttempts();
					if (isset($_POST["userInput"]))
						echo in_array($_POST["userInput"], $attempts)? "":$_POST["attempts"].",".$_POST["userInput"];
					else echo "51";
					?>">
				<input type="submit" name="guess" value="Try" <?php if(checkWin()) echo "disabled";?>>
			</form>
		</section>
	</main>
</body>

<?php
	function checkWin() {
		if(
			isset($_POST["toGuess"])
			&& isset($_POST["userInput"])
			&& $_POST["toGuess"] == $_POST["userInput"]
		) return true;
	}

	function getAttempts() {return explode(",", $_POST["attempts"]);}
?>

</html>