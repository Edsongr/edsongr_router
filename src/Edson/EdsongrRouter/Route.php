<?php 

/**
 * @author      Edson Oliveira <edsongrdeveloper@gmail.com>
 * @copyright   Copyright, 2024 EdsonGr 
 * @license     MIT 
 */

namespace Edson\EdsongrRouter;

require_once __DIR__ .'/Request.php';
require_once __DIR__ .'/Router.php';

class Route extends Router
{
 
    /**
     * Routes Collection
     * 
     * @var \Edson\EdsongrRouter\Router
     */
    public $route;

    /**
     * Request Collection
     * 
     * @var \Edson\EdsongrRouter\Request
     */
    public $request;

    /**
     * Namespace to Controller
     * 
     * @var string
     */
    protected $namespace = '\ESO\Demo';

    /**
     * Path
     * 
     * @var string
     */
    protected $serverBasePath = "/Projetos/PHP/EDSONGR_ROUTER/demo";
    /**
     * Run Class Route, Check if route exist
     * 
     * @return bool
     */
    public function run()
    {

        $processed = false;

        # Get Method
        $req = new Request();
        $method = $req->getMethodRequest();
   
        # Check exist Method in routes
        if (isset($this->uris[$method])) {

            $processed = $this->process($this->uris[$method]);

        }
      
        if (!$processed) {
            # Return route not found
            $this->error(404);
        }

        if ($method == 'HEAD') {
            ob_end_clean();
        }

        return $processed;
    }

    /**
     * Try Process Data
     * 
     * @param array $routes
     * @return bool
     */
    protected function process($routes)
    {

        $founded = false;

        $req = new Request();
        $uri_request = $req->getUriRequest($this->serverBasePath);
       
        foreach ($routes as $route) {

            $parameters = [];

            if ($route['uri'] !== '/') {
                
                $request_url = filter_var($uri_request, FILTER_SANITIZE_URL);
                $request_url = rtrim($request_url, '/');
                $request_url = strtok($request_url, '?');
                $request_url_parts = explode('/', $request_url);
              
                $route_parts = explode('/', $route['uri']);
                $new_route = "/";

                for ( $i = 0; $i < count($route_parts); $i++ ) {
    
                    $route_part = $route_parts[$i];
    
                    if ( preg_match("/^[$]/", $route_part) ) {
    
                        $route_part = ltrim($route_part, '$');
                 
                        $route_part = $request_url_parts[$i] ?? NULL;

                        array_push($parameters,  $route_part);
                           
                    }
                    else if( $route_parts[$i] != $request_url_parts[$i] ){
                      return;
                    } else if (!empty($route_parts[$i])) {
                        $new_route .= $route_parts[$i] . '/';
                    }

                }

                $route['uri'] = $new_route;
                $uri_request = $new_route;
            }
           
            # Check match route
            if ($this->checkMatch($route['uri'], $uri_request, $matched)) {

                # Call Method/Function/Controller 
                $this->invokeAction($route['action'] , $parameters);

                $founded = true; 
                break;
            }

        }

        return $founded;
    }

    /**
     * Check Match Route 
     * 
     * @param string $route
     * @param string $uri
     * @return bool
     */
    protected function checkMatch($route, $uri, &$matched)
    {

        # Replace curly braces 
        $route = preg_replace('/\/{(.*?)}/', '/(.*?)', $route); 

        return preg_match_all('#^' . $route . '$#', $uri, $matched, PREG_OFFSET_CAPTURE);
    }

    /**
     * Call Action method/function/Controller
     * 
     * @param string $action, 
     * @param array|null $parameters
     */
    public function invokeAction($action, $parameters)
    {
        
        # check if controller patterns 
        if (stripos($action, '@') !== false) {

            list($controller, $method) = explode('@', $action);
         
            # Check exist Namespace
            if ($this->namespace !== '') 
                $controller = $this->namespace . '\\' . $controller;
            
            try {

                $reflected = new \ReflectionMethod($controller, $method);

                # If exist mehot and is public and is not abstract
                if ($reflected->isPublic() && !$reflected->isAbstract()) {

                    if ($reflected->isStatic()) {

                        forward_static_call_array(array($controller, $method), $parameters);

                    } else {
                        
                        if (\is_string($controller)) 
                            $controller = new $controller();
                        
                        call_user_func_array(array($controller, $method), $parameters);
                    }
    
                }

            } catch (\ReflectionException $reflection) {
                # Controller or method is not available 
                $this->error(404);
            }

        }

    }

    /**
     * Error return code 
     * 
     * @param int $code
     */
    public function error($code)
    {
        http_response_code($code);
        exit();
    }

}
