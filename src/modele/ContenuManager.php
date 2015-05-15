<?php

class ContenuManager
{

    protected $table = 'contenu';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        if (is_null($this->pdo)) {
            throw new Exception('pas de connexion');
        }
    }

    /**
     * all() retourne l'ensemble des enregistrements de la table users
     * 
     * @return \User
     */
    public function all()
    {
        $c = [];

        $query = sprintf('
                SELECT *
                FROM `%s` ', $this->table
        );

        $q = $this->pdo->query($query);
        while ($c[] = $q->fetch(\PDO::FETCH_OBJ));
        array_pop($c);
        return $c;
    }

    /**
     * find retourne un enregistrement
     * 
     * @return \User
     */
    public function find($id)
    {
        $c = [];
        $query = sprintf("
                SELECT *
                FROM `{$this->table}` 
                WHERE id=%d", $id
        );
        // gestion des erreurs PDOException
        $q = $this->pdo->query($query);

        while ($c[] = $q->fetch(\PDO::FETCH_OBJ));
        array_pop($c);
        return $c;
    }

    /**
     * 
     * save object User
     * 
     * @param Object 
     * @return boolean
     * @throws PDOException
     */
    public function save(Post $post)
    {

        $query = sprintf("
                INSERT INTO `{$this->table}` (title, user_id, content, date_created, status  )
                VALUES ('%s', %d, '%s')
                ", $post->title, $post->user_id, $post->content, $post->date_created, $post->status
        );

        return $this->pdo->query($query);
    }

    /**
     * <pre> return posts user</pre>
     * 
     * @param string $status
     * @return array
     */
    public function postsUser($status = 'publish')
    {
        $results = [];
       
        $query = sprintf("
                 SELECT p.id, p.title, u.username, p.user_id, p.excerpt
                 FROM `%s` as p 
                 INNER JOIN `users` as u 
                 ON p.user_id = u.id
                 WHERE status='%s';
            ", $this->table, $status
        );

        $stmt = $this->pdo->query($query);

        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $results[] = $data;
        }
        return $results;
    }

    
    public function page($pag)
    {
//           $query = sprintf("
//                 SELECT p.id, p.title,p.content
//                 FROM `%s` as p 
//                 WHERE status='publie' and title='%s';
//            ", $this->table, $pag
//        );
          $query="SELECT * FROM `contenu` WHERE `title`=:page  ;";
        $res = $this->pdo->prepare($query);
        $res->execute(array(':page'=>$pag));
               
        while ($data = $res->fetch(PDO::FETCH_OBJ)) {
             $results[] = $data;
           
        }
      
      return $results;
 
    }
}
