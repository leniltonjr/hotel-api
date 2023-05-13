<?php
namespace HotelApi;
    /**
     * Classe Hotel representa um hotel com nome, valor, latitude, longitude e distância.
    */
    
     class Hotel {
        public $nome;
        public $valor;
        public $latitude;
        public $longitude;
        public $distance;
        
        /**
        * Construtor da classe Hotel.
        * 
        * @param string $nome O nome do hotel.
        * @param float $valor O valor do hotel.
        * @param float $latitude A latitude do hotel.
        * @param float $longitude A longitude do hotel.
        * @param float $distance A distância do hotel em relação ao ponto do usuário.
        */
        
        public function __construct($nome, $valor, $latitude, $longitude, $distance) {
            $this->nome = $nome;
            $this->valor = $valor;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->distance = $distance;
        }
    
        /**
         * Calcula a distância entre o hotel e o ponto do usuário utilizando a fórmula de Haversine.
         * 
         * @param float $latitudeUsuario A latitude do ponto do usuário.
         * @param float $longitudeUsuario A longitude do ponto do usuário.
         * @return float A distância entre o hotel e o ponto do usuário em quilômetros.
         */
    
        public function calcularDistancia($latitudeUsuario, $longitudeUsuario) {
            
            $lat1 = deg2rad($this->latitude);
            $lon1 = deg2rad($this->longitude);
            $lat2 = deg2rad($latitudeUsuario);
            $lon2 = deg2rad($longitudeUsuario);
    
            $deltaLat = $lat2 - $lat1;
            $deltaLon = $lon2 - $lon1;
    
            $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1) * cos($lat2) * sin($deltaLon / 2) * sin($deltaLon / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = 6371 * $c; // 6371 é o raio médio da Terra em quilômetros
    
            return $distance;
        }
    }