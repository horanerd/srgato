<?php
/**
 * <b>Create.class</b>
 * Classe Responsável por cadastros genéticos no banco de dados!
 * 
 * @copyright (c) 2016, Guilherme De Sousa, HORANERD SOLUÇÃO EM INFORMATICA
 */
class Create extends Conn{
    
    private $Tabela;
    private $Dados;
    private $Result;
    
    
    /** @var PDOStatement */
    
    private $Create;
    
    /** @var PDO */
    private $Conn;
    /**
     * <b>ExeCreate:</b> Executa um castro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com nome da coluna e valor!
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array atribuitivo. (Nome Da Coluna => Valor).
     */
    public function ExeCreate($Tabela, array $Dados){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->getSyntax();
        $this->Execute();
    }
    
    
    // exibe os resultados do banco de dados
    public function getResult(){
        return $this->Result;
    }






    /**
     * ****************************************
     * ********** PRIVATE METHODS *************
     * ****************************************
     */
    
    //conecta com o banco de dados PDO
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }
    
    // obtem os dados da synstaxe
    private function getSyntax() {
        $Fileds = implode(',', array_keys($this->Dados));
        $Places = ':' . implode(',:', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }
    
    // execulta a conexão entre os dados e o banco    
    private function Execute() {
        $this->Connect();
        try{
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (Exception $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }
}
