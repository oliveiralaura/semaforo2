<?php

$api_url = 'https://niloweb.com.br/transit-room/api/reg_endpoint.php';
$imagem = 'images/libera.jpg';
$imagemDois = 'images/block.png';
$imagemTres = 'images/aguarde.jpg';

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST'
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($api_url, false, $context);

if ($response === FALSE) {
    die('Erro ao acessar a API');
}

$data = json_decode($response, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joguinho</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .imagemResultado {
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 1000;
        }

        .fade-in {
            opacity: 1;
        }
        .bloqueado { background-color: rgb(121, 210, 226); }
        .liberado { background-color: rgb(114, 240, 169); }
        .aguardando { background-color: rgb(210, 226, 121); }

        /* Estilo para tornar o botão invisível */
        #playButton {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
    </style>
</head>
<body>
    <main>
        <?php
            foreach ($data as $item) {
                $res = $item['res'];
                $dia = $item['dia'];
                $classe = '';
                
                if ($res == 'B') {
                    echo "<p>Você está bloqueado(a)</p>";
                    echo "<img src='$imagemDois' alt='Minha Imagem' class='imagemResultado'>";
                    $classe = 'bloqueado';
                } elseif ($res == 'L') {
                    echo "<p>Você está liberado(a)</p>";
                    echo "<img src='$imagem' alt='Minha Imagem' class='imagemResultado'>";
                    $classe = 'liberado';
                } elseif ($res == 'A') {
                    echo "<p>Aguarde!!!</p>";
                    echo "<img src='$imagemTres' alt='Minha Imagem' class='imagemResultado'>";
                    $classe = 'aguardando';
                } else {
                    echo "<p>Resultado desconhecido para o dia $dia\n</p>";
                }
            }
        ?>
    </main>

    <?php
        if(isset($classe)) {
            echo "<script>document.body.classList.add('$classe');</script>";
        }
    ?>

   
    <script>
        function playAudio() {
            const audio = new Audio('som/<?php echo $res; ?>.mp3');
            audio.play();
        }

        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'visible') {
                playAudio();
            }
        });
    </script>
</body>
</html>
