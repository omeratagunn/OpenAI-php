<?php
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
class OpenAI
{
    private $secretKey;
    private $baseUri = 'https://api.openai.com';
    private $version = 'v1';
    private $prefix = 'engines';
    private $engineId = 'davinci'; // default

    /**
     * OpenAI constructor.
     * @param string $secretKey
     */
    public function __construct(string $secretKey){
            $this->secretKey = $secretKey;
            $this->baseUri = $this->baseUri.'/'.$this->version.'/'.$this->prefix;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version) : void{
            $this->version = $version;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix) : void{
            $this->prefix = $prefix;
    }

    /**
     * @param string $endPoint
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function get(string $endPoint = '') : ResponseInterface{
       $endPoint ? $this->baseUri .= '/'.$endPoint  : $this->baseUri;

        $client = new Client();
        $response = $client->request('GET', $this->baseUri,
        [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Accept'        => 'application/json',
            ]
        ]);
        return $response;
    }

    /**
     * @param array $postParams
     * @param string $category
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function post(array $postParams, string $category) : ResponseInterface{
        $client = new Client();
        $response = $client->request('POST', $this->baseUri.'/'.$this->engineId.'/'.$category,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Accept'        => 'application/json',
                ],
                GuzzleHttp\RequestOptions::JSON => $postParams,
            ]);
        return $response;
    }

    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getEngineList() : ResponseInterface{
        return $this->get();
    }

    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function retrieveEngine() : ResponseInterface{
        return $this->get($this->engineId);
    }

    /**
     * @param string $engineId
     */
    public function setEngineId(string $engineId) : void{
        $this->engineId = $engineId;
    }

    /**
     * @param array $postParams
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function postCompletions(array $postParams) : ResponseInterface{
        return $this->post($postParams, 'completions');
    }

    /**
     * @param array $postParams
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function search(array $postParams) : ResponseInterface{
        return $this->post($postParams, 'search');
    }


}

