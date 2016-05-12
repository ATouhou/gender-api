<?php


/**
 * Check gender of a user's name and return it.
 * Return "male" or "female" unless the accuracy provided
 * is below the threshold in the config, in which it returns false
 *
 * @return string
 */
function checkGender($name, $country=null) {
    // Create params. don't get API_KEY if its empty in config.
    !empty(config()['GENDER_API_KEY']) ? $params = array("name" => $name, "country_id" => $country, "key" => config()['GENDER_API_KEY']) : $params = array("name" => $name, "country_id" => $country);
    if (!empty($result = json_decode(sendGet(config()['GENDER_API'], $params)))) {
        if (isset($result->probability) && $result->probability > config()["ACCURACY_THRESHOLD"])
            return $result->gender;
    }
    return false;
}

?>
