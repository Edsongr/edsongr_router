<?php 

namespace Edson\EdsongrRouter;

class Request
{

    /**
     * Get Headers
     * 
     * @return array
     */
    public static function getHeadersRequest()
    {
        
        $headers = [];

        # If exist method getallheaders() 
        if (function_exists('getallheaders')) {

            $headers = getallheaders();

            # Check if not returned false 
            if ($headers !== false)
                return $headers; 
            }

            # If returnd false, get data server with loop 
            foreach ($_SERVER as $key => $value) {

                if (
                    substr($key, 0, 5) == "HTTP_" || 
                    $key == "CONTENT_TYPE" || 
                    $key == "CONTENT_LENGTH"
                ) {

                    $string = ucwords(strtolower(str_replace('_', ' ', substr($key, 5))));
                    $k_header = str_replace([' ', 'Http'], ['-', 'HTTP'], $string);
                    $headers[$k_header] = $value;

                }

            }
        
        return $headers;
    }

    /**
     * Get Method 
     * 
     * @return string
     */
    public static function getMethodRequest()
    {
       
        $method = $_SERVER['REQUEST_METHOD'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_start();
            $method = 'GET';
        }
     
        return $method;
    }

    public static function getUriRequest($serverBasePath)
    {

        $uri_request = substr(rawurldecode($_SERVER['REQUEST_URI']), strlen($serverBasePath));

        if (strstr($uri_request, '?')) {
            $uri_request = trim(substr($uri_request, 0, strpos($uri_request, '?')));
        }
      
        return "{$uri_request}";
    }

}
