<?php 


function review_stars() {
    // Get any existing copy of our transient data
    if ( false === ( $rating = get_transient( 'review_stars' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
        $ch = curl_init();
        $api_key = 'AIzaSyB5WcqKqDHcUBsXBcRxrdduklBaZLM78Po';
        curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/details/json?place_id=ChIJb2jWOw_pq4ARamPSft2CGD4&fields=rating,user_ratings_total&key=' . $api_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_decode = json_decode($response);

        if (isset($response_decode->result)) {
            $rating['score'] = $response_decode->result->rating;
            $rating['count'] = $response_decode->result->user_ratings_total;
        } else {
            // Handle error response
            $rating['score'] = 0;
            $rating['count'] = 0;
        }

        // Set transient to expire in 24 hours
        set_transient( 'review_stars', $rating, 24 * HOUR_IN_SECONDS );
    }

    return $rating;
}

function get_reviews() {
    // Get any existing copy of our transient data
    if ( false === ( $reviews = get_transient( 'reviews' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
        $ch = curl_init();
        $api_key = 'AIzaSyB5WcqKqDHcUBsXBcRxrdduklBaZLM78Po';

        curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/details/json?place_id=ChIJb2jWOw_pq4ARamPSft2CGD4&fields=rating,user_ratings_total&key=' . $api_key);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_decode = json_decode($response);
        $reviews = $response_decode->result->reviews;

        // Set transient to expire in 24 hours
        set_transient( 'reviews', $reviews, 24 * HOUR_IN_SECONDS );
    } 

    return $reviews;
}

function display_random_reviews() {
    $reviews = get_reviews(); // assuming you have a function to get the reviews array
    $random_keys = array_rand($reviews, 3); // get two random keys from the reviews array

    foreach ($random_keys as $key) {
        $review = $reviews[$key]; // get the review object using the random key
        // format and display the review as needed
        echo '<div class="block-review">';
        echo '<div class="block-review__header d-flex align-items-center justify-content-between">';
        echo '<strong>'. $review->author_name . '</strong>';
        echo '<ul class="d-flex align-items-center">' . '<li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li><li><i class="fa-solid fa-star"></i></li>' .  '<strong>' . ($review->rating * 2) .  '</strong>' . '</ul>';
        echo '</div>';
        echo '<div class="block-review__content">';
        echo '<p>' . $review->text . '</p>';
        echo '</div>';
        echo '</div>';
    }
}
