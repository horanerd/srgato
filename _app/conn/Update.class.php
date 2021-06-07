<?php
/**
 * <b>Update.class</b>
 * Classe Responsável por atualizações genéticos no banco de dados!
 * 
 * @copyright (c) 2016, Guilherme De Sousa, HORANERD SOLUÇÃO EM INFORMATICA
 */
class Update extends Conn{
    
    private $Tabela;
    private $Dados;
    private $Termos;
    private $Places;
    private $Result;
    
    
    /** @var PDOStatement */
    
    private $Update;
    
    /** @var PDO */
    private $Conn;
    // metodo utilizado para fazer a leitura dos dados
    public function ExeUpdate($Tabela, array $Dados, $Termos, $ParseString){
     $this->Tabela = (string) $Tabela;
     $this->Dados = $Dados;
     $this->Termos = (string) $Termos;
     
     parse_str($ParseString, $this->Places);
     $this->getSyntax();
     $this->Execute();
     
     parse_str($ParseString, $this->Places);
    }
    
    
    // exibe os resultados
    public function getResult(){
      return $this->Result;
    }
    // conta quantos cadastros existem
    public function getRowCount() {
      return $this->Update->rowCount();
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
        $this->Update = $this->Conn->prepare($this->Update);
    }
    
 // obtem a syntaxe
    private function getSyntax() {
        foreach ($this->Dados as $Key => $Value):
            $Places[] = $Key . ' = :' . $Key;
        endforeach;
        $Places = implode(', ', $Places);
        $this->Update = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
    }
    
// realiza suporte a conexão
    private function Execute() {
        $this->Connect();
        try {
            $this->Update->execute(array_merge($this->Dados, $this->Places));
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }
}
