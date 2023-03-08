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
            $usuarios = $usuario->getAll();
        }
        $this->view->usuarios = $usuarios;
        $this->render('quemSeguir');
    }
}

?>