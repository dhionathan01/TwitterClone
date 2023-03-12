<? 
namespace App\Controllers;

// Recursos do Framework
use DHF\Controller\Action;
use DHF\Model\Container;

class AppController extends Action {
    public function timeline(){
        $this->validaAutenticacao();
        // recuperação de tweet
        $tweet = Container::getModel('tweet');
        $tweet->__set('id_usuario', $_SESSION['id']);
        $tweets = $tweet->getAll();

        $this->view->tweets = $tweets;
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);
        $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguindo = $usuario->getTotalSeguindo();
        $this->view->total_seguidores = $usuario->getTotalSeguidores();

        $this->render('timeline');
    }

    public function tweet(){
            $this->validaAutenticacao();
            $tweet = Container::getModel('Tweet');

            $tweet->__set('tweet', $_POST['tweet']);
            $tweet->__set('id_usuario', $_SESSION['id']);

            $tweet->salvar();

            header('Location: /timeline');
    }
    public function validaAutenticacao(){
        session_start();
        if(empty($_SESSION['id']) OR !isset($_SESSION['id']) OR  empty($_SESSION['nome']) OR !isset($_SESSION['nome'])){
            header('Location: /?login=erro');
        }

    }

    public function quem_seguir(){
        $this->validaAutenticacao();
        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
        $usuarios = array();
        if($pesquisarPor != ''){
            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $pesquisarPor);
            $usuario->__set('id', $_SESSION['id']);
            $usuarios = $usuario->getAll();
        $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguindo = $usuario->getTotalSeguindo();
        $this->view->total_seguidores = $usuario->getTotalSeguidores();
        }else{
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);
        $this->view->info_usuario = $usuario->getInfoUsuario();
        $this->view->total_tweets = $usuario->getTotalTweets();
        $this->view->total_seguindo = $usuario->getTotalSeguindo();
        $this->view->total_seguidores = $usuario->getTotalSeguidores();
        }
        $this->view->usuarios = $usuarios;
        $this->render('quemSeguir');
    }

    public function acao(){
        $this->validaAutenticacao();
        //acao
       //id_usuario
       exibirArray($_GET);
       $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
       $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
       $usuario = Container::getModel('Usuario');
       $usuario->__set('id', $_SESSION['id']);
       
       if($acao == 'seguir'){
        $usuario->seguirUsuario($id_usuario_seguindo);
       }else if ($acao == 'deixar_de_seguir'){
        $usuario->deixarSeguirUsuario($id_usuario_seguindo);
       }
       header('Location: /quem_seguir');
    }
}

?>