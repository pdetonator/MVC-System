<?php 

    namespace UNLCE\Controller;

    class Controller {
        
        public function view($viewName, $data = array()) 
        {
            $viewFile = __DIR__ . '/../../views/' . strtolower($viewName) . '.php';

            if ($viewFile) {
                extract($data);
                require $viewFile;
            }
        }
        public function model($modelName) 
        {
            $modelFile = __DIR__ . '/../../models/' . strtolower($modelName) . '.php';
            
            if (file_exists($modelFile)) {
                require $modelFile;
                return new $modelName;
            }
        }
    }

?>