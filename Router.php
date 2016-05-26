<?php namespace Landscape;
    require_once("vendor/landscape/landscape.php.url/URLEngine.php");

    class Router
    {
        private $routes = [];
        public function __construct($r)
        {
            $this->routes = $r;
        }
        public function addRoute($pattern, $func)
        {
            $this->routes[] = Array($pattern, $func);
        }
        public function run($url)
        {
            $match = false;
            foreach($this->routes as $route)
            {
                $uEngine = new URLEngine($route[0]);
                $parse = $uEngine->parse($url);
                if($parse !== false)
                {
                    $route[1]($url, $parse);
                    $match = true;
                }
            }
            if(!$match)
                return false;
        }
    }

?>
