<?php
  class cListPoint {
    public $id;
    public $list_id;
    public $content;
    public $checked;

    public function __construct($id, $list_id, $content, $checked) {
      $this->id       = $id;
      $this->list_id  = $list_id;
      $this->content  = $content;
      $this->checked  = $checked;
    }

    public static function all($parent_id, $checked = NULL) {
      $list_of_points = [];
      $db = Db::getInstance();
      if($checked != NULL)
        $req = $db->query("SELECT * FROM list_points WHERE checked=1 AND list_id=$parent_id");
      else
         $req = $db->query("SELECT * FROM list_points WHERE checked=0 AND list_id=$parent_id");
      
      foreach($req->fetchAll() as $points) {
        $list_of_points[] = new cListPoint($points['id'], $points['list_id'], $points['content'], $points['checked']);
      }
      return $list_of_points;
    }


    // public static function find($id) {
    //   $db = Db::getInstance();
    //   // we make sure $id is an integer
    //   $id = intval($id);
    //   $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
    //   // the query was prepared, now we replace :id with our actual $id value
    //   $req->execute(array('id' => $id));
    //   $post = $req->fetch();

    //   return new Post($post['id'], $post['author'], $post['content']);
    // }
  }
?>