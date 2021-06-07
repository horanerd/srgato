<?php
/**
 * Upload.class [HELPER]1
 *Reponsável por executar upload de imagens, arquivos e mídias no sistema!
 * @copyright (c) 2016, Guilherme De Sousa, HORANERD SOLUÇÃO EM INFORMATICA
 */
class Upload{
   
    private $File;
    private $Name;
    private $Send;
    
    /** IMAGE UPLOAD */
    private $Width;
    private $Image;
    
    /** RESULTSET */
    private $Result;
    private $Error;
    
    /** DIRETÓRIOS */
    private $Folder;
    private static $Basedir;
    
    /**
     * Verifica e cria o diretório padrão de uploads no sistema! <br>
     * <b>../uploads/</b>
     */
    
    function __construct($BaseDir = null) {
        self::$Basedir = ((string) $BaseDir ? $BaseDir : 'uploads/');
        if(!file_exists(self::$Basedir) && !is_dir(self::$Basedir)):
            mkdir(self::$Basedir, 0777);
        endif;
    }
    
    /**
     * <b>Envia Imagem:</b> Basta envelopar um $_FILES de uma imagem e caso queira um nome e largura personalizado.
     * Caso não informe a largura será 1024!
     * @param FILES $Image = Envia envelope de $_FILES
     * @param STRING $Name = Nome da imagens ( ou do artigo )
     * @param INT $Width = Largura da imagem ( 1024 padrão )
     * @param STRING $Folder = Pasta personalizada
     */
    
    public function Image(array $Image, $Name = null, $Width = null, $Folder = null){
            $this->File =  $Image;
            $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
            $this->Width = ((int) $Width ? $Width : 1024);
            $this->Folder = ((string) $Folder ? $Folder : 'images');
            
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->UploadImage();
    }
    
    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $File;
        $this->Name = ((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ((string) $Folder ? $Folder : 'files');
        $MaxFileSize  = ((int) $MaxFileSize ? $MaxFileSize : 5 );
        $FileAccept = [
               'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
               'application/pdf'
        ];
        
        if($this->File['size'] > ($MaxFileSize * (1024*1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif(!in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo não suportado. Envie .PDF ou .DOCX!';
        else:  
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
        
    }
    
        public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ((string) $Folder ? $Folder : 'medias');
        $MaxFileSize  = ((int) $MaxFileSize ? $MaxFileSize : 40);
        $FileAccept = [
               'audio/mp3',
               'video/mp4', 'audio/wav'
        ];
        
        if($this->File['size'] > ($MaxFileSize * (1024*1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif(!in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo não suportado. Envie audio MP3 ou vídeo MP4!';
        else:  
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
        
    }
    
    /**
     * <b>Verifica Upload:</b> Executando um getResult é possível verificar se o Upload foi executado ou não.
     * uma string com o caminho e nome do arquivo ou FALSE
     * @return STRING = Caminho e Nome do arquivo ou False
     */
    
    function getResult() {
        return $this->Result;
    }
    /**
     * <b>Obter Erro: </b> Retorna um array associativo com um code, um title, um erro e um tipo.
     * @return Array $error = Array associatico com o erro
     */
    
    function getError() {
        return $this->Error;
    }

        
    /**
     * ****************************************
     * ********** PRIVATE METHODS *************
     * ****************************************
     */
    
    
    
    //Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
    private function CheckFolder($Folder){
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }
    
    //Verifica e cria o diretório base!
    private function CreateFolder($Folder){
        if(!file_exists(self::$Basedir . $Folder) && !is_dir(self::$Basedir .$Folder)):
            mkdir(self::$Basedir . $Folder, 0777);
        endif;
    }
    
    //Verifica e monta o nome dos arquivos tratando a string!
    private function setFileName(){
        $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');
        if(file_exists(self::$Basedir . $this->Send . $FileName)):
           $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
        
        endif;
        $this->Name = $FileName;
    }
    
    //Realiza o upload de imagens redimencionando a mesma!
    
    private function UploadImage() {
        
        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;
        
        if(!$this->Image):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
        else:
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);
            $ImageX = ($this->Width < $x ? $this->Width : $x);
            $ImageH = ($ImageX * $y) / $x;
            
            $NewImage = imagecreatetruecolor($ImageX, $ImageH);
            imagealphablending($NewImage, false);
            imagesavealpha($NewImage, true);
            imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);
            
            switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($NewImage, self::$Basedir . $this->Send . $this->Name);
                break;
            case 'image/png':
            case 'image/x-png':
                imagepng($NewImage, self::$Basedir . $this->Send . $this->Name);
                break;
            endswitch;
            
            if(!$NewImage):
                $this->Result = FALSE;
                $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
                else:
                    $this->Result = $this->Send . $this->Name;
                    $this->Error = null;
            endif;
            imagedestroy($this->Image);
            imagedestroy($NewImage);
        endif;
        
    }
   //Envia arquivos e mídias
    public function MoveFile(){
     if(move_uploaded_file($this->File['tmp_name'], self::$Basedir . $this->Send . $this->Name)):
        $this->Result = $this->Send . $this->Name;
        $this->Error = null;
     else:
        $this->Result = false;
        $this->Error = 'Erro ao mover o arquivo. Favor tente mais tarde';
     endif;   
    }
}