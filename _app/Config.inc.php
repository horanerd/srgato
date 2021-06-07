<?php
//error_reporting(1);



define('HOME', 'https://localhost/srgato');
define('THEME', 'srgato');

define('INCLUDE_PATH', HOME . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes/' . THEME);

// CONFIGURAÇÕES DO SITE ###########
define ('HOST','localhost');
define ('USER','root');
define ('PASS','');
define ('DBSA','srgato');
// 
// AUTO LOAD DE CLASSES ###########
function MyAutoLoad($Class)
{
    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php') && !is_dir(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php')):
            include_once(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;
}

spl_autoload_register("MyAutoLoad");
    

    // TRATAMENTO DE ERROS ############
    //CSS constantes :: Mensagens de Erro
    
    define('WS_ACCEPT','accept');
    define('WS_INFOR','infor');
    define('WS_ALERT','alert');
    define('WS_ERROR','error');
    
    //WSErro :: Exibe erros lançados :: Front
    function WSErro($ErrMsg, $ErrNo, $ErrDie = null){
        $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
        echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";
        if ($ErrDie):
            die;
        endif;
    }
    
    //PHPErro :: personaliza o gatilho do PHP
    function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
        $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT  :  ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
        echo "<p class=\"trigger {$CssClass}\">";
        echo "<b>Erro na linha: {$ErrLine} :: </b> {$ErrMsg} <br>";
        echo "<small>{$ErrFile}</small>";
        echo "<span class=\"ajax_close\"></span></p>";
        
        if($ErrNo == E_USER_ERROR):
            die;
        endif;
}

set_error_handler('PHPerro');



$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url = explode('/', $setUrl);

$pg_name = 'SrGato';
$pg_keywords = '';
$pg_site = '';
$pg_google_author = '';
$pg_google_publisher = '';
$pg_google_analitics = 'UA-17457777-3';
$pg_fb_app = '';
$pg_fb_author = '';
$pg_fb_page = '';
$pg_twitter = '';
$pg_domain = '';
$pg_sitekit = INCLUDE_PATH . '/img/sitekit/';

switch ($Url[0]):
    case 'index':
        $pg_title = $pg_name;
        $pg_desc = '';
        $pg_image = $pg_sitekit . 'index.jpg';
        $pg_url = HOME;
        break;
    case 'lista':
        $pg_name = 'Lista de clientes';
        $pg_desc = '';
        $pg_image = $pg_sitekit . 'index.jpg';
        $pg_url = HOME;
        break;
    
    
    

    default :
        $pg_title = 'Desculpe, não encontrado o conteúdo relacionado.';
        $pg_desc = 'Você está vendo agora a página 404 pois não encontramos conteúdo relacionado à <b>' . $setUrl . '</b>, mas não saia ainda. Temos algumas dicas para te ajudar com sua pesquisa!';
        $pg_image = $pg_sitekit . '404.jpg';
        $pg_url = HOME . '/404';
        break;
endswitch;

