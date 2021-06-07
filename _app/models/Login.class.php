<?php



/**
 * Login.class [ MODEL]
 * Responsável por autentica, validar, e checar usuário do sistema de login!
 *
 * @copyright (c) 2016, Guilherme De Sousa, HORANERD SOLUÇÃO EM INFORMATICA
 */
class Login {
    
    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;
    
    public function ExeLogin(array $UserData) {
        $this->Email = (string) $UserData ['user'];
        $this->Senha = (string) $UserData['pass'];
        $this->setLogin();
    }
    
    function getError() {
        return $this->Error;
    }
    
    public function CheckLogin(){
        if(empty($_SESSION['userlogin'])):
            unset($_SESSION['userlogin']);
            return false;
            else:
                return true;
        endif;
    }

    function getResult() {
        return $this->Result;
    }

        
    //private
    
    private function setLogin() {
        if(!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe seu E-mail e senha para efetuar o login!', WS_ALERT ];
        elseif(!$this->getUser()):
            $this->Error = ['Os dados informados não são compatíveis!', WS_ALERT ];
        else:
            $this->Execute();
        endif;
            
            
    }
        
    
    private function getUser() {
        $read = new Read;
        $read ->ExeRead("users", "WHERE email = :e AND senha = :p", "e={$this->Email}&p={$this->Senha}");
        if($read->getResult()):
            //$this->Result = $read->getResult()[0];
            //echo "funcionou";
            return true;
        else:
            return false;
        endif;
    }
    private function Execute() {
        $_SESSION['logado'] = $this->Result;
        $this->Result = true;
    }
}
