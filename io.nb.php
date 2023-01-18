<?php

$streamList = [
    fopen('arquivo.txt', 'r'),
    fopen('arquivo2.txt', 'r')
];

foreach ($streamList as $stream) {
    stream_set_blocking($stream, false);
}

do {
    $copyReadStream = $streamList;
    $numeroDeStreams = stream_select($copyReadStream, $write, $except, 0, 200000);

    if ($numeroDeStreams === 0) {
        echo "Realizar outras tarefas" . PHP_EOL;
        continue;
    }

    foreach ($copyReadStream as $key => $stream) {
        echo fgets($stream);
        echo $streamList[$key] . PHP_EOL;
        unset($streamList[$key]);
    }
} while(!empty($streamList));

echo "Li todos os arquivos" . PHP_EOL;