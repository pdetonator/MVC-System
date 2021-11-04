<?php

    namespace UNLCE\Router;

    class Router {

        private static $patterns = [
            ':id' => '([0-9]+)',
            ':name' => '([a-zA-Z]+)'
        ];
        public static $isNotFound = true;

        public static function requestUri() 
        {
            $items = [dirname($_SERVER['SCRIPT_NAME']), basename($_SERVER['SCRIPT_NAME'])];
            $requestUri = str_replace($items, '', $_SERVER['REQUEST_URI']);

            return $requestUri;
        }
        private static function call($url, $callback) 
        {
            $requestUri = self::requestUri();
            $url = str_replace(array_keys(self::$patterns), array_values(self::$patterns), $url);

            if (preg_match('@^' . $url . '$@', $requestUri, $params)) {
                array_shift($params);

                if (is_callable($callback)) call_user_func_array($callback, $params);
                else {
                    $controller = explode('@', $callback);
                    $controllerFile = __DIR__ . './../../controllers/' . strtolower($controller[0]) . '.php';

                    if (file_exists($controllerFile)) {
                        require $controllerFile;
                        call_user_func_array([new $controller[0], $controller[1]], $params);
                    }
                }
                self::$isNotFound = false;
                exit;
            }else {
                self::$isNotFound = true;
            }
        }
        public static function run($url, $callback, $method = ['GET']) 
        {
            if (in_array($_SERVER['REQUEST_METHOD'], $method)) {
                $requestUri = self::requestUri();
                $url = str_replace(array_keys(self::$patterns), array_values(self::$patterns), $url);

                self::call($url, $callback);
            }
        }
        public static function error($callback) 
        {
            if (self::$isNotFound) {
                call_user_func($callback);
            }
        }

    }

?>