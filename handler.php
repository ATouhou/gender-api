<?php
    include "geo.php";
    include "gender.php";
    include "helpers.php";

    /**
     * Utilizing APIs From:
     * ======================= Geographic Tracking - http://ipinfo.io =======================
     * 1,000 Daily Requests Rate Limited
     * $50/mo to Increase
     * ===================== Gender Tracking - https://api.genderize.io =====================
     * * 1,000 Daily Requests Rate Limited
     * * $9/mo to Increase
     */

    // Get request's location from IP Address
    $ip = getIP();
    if ($ip != "UNKNOWN") {
        $country = checkGeo(getIP());
    } else {
        $country = null;
    }

    // Check the user's gender.
    // TODO: Replace static string with name of user
    $gender = checkGender("kelly", $country);


    if ($gender == "male") {
        // Do what you want for males
    } elseif ($gender == "female") {
        // Do what you want for females
    } else {
        // Do what you want for an "undefined" or uncertain gender
    }
?>
