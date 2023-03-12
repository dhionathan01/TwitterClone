<? 
    namespace App\Models;

    use DHF\Model\Model;


class Tweet extends Model{
    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function salvar(){
        $sql = "INSERT INTO 
                    tweets
                    (
                        id_usuario,
                        tweet
                    )values
                    (
                        :id_usuario,
                        :tweet
                        )";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->execute();


    }

    // recuperar

    public function getALL(){
        $sql = "SELECT 
                   t.id,
                   t.id_usuario,
                   u.nome,
                   t.tweet,
                   DATE_FORMAT(t.data, '%d/%m/%Y %H:%i') as data
                FROM 
                    tweets as t
                    LEFT JOIN 
                        usuarios as u
                    ON (t.id_usuario = u.id)
                WHERE
                    id_usuario = :id_usuario
                    or t.id_usuario in
                    (
                        SELECT
                            id_usuario_seguindo
                        FROM 
                            usuarios_seguidores
                        WHERE id_usuario = :id_usuario
                    )
                ORDER BY 
                    t.data desc";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>