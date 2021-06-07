<?php
/**
 * <b>Read.class</b>
 * Classe Responsável por Leitura genéticos no banco de dados!
 * 
 * @copyright (c) 2016, Guilherme De Sousa, HORANERD SOLUÇÃO EM INFORMATICA
 */
class Read extends Conn{
    
    private $Select;
    private $Places;
    private $Result;
    
    
    /** @var PDOStatement */
    
    private $Read;
    
    /** @var PDO */
    private $Conn;
    // metodo utilizado para fazer a leitura dos dados
    public function ExeRead($Tabela, $Termos = null, $ParseString = null){
        if(!empty($ParseString)):
            parse_str($ParseString, $this->Places);
        endif;
        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
        $this->Execute();
    }
    
    public function getContent($cont){
        $this->Execute();
        $cont = $this->Read;
    }


    // exibe os resultados
    public function getResult(){
        return $this->Result;
    }
    // conta quantos cadastros existem
    public function getRowCount() {
        return $this->Read->rowCount();
    }
    // utilizada para definir manualmente parametros de busca
    public function FullRead($Query, $ParseString = null) {
        
        $this->Select = (string) $Query;
        
        if(!empty($ParseString)):
            parse_str($ParseString, $this->Places);
        endif;
            $this->Execute();
    }
    // utilizado para modificar parametros de busca
    public function setPlace($ParseString) {
        parse_str($ParseString, $this->Places);
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
        $this->Read = $this->Conn->prepare($this->Select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }
    
 // obtem a syntaxe
    private function getSyntax() {
        if($this->Places):
        foreach ($this->Places as $Vinculo => $Valor):
            if($Vinculo == 'limit' || $Vinculo == 'offset'):
                $Valor = (int) $Valor;
            endif;
            $this->Read->bindValue(":{$Vinculo}", $Valor, (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
        endforeach;
        endif;
    }
    
// realiza suporte a conexão
    private function Execute() {
        $this->Connect();
        try{
            $this->getSyntax();
            $this->Read->Execute();
            $this->Result = $this->Read->fetchAll();
          } catch (Exception $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }
}
