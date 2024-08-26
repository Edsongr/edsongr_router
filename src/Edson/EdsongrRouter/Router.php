<?php 

namespace Edson\EdsongrRouter;

class Router 
{

    /**
     * Verbs supported by the router
     * 
     * @var array
     */
    protected static $verbs = ['HEAD', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    /**
     * Registered URI values 
     * 
     * @var array
     */
    public $uris = [];

    /**
     * GET route registration
     * 
     * @param string $uri 
     * @param string|null $action
     */
    public function get($uri, $action = null)
    {
        return self::add(['GET', 'HEAD'], $uri, $action);
    }

    /**
     * POST route registration 
     * 
     * @param string $uri 
     * @param string|null $action
     */
    public function post($uri, $action = null)
    {
        return self::add('POST', $uri, $action);
    }

    /**
     * PUT route registration 
     * 
     * @param string $uri
     * @param string|null $action
     */
    public function put($uri, $action = null)
    {
        return self::add('PUT', $uri, $action);
    }

    /**
     * PATCH route registration 
     * 
     * @param string $uri
     * @param string|null $action
     */
    public function patch($uri, $action = null)
    {
        return self::add('PATCH', $uri, $action);
    }

    /**
     * DELETE route registration 
     * 
     * @param string $uri
     * @param string|null $action
     */
    public function delete($uri, $action = null)
    {
        return self::add('DELETE', $uri, $action);
    }

    /**
     * OPTIONS route registration 
     * 
     * @param string $uri
     * @param string|null $action
     */
    public function options($uri, $action = null)
    {
        return self::add('OPTIONS', $uri, $action);
    }

    /**
     * ANY route registration 
     * 
     * @param string $uri 
     * @param string|null $action 
     */
    public function any($uri, $action = null)
    {
        return $this->add(self::$verbs, $uri, $action);
    }

    /**
     * Add new Route
     * 
     * @param array|string $methods
     * @param string $uri
     * @param string|null $action 
     * 
     * @return bool
     */
    protected function add($methods, $uri, $action) 
    {

        if (!is_array($methods)) {

            $this->uris[$methods][] = [
                "uri" => $uri,
                "action" => $action
            ];

        } else {

            foreach ($methods as $method) {

                $this->uris[$method][] = [
                    "uri" => $uri,
                    "action" => $action
                ];

            }

        }

        return true;
    }

}
