
<?php
    if(in_array('selected_id', $_POST) == true) {
        $sel_id = $_POST['selected_id'];
        exit;
    }
?>    
<?php
    class ListItemControl{
        public static function show($title, $id, $sel){
            $c_sel = $sel == true ? 'sel' : 'unsel';
            echo <<<EOT
                <li>
                    <div id="lst_itm" class="lst_it lst_it_$c_sel">
                        <div id="$id" class="text_of_lst_it">
                            $title
                        </div>
                        <button id="$id" title="Delete" class="cross_btn_lst_it cross_btn_lst_it_lst">&#x2715</button>
                    </div> 
                </li>
EOT;
        }
    }
?>

<script>
    $(function() {
        //list item on click event
        $('.text_of_lst_it').on('click', function() {
            id = event.target.id;
            $.ajax({
				url: "data_base.php",
				method: "POST",
				data: { mode : "update_list", selected_id : id},
				dataType: "html",
				success: function(data) {
                    //updating lists
                    $('#lst_itms').html(data);
                    $.post('views/controls/listitem.php', 'selected_id=' + id);
                    $.ajax({
				        url: "data_base.php",
				        method: "POST",
				        data: { mode : "update_points", selected_id : id},
				        dataType: "html",
				        success: function(data) {
                            //update points
                            $('#lst_pnts').html(data);
				        },
			        });
				},
            });
        });
        //delete button list item on click event
        $('.cross_btn_lst_it_lst').on('click', function() {
            var $div = $(this).parent();
            var $div_p = $($div).parent();
            $.ajax({
				url: "data_base.php",
				method: "POST",
				data: { mode : "delete_list", id : event.target.id },
				dataType: "html",
				success: function(data) {
                    $div_p.remove();
                   
				},
			});
        });
    }); 
</script>