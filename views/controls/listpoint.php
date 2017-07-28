
<?php
    class ListPointControl{
        public static function show($content, $id, $checked){
            $c_chk = $checked == true ? 'checked' : '';
            echo <<<EOT
                <li id="$id">
                    <div class="lst_pt">
                        <input id="$id" type="checkbox" class="ch_box" $c_chk/>
                        <input id="$id" type="text" maxlength="50" class="ch_box_txt" value="$content">

                        <button id="$id" title="Delete" class="cross_btn_lst_it cross_btn_lst_it_pnt">&#x2715</button>
                    </div> 
                </li>
EOT;
        }
    }
?>

<script>
    $(function() {
        //chbx on check event
        $(".ch_box").change(function() {
            var ch = 0;
            if(this.checked)
            {
                ch = 1;
            }
            $.ajax({
				url: "data_base.php",
				method: "POST",
				data: { mode : "change_state", id : event.target.id, state : ch, selected_id : id},
				dataType: "html",
				success: function(data) {
                    $('#lst_pnts').html(data);
				},
			});
        });
        //delete button list item on click event
        $('.cross_btn_lst_it_pnt').on('click', function() {
            var $div = $(this).parent();
            var $div_p = $($div).parent();
            $.ajax({
				url: "data_base.php",
				method: "POST",
				data: { mode : "delete_point", id : event.target.id },
				dataType: "html",
				success: function(data) {
                    $div_p.remove();
				},
			});
        });
        $('.ch_box_txt').on('input',function(e){
            
            $.ajax({
				url: "data_base.php",
				method: "POST",
				data: { mode : "edit_point", id : event.target.id, content : event.target.value },
				dataType: "html",
			});
        });
    }); 
</script>