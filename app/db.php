<?php
    class db 
    {
        public $pdo;
        private $db;
        private $user;
        private $pass;
        //private $port;
        private $tbl;
        public function __construct( $db='phonebook_tbl' , $user = 'root' , $pass = '' )
        {
           
            $this->db = $db ;
            $this->user = $user ;
            $this->pass = $pass ;
            // $this->port = $port;//  3308
            $this->connection();
        }

        public function connection()
        {
            try
            {
                $this->pdo = new PDO("mysql:host=localhost;port=3308;dbname={$this->db}", $this->user, $this->pass);
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        public function set_tbl($a)
        {
            $this->tbl=$a;
        }



        public function select_data($data)
        {
            if(is_array($data))
            {
                $names = implode("," , $data);
                //var_dump($data);die;
                $stm = $this->pdo->prepare("SELECT {$names} FROM {$this->tbl}");

            }
            else{

                $stm = $this->pdo->prepare("SELECT {$data} FROM {$this->tbl}");
            }
            //var_dump($stm);
            $stm->execute();
            $row = $stm->fetchAll(PDO::FETCH_OBJ);
            return $row;
        }


        public function insertData($filds,$data)
        {
            if(is_array($data)){
                $values="'" .implode("','", $data)."'" ;
                $filds=implode(",", $filds);
                $sql=$this->pdo->prepare("insert into {$this->tbl} ({$filds}) VALUES ({$values})");
                //var_dump($sql);die;
                $sql->execute();
            }
        }

        public function edit_data($field , $data , $id)
        {

            for($i=0 ; $i < count($field) ; $i++)
            {
                $txt[$i] = $field[$i]."='".$data[$field[$i]]."'";
            }
            //var_dump($data);die;
            $query = implode(",",$txt);
            $sql=$this->pdo->prepare("UPDATE {$this->tbl} set ".$query."where id = '$id'");
            $sql->execute();

        }


        public function delete_data($id)
        {
            $sql = $this->pdo->prepare("delete from {$this->tbl} where id = '$id'");
            $sql->execute();
        }

        public function search_data($name , $value)
        {
            $sql = $this->pdo->prepare("SELECT * FROM {$this->tbl} where $name = '$value'");
            //var_dump($sql);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        public function like_data($name , $value)
        {
            $sql = $this->pdo->prepare("SELECT * FROM {$this->tbl} where $name LIKE '%$value%'");
            $sql->execute();
            $results = $sql->fetchAll(PDO::FETCH_OBJ);
            return $results;
        }

        public function show_edit_data($id)
        {
            $sql = $this->pdo->prepare("SELECT * FROM {$this->tbl} where id ='$id'");
            $sql->execute();
            $results = $sql->fetch(PDO::FETCH_ASSOC);
            return $results;
        }

        public function salam($id)
        {
            echo "$id";
        }

    }

    // $obj = new db();
    // $obj->set_tbl('user_tbl');
    // $a = $obj->search_data("email","admin");
    // var_dump($a);
    // //$obj->insertData(['name','lastname','email'],['mahdi','yoosefi','mahdi@zlatan.com']);
    // $obj->edit_data(['name','lastname','email'],['sajjad','qarehdaqi','sajad_qr@zlatan.com'] , 2);
?>