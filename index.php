<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include "data.php";
$answer = "";
$lastS = null;

if (isset($_GET["id"])) {
    $lastS = (int)$_GET["id"];
}

function randomAnswer($index, $answers)
{
    $remaining = [];
    for ($i = 0; $i < count($answers); $i++) {
        if ($i !== $index) {
            $remaining[] = $i;
        }
    }

    if (count($remaining) > 0) {
        $randomIndex = array_rand($remaining);
        return $remaining[$randomIndex];
    }
    return null;
}

if (isset($_GET["id"])) {
    $newI = randomAnswer($lastS, $answers);
    if ($newI !== null) {
        $answer = $answers[$newI];
        $ball = $colors[$newI];
    }
}

if ($answer != "") {
    $buttonDisplay = "PLAY AGAIN";
} else {
    $buttonDisplay = "ASK 8-BALL";
}

$nextId = isset($newI) ? $newI : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sixtyfour+Convergence&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Honk:MORF,SHLN@18,22&family=Silkscreen&display=swap" rel="stylesheet">
    <title>Magic 8 Ball</title>
</head>

<body>
    <h1>Magic 8 Ball</h1>
    <div class="magic-ball" style="background: <?php echo isset($ball) ? $ball : 'black'; ?>;">
        <?php echo $answer . "Let's Play"; ?>
    </div>
    <div>
        <a class="button" href="./index.php?id=<?php echo $nextId; ?>">
            <?php echo $buttonDisplay; ?>
        </a>
    </div>
    <audio id="background-music" style="display: none;" autoplay>
        <source src="./Assets/sound.mp3" type="audio/mpeg">
    </audio>
</body>

</html>