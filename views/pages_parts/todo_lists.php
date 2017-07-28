<ul class="main_lists">
    <?php
        require_once('\models\list.php'); 
        require_once('\views\controls\listitem.php');
        $lists = [];
        $lists[] = cList::all();
        foreach($lists as $list) {
            foreach($list as $key => $value){
                ListItemControl::show($value->title, $value->id, $value->id == $sel_id );
            }
        }
    ?>
</ul>