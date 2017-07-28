<ul class="main_lists">
    <?php
        require_once('\models\list_point.php');
        require_once('\views\controls\listpoint.php');

        $lists = [];
        $lists = cListPoint::all($sel_id , 0);
        foreach($lists as $list) {
            ListPointControl::show($list->content, $list->id, $list->checked);
        }
        $lists = [];
        $lists = cListPoint::all($sel_id , 1);
        foreach($lists as $list) {
            ListPointControl::show($list->content, $list->id, $list->checked);
        }
                
    ?>
</ul>