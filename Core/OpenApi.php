<?php

namespace App\Core;

class OpenApi
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Fonction pour appeler la liste des séries par décennies
     *
     * @param string $listDec
     * @return array|null
     */
    public function getList(string $listDec): ?array
    {
        $data = $this->callApi('list/'.$listDec);
        
        $dataList = $data['items'];
        
        foreach($dataList as $liste) {
            $results[] = [
                'idSerie' => $liste['id'], 
                'name' => $liste['name'], 
                'dateDiff' => date('Y', strtotime($liste['first_air_date'])), 
                'paysOrigin' => $liste['origin_country'][0]
            ];
        }

        return $results;
    }

    /**
     * Fonction pour appeler une série par id
     *
     * @param string $id
     * @return array|null
     */
    public function getSerie(string $id): ?array
    {
        $data = $this->callApi('tv/'.$id);
        $results = [
            'id' => $data['id'], 
            'name' => $data['name'], 
            'nameOrigin' => $data['original_name'],
            'photo' => $data['backdrop_path'], 
            'creator' => $data['created_by'], 
            'genre' => $data['genres'][0]['name'], 
            'nbSaison' => $data['number_of_seasons'], 
            'nbEpisode' => $data['number_of_episodes'], 
            'dateFirstDiff' => date('d/m/Y', strtotime($data['first_air_date'])), 
            'dateLastDiff' => date('d/m/Y', strtotime($data['last_air_date'])), 
            'statut' => $data['status'], 
            'diffuseur' => $data['networks'][0]['name'], 
            'resume' => $data['overview'], 
            'saisons' => $data['seasons'], 
            // 'production' => $data['production_companies'], 
            'pays' => $data['production_countries']
        ];
        // var_dump($results);
        return $results;
    }

    /**
     * Fonction pour appeler les crédits d'une série
     *
     * @param string $id
     * @return array|null
     */
    public function getCredits(string $id): ?array
    {
        $data = $this->callApi('tv/'.$id.'/credits');
        $results = [
            // Acteurs
            'cast' => $data['cast'], 
            // Production/Réalisation
            'crew' => $data['crew'] 
        ];

        return $results;
    }

    /**
     * Fonction pour appeler une saison d'une série
     *
     * @param string $id
     * @param string $saisonNum
     * @return array|null
     */
    public function getSaison(string $id, string $saisonNum): ?array
    {
        $data = $this->callApi('tv/'.$id.'/season/'.$saisonNum);

        $results = [
            'name' => $data['name'], 
            'dateDiff' => date('d/m/Y', strtotime($data['air_date'])), 
            'cover' => $data['poster_path'], 
            'resume' => $data['overview'], 
            'numSaison' => $data['season_number'], 
            'episodes' => $data['episodes'], 
        ];

        return $results;
    }

    /**
     * Fonction pour appeler la biographie d'un acteur ou réalisateur
     *
     * @param integer $id
     * @return array|null
     */
    public function getPerson(int $id): ?array
    {
        $data = $this->callApi('person/'.$id);

        $results = [
            'id' => $data['id'], 
            'name' => $data['name'], 
            'photo' => $data['profile_path'], 
            'placeBirth' => $data['place_of_birth'], 
            'dateBirth' => date('d/m/Y', strtotime($data['birthday'])), 
            'dateDeath' => date('d/m/Y', strtotime($data['deathday'])), 
            'job' => $data['known_for_department'], 

        ];

        return $results;
    }

    /**
     * Fonction pour appeler l'API
     *
     * @param string $endpoint
     * @return array|null
     */
    private function callApi(string $endpoint): ?array
    {
        $curl = curl_init('https://api.themoviedb.org/3/'.$endpoint.'?api_key='.$this->apiKey.'&language=fr-FR');
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_CAINFO => ROOT . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);
        if($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        } 
        return json_decode($data, true);
    }
}
