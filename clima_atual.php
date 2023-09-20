<?php

require __DIR__ . '/vendor/autoload.php';

// Classe do OpenWeatherMap, dependência
use App\WebService\OpenWeatherMap;

// Instância da nossa API
$obOpenWeatherMap = new OpenWeatherMap('');

if (!isset($argv[2]) ?? !isset($_GET['cidade']) ?? !isset($_GET['uf'])) {
    die('Cidade e UF são obrigatórios');
}

$cidade = $argv[1] ?? $_GET['cidade'];
$uf = $argv[2] ?? $_GET['uf'];

// Executa a consulta na API do OpenWeatherMap
$dadosClima = $obOpenWeatherMap->consultarClimaAtual($cidade, $uf);

// Cidade
echo 'Cidade: '. $cidade. '/'. $uf. "\n";

// Temperatura
echo 'Temperatura: '. ($dadosClima['main']['temp'] ?? 'Desconhecido') . "\n";
echo 'Sensação Térmica: '. ($dadosClima['main']['feels_like'] ?? 'Desconhecido') . "\n";

// Clima
echo 'Sensação Térmica: '. ($dadosClima['weather'][0]['description'] ?? 'Desconhecido') . "\n";
