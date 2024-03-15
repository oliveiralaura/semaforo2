<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <audio id="audio" preload="none">
        <source src="som/liberado.mp3" type="audio/mp3">
    </audio>
    <?php
        //echo "<audio autoplay><source src='som/liberado.mp3' type='audio/mp3'></audio>";
        echo "oi";
        echo "";
    ?>
    <script>
        setInterval(() => {
            playSound();
            function playSound(){
            const audio = new Audio('som/liberado.mp3');
            audio.onended = function(){
            };
            audio.play();
        }
        
        }, 5000);
        
        

    </script>
</body>
</html>