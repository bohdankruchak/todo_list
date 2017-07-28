<?php
    require_once('\models\list.php');
    require_once('\models\list_point.php');
    require_once('\views\controls\listitem.php');
    require_once('\views\controls\listpoint.php');

    $sel_id = 1;
?>
<div class="todo_panel">
    <div id="lists" class="list_block">
    <div class="new_list">
        <div style="padding: 0 40px 0 0">
            <input id="new_list_title" type="text" maxlength="50" class="new_list_text" placeholder="Enter new list name" autofocus>
        </div>
        <div id="plbtn_list" class="plus_button">+</div>
    </div>
    <div id="lst_itms">
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
    </div>
</div>
<div id="list_points" class="list_points_block">
    <div class="new_list">
        <div style="padding: 0 40pt 0 0">
            <input id="new_point_title" type="text" maxlength="50" class="new_list_text" placeholder="Enter new list item">
        </div>
        <button id="plbtn_point" class="plus_button" style="margin: 0 10 0 0">+</button>
    </div>
    <div id="lst_pnts" style="padding: 0 20 5 20">
        <ul class="main_lists">
            <?php
                $lists = [];
                $lists[] = cListPoint::all($sel_id , 0);
                foreach($lists as $list) {
                    foreach($list as $key => $value){
                        ListPointControl::show($value->content, $value->id, $value->checked);
                    }
                }
                $lists = [];
                $lists[] = cListPoint::all($sel_id , 1);
                foreach($lists as $list) {
                    foreach($list as $key => $value){
                        ListPointControl::show($value->content, $value->id, $value->checked);
                    }
                }
            ?>
        </ul>
    </div>
</div>

<script>
    $(function() {
        //add list item button on click event
        $('#plbtn_list').on('click', function() {
            if ($('#new_list_title').val() == '') {
                return;
            }

            $.ajax({
				url: "data_base.php",
				method: "POST",
				data: { mode : "add_new_list", title :  $("#new_list_title").val(), selected_id : id },
				dataType: "html",
				success: function(data) {
                    $('#lst_itms').html(data);
                    $("#new_list_title").val("");
				},
			});
        });

        //add list point button on click event
        $('#plbtn_point').on('click', function() {
            if ($('#new_point_title').val() == '') {
                return;
            }

            $.ajax({
				url: "data_base.php",
				method: "POST",
				data: { mode : "add_new_point", content : $("#new_point_title").val(), selected_id : id },
				dataType: "html",
				success: function(data) {
                    $('#lst_pnts').html(data);
                    $("#new_point_title").val("");
				},
			});
        });
    }); 
</script>