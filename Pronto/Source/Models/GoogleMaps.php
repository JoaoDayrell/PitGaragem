<?php
namespace Source\Models;

class GoogleMaps
{

    private $apiUrl;
    private $apiKey;
    private $params;
    private $callback;
    private $latLng;
    private $address;

    public function __construct()
    {
        $this->apiKey = "AIzaSyCfnplkB928L94hIMjDWLnA1R7LA4p8WMA";
        $this->apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?key={$this->apiKey}&sensor=false&language=pt-BR";
    }

    /**
     * setAddress: Define qual endere�o buscar
     * @param string $params Endere�o (Florian�polis | Florian�polis Campeche | Rua XPTO)
     */
    public function setAddress($params)
    {
        $this->params = str_replace(" ", "+", $params);
        $this->get();
        return $this;
    }

    /**
     * getAddress: Retorna o endere�o escrito
     * @return string Florian�polis = Florian�polis, Santa Catarina, Brasil
     */
    public function getAddress()
    {
        $this->address = $this->callback->results[0]->formatted_address;
        return $this->address;
    }

    /**
     * getLatLng: Retorna latitude e longitude do endere�o
     * @return object ->lat and ->lng
     */
    public function getLatLng()
    {
        $this->latLng = $this->callback->results[0]->geometry->location;
        return $this->latLng;
    }

    /**
     * getCallback: Retorna o objeto completo do endere�o
     * @return object Todos os atributos.
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Efetua uma comunica��o via HTTP GET
     */
    private function get()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->apiUrl}&address={$this->params}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }

}
