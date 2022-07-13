<?php

require __DIR__ . '/vendor/autoload.php';

// Classe do OpenWeatherMap, dependência
use App\WebService\OpenWeatherMap;

// Instância da API
$obOpenWeatherMap = new OpenWeatherMap('2a3856348fc5aa9db41dae5a705a5b0f');

if (!isset($argv[2])) {
    die('Cidade e UF são obrigatórios');
}

$cidade = $argv[1];
$uf = $argv[2];

// Executa a consulta na API do OpenWeatherMap
$dadosPrevisao = $obOpenWeatherMap->consultarPrevisaoTempo($cidade, $uf);

// Cidade
echo 'Cidade: '. $cidade. '/'. $uf. "\n";

foreach (($dadosPrevisao['list'] ?? []) as $previsao) {
    // Monta os dados de impressão
    $output = [
        $previsao['dt_txt'],
        number_format($previsao['main']['temp'], 2, '.', ''),
        number_format($previsao['main']['feels_like'], 2, '.', ''),
        $previsao['weather'][0]['description'] ?? ''
    ];

    echo implode(' | ', $output). "\n";
}
