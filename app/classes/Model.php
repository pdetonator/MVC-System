<?php 

    namespace UNLCE\Model;

    use PDO;
    use PDOException;

    class Model {
        
        protected $db;

        public function __construct()
        {
            try {
                $this -> db = new PDO('mysql:host=localhost;dbname=deneme', 'root', '');
            }catch (PDOException $t) {
                die($t -> getMessage());
            }
        }
        public function __destruct()
        {
            $this -> db = null;
        }

    }

?>