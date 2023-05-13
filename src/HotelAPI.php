<?php
namespace HotelApi;
/**
 * Classe HotelAPI representa a API de hotéis com uma lista de hotéis.
 */

class HotelAPI {
    private $hoteis = [];

    /**
     * Construtor da classe HotelAPI.
     * 
     * @param array $hoteis Uma lista de objetos da classe Hotel.
     */

    public function __construct($hoteis) {
        $this->hoteis = $hoteis;
    }


     /**
     * Obtém a lista de hotéis ordenados por distância em relação ao ponto do usuário.
     * 
     * @param float $latitudeUsuario A latitude do ponto do usuário.
     * @param float $longitudeUsuario A longitude do ponto do usuário.
     * @return array Uma lista de objetos da classe Hotel ordenados por distância.
     */

    public function getNearbyHotels($latitudeUsuario, $longitudeUsuario,$orderby = "proximity" ) {
        // Calcula a distância de cada hotel em relação ao ponto do usuário
        foreach ($this->hoteis as $hotel) {
            $distance = $hotel->calcularDistancia($latitudeUsuario, $longitudeUsuario);
            $hotel->distance = $distance;
        }

        // Ordena os hotéis por ordem crescente de distância -   “proximity” or “pricepernight”

        if ($orderby=="proximity")
        {
            usort($this->hoteis, function($a, $b) {
                return $a->distance - $b->distance;
            });
    
        }
        elseif ($orderby=="pricepernight")
        {
            usort($this->hoteis, function($a, $b) {
                return $a->valor - $b->valor;
            });
    
        }
        //echo "<br>6.3<br>";

        return $this->hoteis;
    }
}
