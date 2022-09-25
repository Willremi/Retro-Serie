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
        $data = $this->callApi('list/'.$listDec, 'null');
        
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
        $data = $this->callApi('tv/'.$id, 'null');
        $results = [
            'id' => $data['id'], 
            'name' => $data['name'], 
            'nameOrigin' => $data['original_name'],
            'photo' => $data['backdrop_path'], 
            'creator' => $data['created_by'], 
            'genre' => $data['genres'], 
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
        $data = $this->callApi('tv/'.$id.'/credits', 'null');
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
        $data = $this->callApi('tv/'.$id.'/season/'.$saisonNum, 'null');

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
        $data = $this->callApi('person/'.$id, 'null');

        $results = [
            'id' => $data['id'], 
            'name' => $data['name'], 
            'photo' => $data['profile_path'], 
            'placeBirth' => $data['place_of_birth'], 
            'dateBirth' => date('d/m/Y', strtotime($data['birthday'])), 
            'dateDeath' => date('d/m/Y', strtotime($data['deathday'] ?? '')), 
            'job' => $data['known_for_department'], 
            'bio' => $data['biography'], 
            'sexe' => $data['gender']
        ];

        return $results;
    }

    /**
     * Fonction pour appeler la participation d'une personne sur des série
     *
     * @param integer $id
     * @return array|null
     */
    public function getPersonCredits(int $id): ?array
    {
        $data = $this->callApi('person/'.$id.'/tv_credits', 'null');

        $results = [
            // Acteurs
            'cast' => $data['cast'], 
            // Production/Réalisation
            'crew' => $data['crew'] 
        ];

        return $results;
    }

    /**
     * Fonction pour appeler la recherche de séries
     *
     * @param string $query
     * @return array|null
     */
    public function getSearchTv(string $query): ?array
    {
        $data = $this->callApi("search/tv", "&query=".$query);
        // var_dump($data['results']);
        foreach($data['results'] as $series) {
            $results[] = [
                'idSerie' => $series['id'], 
                'name' => $series['name'], 
                'nameOrigin' => $series['original_name'], 
                // 'dateDiff' => $series['first_air_date'], 
                'paysOrigin' => $series['origin_country'], 
                'poster' => $series['backdrop_path'], 

            ];

            // $results = [ 'series' => $data['results'] ]; 
        }
        return $results;
    }

    /**
     * Fonction pour appeler la liste des 20 séries populaire entre 1950 et 2009
     *
     * @return array|null
     */
    public function getPopularTv(): ?array
    {
        $data = $this->callApi("discover/tv", "&sort_by=popularity.desc&first_air_date.gte=1950-01-01&first_air_date.lte=2009-12-31&page=1&timezone=France%2FParis&include_null_first_air_dates=false");

        foreach($data['results'] as $series) {
            $results[] = [
                'nom' => $series['name'], 
                'nomOrigin' => $series['original_name'], 
                'idSerie' => $series['id'], 
                'poster' => $series['backdrop_path'], 
                'dateDiff' => date('d/m/Y', strtotime($series['first_air_date'])), 
                'paysOrigin' => $series['origin_country']
            ]; 
        }
        return $results;
    }

    /**
     * Fonction pour appeler la liste des séries populaires par décennies
     *
     * @param string $anneeDebut
     * @param string $anneeFin
     * @param integer $page
     * @return array|null
     */
    public function getListByYear(string $anneeDebut, string $anneeFin, int $page): ?array
    {
        $data = $this->callApi('discover/tv', '&sort_by=popularity.desc&first_air_date.gte='.$anneeDebut.'-01-01&first_air_date.lte='.$anneeFin.'-12-31&timezone=France%2FParis&include_null_first_air_dates=false&page='.$page);

        $results = [
            'page' => $data['page'], 
            'pagesTotales' => $data['total_pages'], 
            'results' => $data['results'] 
        ];

        return $results;
    }

    /**
     * Fonction pour appeler à la recherche de personnalités
     *
     * @param string $query
     * @return array|null
     */
    public function getSearchPerson(string $query): ?array
    {
        $data = $this->callApi('search/person', '&query='.$query);

        foreach($data['results'] as $person) {
            $results[] = [
                'nom' => $person['name'], 
                'id' => $person['id'], 
                'sexe' => $person['gender'], 
                'job' => $person['known_for_department'], 
                'profil' => $person['profile_path']
            ];
        }
        return $results;
    }

    /**
     * Fonction pour appeler la liste des peoples populaires
     *
     * @param integer $page
     * @return array|null
     */
    public function getPopularPerson(int $page): ?array
    {
        $data = $this->callApi("person/popular", "&page=".$page);

        $results = [
            // Acteurs
            'page' => $data['page'], 
            // Production/Réalisation
            'pagesTotales' => $data['total_pages'], 
            'results' => $data['results'] 
        ];

        return $results;
    }

    /**
     * Fonction pour appeler l'API
     *
     * @param string $startpoint
     * @param string $endpoint
     * @return array|null
     */
    private function callApi(string $startpoint, string $endpoint): ?array
    {
        $curl = curl_init('https://api.themoviedb.org/3/'.$startpoint.'?api_key='.$this->apiKey.'&language=fr-FR'.$endpoint);
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
