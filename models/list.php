<?php
require_once('\models\list_point.php'); 
  class cList {
    public $id;
    public $title;
    public $list_points;

    public function __construct($id, $title, $list_points) {
      $this->id      = $id;
      $this->title  = $title;
      $this->list_points  = $list_points;
    }

    public static function all() {
      $list_of_lists = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM lists');

      foreach($req->fetchAll() as $t_list) {
        $list_of_lists[] = new cList($t_list['id'], $t_list['title'], cListPoint::all($t_list['id']));
      }
      return $list_of_lists;
    }
  }
?>