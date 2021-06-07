<?php
/**
 * <b>Delete.class</b>
 * Classe Responsável por Deletar genéricamente dados no banco de dados!
 * 
 * @copyright (c) 2016, Guilherme De Sousa, HORANERD SOLUÇÃO EM INFORMATICA
 */
class Delete extends Conn{
    
    private $Tabela;
    private $Termos;
    private $Places;
    private $Result;
    
    
    /** @var PDOStatement */
    
    private $Delete;
    
    /** @var PDO */
    private $Conn;
    // metodo utilizado para fazer a leitura dos dados
    public function ExeDelete($Tabela,  $Termos, $ParseString){
     $this->Tabela = (string) $Tabela;
     $this->Termos = (string) $Termos;
     
     parse_str($ParseString, $this->Places);
     $this->getSyntax();
     $this->Execute();
    }
    
    
    // exibe os resultados
    public function getResult(){
      return $this->Result;
    }
    // conta quantos cadastros existem
    public function getRowCount() {
      return $this->Delete->rowCount();
    }
    // utilizado para modificar parametros de busca
    public function setPlace($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
        
    }



    /**
     * ****************************************
     * ********** PRIVATE METHODS *************
     * ****************************************
     */
    
// obtem conexão com o banco de dados PDO
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Delete = $this->Conn->prepare($this->Delete);
    }
    
 // obtem a syntaxe
    private function getSyntax() {
        $this->Delete = "DELETE  FROM {$this->Tabela} {$this->Termos}";
    }
    
// realiza suporte a conexão
    private function Execute() {
        $this->Connect();
        try{
         $this->Delete->execute($this->Places);  
         $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao Deletar:</b> {$e->getMessage()}", $e->getCode());
        }
    }
}
