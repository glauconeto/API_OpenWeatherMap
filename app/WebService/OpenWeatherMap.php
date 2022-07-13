<?php

namespace App\WebService;

class OpenWeatherMap
{
    /**
     * URL base das APIs
     * @var string
     */
    const BASE_URL = 'https://api.openweathermap.org';

    /**
     * Chave de acesso da API
     * @var string
     */
    private $apiKey;

    /**
     * Método responsável por construir a classe definindo a chave de API
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Método responsável por retonar o clima atual de uma cidade cidade do Brasil
     * @param string $cidade
     * @param string $uf
     * @return array
     */
    public function consultarClimaAtual($cidade, $uf)
    {
        return $this->get('/data/2.5/weather', [
            'q' => $cidade. ','. 'BR-'. $uf. ','. 'BRA',

        ]);
    }
    
    /**
     * Método responsável por retonar a previsão do tempo de uma cidade cidade do Brasil
     * @param string $cidade
     * @param string $uf
     * @return array
     */
    public function consultarPrevisaoTempo($cidade, $uf)
    {
        return $this->get('/data/2.5/forecast', [
            'q' => $cidade. ','. 'BR-'. $uf. ','. 'BRA',

        ]);
    }

    /**
     * Método responsável por executar a consulta GET na API do OpenWeatherMap
     * @param string $ressource
     * @param array $params
     * @return array
     */
    private function get($resource, $params = [])
    {
        // Parâmetros adicionais
        $params['units'] = 'metric';
        $params['lang'] = 'pt_br'; 
        $params['appid'] = $this->apiKey;

        // Endpoint
        $endpoint = self::BASE_URL. $resource. '?'. http_build_query($params);

        // Inicia o curl
        $curl = curl_init();

        // Configurações do curl
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        // Response
        $response = curl_exec($curl);

        // Fecha a conexão do curl
        curl_close($curl);

        // Response em array
        return json_decode($response, true);
    }
}