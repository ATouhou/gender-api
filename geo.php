<?php


/**
 * Check geo of a user's IP address and return it
 * Returns country code or false in the case of an unknown
 *
 * @return string
 */
function checkGeo($ip) {
    // Create params. don't get API_KEY if its empty in config.
    if (!empty($result = sendGet(config()['GEO_API'] . "/$ip/country"))) {
        return trim($result);
    }
    return false;
}
