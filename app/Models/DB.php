<?php 

namespace Models;

class DB {
    public $db_host;
    public $db_name;
    private $db_user;
    private $db_passwd;

    public $conex;

    public $s = " * ";
    public $d="";
    public $w = " 1 ";
    public $j = "";
    public $o = "";
    public $l = "";
    

    public $r;

    function __construct($dbh="localhost",$dbn = "blogx"){
        $this->db_user = "root";
        $this->db_host = $dbh;
        $this->db_name = $dbn;
    }

    public function db_connect(){
        $this->conex = new \mysqli($this->db_host,$this->db_user,"",$this->db_name);
        $this->conex->set_charset("utf8");
        if($this->conex->connect_error){
            echo "Falló la conexión a la base de datos";
        }else{
            return $this->conex;
        }
    }

    public function select($cc = []){
        if(count($cc) > 0){
            $this->s = implode(",",$cc);
        }
        return $this;
    }
    

    public function join($join="",$on=""){
        if($join != "" && $on != ""){
            $this->j = ' join ' . $join . ' on ' . $on;
        }
        return $this;
    }

    public function where($ww = []){
        $this->w = "";
        if(count($ww) > 0 ){
            foreach($ww as $wheres){
                $this->w .= $wheres[0] . " like '" . $wheres[1] . "' " . ' and ';
            }
            $this->w .= ' 1 ';
        }
        return $this;
    }

    public function orderBy($ob=[]){
        $this->o = "";
        if(count($ob) > 0){
            foreach($ob as $orderBy){
                $this->o .= $orderBy[0] . ' ' . $orderBy[1] . ',';
            }
            $this->o = ' order by ' . trim($this->o,',');
        }
        return $this;
    }

    public function limit($l = ""){
        $this->l = "";
        if($l != ""){
            $this->l = ' limit ' . $l;
        }
        return $this;
    }

    public function get(){
        $sql =  "select " . $this->s .
                " from " . str_replace("Models\\","",get_class($this)) . " a " .
                $this->j .
                " where " . $this->w .
                $this->o .
                $this->l;
        //return json_encode($sql);

        $this->r = $this->table->query($sql);

        $result = [];

        while($f = $this->r->fetch_assoc()){
            $result[] = $f;
        }
        return \json_encode($result);
    }

    public function create(){

        $sql = 'insert into ' . str_replace("Models\\","",get_class($this)) . '(' . implode(",",$this->campos) . ') 
                values (' . trim(str_replace("&","?,",str_pad("",count($this->campos),"&")),",") . ')';
                
                // insert into posts (userId,title,body) values (?,?,?)

        $stmt = $this->table->prepare($sql);
        $stmt->bind_param(str_pad("",count($this->campos),"s"),...$this->valores);
        print_r($sql);
        return $stmt->execute();
               
    }
    //le tiene que llegar el campo que quiere modificarrrrr-
    public function delete($id){
        
        $d = ' DELETE FROM posts WHERE id = '. $id;
        $stmt = $this->table->prepare($d);
      
        
    return $stmt->execute();
    }
    

    public function edit($datosT,$datosB,$datosI){
        $update = " UPDATE posts SET title ='". $datosT."', body = '".$datosB."' WHERE id =".$datosI;
        $res = $this->table->query($update);
        
        //100%
    }


}   