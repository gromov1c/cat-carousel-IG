<?php
include_once('config/config.php');


function getCatBreeds() {
    $api_url = 'https://api.thecatapi.com/v1/breeds';

    $ch = curl_init($api_url);

    $headers = [
        'x-api-key: ' . API_KEY,  
    ];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    $breeds = json_decode($response, true);

    if ($breeds === null) {
        echo 'Error decoding JSON response.';
        return false;
    }

    return $breeds;
}

define('CAT_API_URL', 'https://api.thecatapi.com/v1');

function makeApiRequest($url) {
    $response = file_get_contents($url);

    if ($response !== false) {
        return json_decode($response, true); 
    }
    return null;
}

function getCatBreedDetails($breedId) {
    $url = CAT_API_URL . "/images/search?breed_ids={$breedId}&api_key=" . API_KEY;
    
    $breedData = makeApiRequest($url);
    
    if ($breedData && isset($breedData[0]['breeds'][0])) {
        $breed = $breedData[0]['breeds'][0]; 

        return [
            'name' => isset($breed['name']) ? $breed['name'] : 'Unknown',
            'temperament' => isset($breed['temperament']) ? $breed['temperament'] : 'Unknown',
            'origin' => isset($breed['origin']) ? $breed['origin'] : 'Unknown',
            'description' => isset($breed['description']) ? $breed['description'] : null,
            'affection_level' => isset($breed['affection_level']) ? $breed['affection_level'] : null, 
            'energy_level' => isset($breed['energy_level']) ? $breed['energy_level'] : null, 
            'dog_friendly' => isset($breed['dog_friendly']) ? $breed['dog_friendly'] : null, 
            'health_issues' => isset($breed['health_issues']) ? $breed['health_issues'] : null 
        ];
    }

    return null; 
}


function getCatImages($breedId) {
    $url = CAT_API_URL . "/images/search?breed_ids={$breedId}&limit=10&api_key=" . API_KEY;

    $imagesData = makeApiRequest($url);
    
    if ($imagesData) {
        $images = [];
        foreach ($imagesData as $image) {
            $images[] = ['url' => $image['url']];
        }
        return $images;
    }

    return []; 
}

function getStarRating($rating) {
    $rating = (int) $rating;
    $starHTML = '';

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $starHTML .= '<i class="fa-solid fa-star"></i>';
        } else {
            $starHTML .= '<i class="fa-regular fa-star"></i>';
        }
    }

    return '<span class="rating">' . $starHTML . '</span>';
}
?>

