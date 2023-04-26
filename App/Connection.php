<? 
namespace App;

class Connection{
    public static function getDb(){
        try{
            // Como estamos usando os namespace para transitar, e o PDO � um objeto padr�o do php, temos que referenciar ele no diret�rio raiz. Basta colocar  \  antes do seu nome
            $connection = new \PDO(
                "mysql:host=sql110.epizy.com;dbname=epiz_33999327_twitter;charset=utf8",
                "epiz_33999327",
                "HaTu3z265OkfR"
                
        );
        return $connection;
        }catch(\PDOException $erroBd){

        }
    }
}
?>