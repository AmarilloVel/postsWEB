<?php 

    namespace Controllers\auth;

    use Models\user;

    class LoginController {

        public $sv;
        public $name;
        public $uid;
        public function __construct(){
            $this->sv = false;
        }

        public function userAuth($datos){

            $user = new user;
            $resultado = $user->where([["email",$datos["email"]],["passwd",$datos["passwd"]]])->get();
            if(count(json_decode($resultado)) > 0){
                /**registrar la sesion */
                return $this->sessionRegister($datos);
            }else{
                $this->sessionDestroy();
                echo json_encode(["r"=>false]);
            }

        }

        function sessionRegister($datos){
            \session_start();
            $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['email'] = $datos['email'];
            $_SESSION['passwd'] = $datos['passwd'];
            \session_write_close();
            return json_encode(["r"=>true]);
        }

        public function sessionValidate(){
            $u = new user;
            session_start();
            if(session_status() == PHP_SESSION_ACTIVE && count($_SESSION) > 0){
                $datos = $_SESSION;
                $resultado = $u->where([["email",$datos["email"]],["passwd",$datos["passwd"]]])->get();
                if(count(json_decode($resultado)) > 0 && $datos['IP'] == $_SERVER['REMOTE_ADDR']){
                    session_write_close();
                    $this->sv = true;
                    $this->name = json_decode($resultado)[0]->name;
                    $this->uid = json_decode($resultado)[0]->id;
                    return $resultado;
                }
            }else{
                session_write_close();
                $this->sessionDestroy();
                return null;
            }
        }

        public function userLogout(){
            $this->sessionDestroy();
            return;
        }

        function sessionDestroy(){
            session_start();
            $_SESSION = [];
            session_destroy();
            session_write_close();
            $this->sv = false;
            $this->name = "";
            $this->uid = "";
            return;
        }

    }