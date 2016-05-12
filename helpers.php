<?php

/**
 * Get the User's IP Address utilizing all appropriate server variables
 *
 * @return string
 */
function getIP() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/**
 * Retrieve data from a GET request
 *
 * @return string
 */
function sendGet($url, $params=null) {
    // If there are params, prepare param_string
    $param_string = "";
    if ($params) {
        $count = 0;
        foreach($params as $key => $val) {
            $count == 0 ? $param_string .= "?$key=$val" : $param_string .= "&$key=$val";
            $count++;
        }
        $url .= $param_string;
    }
    $result = file_get_contents($url);
    $headers = parseHeaders($http_response_header);
    if ($headers['response_code'] = 200){
        return $result;
    } else {
        return "";
    }
}

/**
 * Check HTTP headers and report output
 *
 * @return int
 */
function parseHeaders($headers) {
    $head = array();
    foreach( $headers as $k=>$v )
    {
        $t = explode( ':', $v, 2 );
        if( isset( $t[1] ) )
            $head[ trim($t[0]) ] = trim( $t[1] );
        else {
            $head[] = $v;
            if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
                $head['response_code'] = intval($out[1]);
        }
    }
    return $head;
}


/**
 * Retrieve value from the config file
 *
 * @return array
 */
function config($key=null) {
    if (isset($key)) {
        $config = include "config.php";
        return $config->$key;
    }
    return include "config.php";
}

?>
