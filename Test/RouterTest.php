<?php namespace Test;
require_once('Router.php');
use Landscape\Router;

    global $called;
    $called = false;
    function show()
    {
        global $called;
        $called = true;
    }

    class RouterTest extends \PHPUnit_Framework_TestCase
    {
        public function testAddRoutes()
        {
            $arr = Array(["blogs/{var}/show", "show"]);
            $router = new Router($arr);
            $routes = $router->getRoutes();
            $this->assertEquals($arr, $routes);
            $router->addRoute("blogs/{var}/hide", "hide");
            $routes = $router->getRoutes();
            $this->assertEquals(Array(["blogs/{var}/show", "show"], ["blogs/{var}/hide", "hide"]), $routes);
        }

        public function testRun()
        {
            global $called;
            $arr = Array(["blogs/{var}/show", "Test\show"]);
            $router = new Router($arr);
            $router->run("blogs/1/show");
            $this->assertFalse($router->run("blogs/1/doSomething"));
            $this->assertTrue($called);
        }


    }

?>
