<? 
namespace App\Controllers;

// Recursos do Framework
use DHF\Controller\Action;
use DHF\Model\Container;

class AppController extends Action {
    public function timeline(){
        session_start();
        if(!empty($_SESSION['id']) AND !empty($_SESSION['nome'])){

            $this->render('timeline');
        }else{
            header('Location: /?login=erro');
        }
    }
}

?>