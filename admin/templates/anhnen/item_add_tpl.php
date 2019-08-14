<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=anhnen&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Hình ảnh</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Cập nhật hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">     
    function TreeFilterChanged2(){      
                $('#validate').submit();        
    }
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=anhnen&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
    <div class="widget">
        <div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
            <h6>Cập nhật hình ảnh</h6>
        </div>     
        <?php if($item['photo']!=""){?>
        <div class="formRow">
            <label>Hình hiện tại:</label>
            <div class="formRight">
                <img src="<?=_upload_hinhanh.$item['photo']?>"  alt="NO PHOTO" height="200" />
                <a title="Xoá ảnh" href="index.php?com=anhnen&act=delete_img&id=<?=@$item['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>">Xoá ảnh</a>
            </div>
            <div class="clear"></div>                       
        </div>
        <?php }?>        
        <div class="formRow">
            <label>Tải hình ảnh:</label>
            <div class="formRight">
                <input type="file" id="file" name="img" />
                <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG , JPG , PNG)">
            </div>
            <div class="clear"></div>                       
        </div>
        <div class="formRow">
            <label>Co giãn theo màn hình:</label>
            <div class="formRight">
                <select id="bgsize" name="bgsize" class="form-control main_select">
                    <option value="auto" <?php if($item['bgsize']=='auto'){?>selected="selected"<?php }?>>Mặc định</option>
                    <option value="cover" <?php if($item['bgsize']=='cover'){?>selected="selected"<?php }?>>Giãn theo chiều ngang</option>
                    <option value="contain" <?php if($item['bgsize']=='contain'){?>selected="selected"<?php }?>>Giãn theo chiều dọc</option>
                    <option value="100% 100%" <?php if($item['bgsize']=='100% 100%'){?>selected="selected"<?php }?>>Giãn theo 2 chiều</option>
                </select>
            </div>
            <div class="clear"></div>    
        </div>
        <div class="formRow">
            <label>Tùy chỉnh lặp:</label>
            <div class="formRight">
                <select id="repeat" name="repeat" class="form-control main_select">
                    <option value="no-repeat" <?php if($item['trangthai']=='no-repeat'){?>selected="selected"<?php }?>>Không lặp lại</option>
                    <option value="repeat" <?php if($item['trangthai']=='repeat'){?>selected="selected"<?php }?>>Lặp lại</option>
                    <option value="repeat-x" <?php if($item['trangthai']=='repeat-x'){?>selected="selected"<?php }?>>Chỉ lặp ngang</option>
                    <option value="repeat-y" <?php if($item['trangthai']=='repeat-y'){?>selected="selected"<?php }?>>Chỉ lặp dọc</option>
                </select>
            </div>
            <div class="clear"></div>    
        </div>

        <div class="formRow">
            <label>Vị trí dọc :</label>
            <div class="formRight">
                <input type="radio" name="position_y" id="top_p" value="top" <?=(!isset($item['position_y']) || $item['position_y']=='top')?'checked':''?>>
                <label for="top_p">Canh trên</label>
                <input type="radio" name="position_y" id="bottom_p" value="bottom" <?=($item['position_y']=='bottom')?'checked':''?>>
                <label for="bottom_p">Canh dưới</label>
                <input type="radio" name="position_y" id="middle_p" value="center" <?=($item['position_y']=='center')?'checked':''?>>
                <label for="middle_p">Canh giữa</label>
            </div>
            <div class="clear"></div>    
        </div>
        <div class="formRow">
            <label>Vị trí ngang :</label>
            <div class="formRight">
                <input type="radio" name="position_x" id="left_p" value="left" <?=(!isset($item['position_x']) || $item['position_x']=='left')?'checked':''?>>
                <label for="left_p">Canh trái</label>
                <input type="radio" name="position_x" id="right_p" value="right" <?=($item['position_x']=='right')?'checked':''?>>
                <label for="right_p">Canh phải</label>
                <input type="radio" name="position_x" id="center_p" value="center" <?=($item['position_x']=='center')?'checked':''?>>
                <label for="center_p">Canh giữa</label>
            </div>
            <div class="clear"></div>    
        </div>
        <div class="formRow">
            <label>Cố định :</label>
            <div class="formRight">
                <input type="checkbox" name="fix" id="fix_bg" value="1" <?=($item['fix']==1)?'checked="checked"':''?> />
                <label for="fix_bg">Chạy theo màn hình</label>  
            </div>
            <div class="clear"></div>    
        </div>
        <div class="formRow">
            <label>Màu nền :</label>
            <div class="formRight">
                <input type="text" name="color" value="<?=@$item['color']?>" class="input form-control short_input" id="picker" />
            </div>
            <div class="clear"></div>    
        </div>
        <style>
            .formRow input.short_input {
                width: 200px;
            }
        </style>
        
        <script>
            $(document).ready(function() {
                $('#picker').css('border-right','20px solid #<?=@$item['color']?>');
                $('#picker').css('border-color','#<?=@$item['color']?>'); 
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $('#picker').colpick({
                    layout:'hex',
                    submit:0,
                    colorScheme:'dark',
                    onChange:function(hsb,hex,rgb,el,bySetColor) {
                        $(el).css('border-right','20px solid #'+hex);
                        $(el).css('border-color','#'+hex);
                        // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                        if(!bySetColor) $(el).val(hex);
                    }
                }).keyup(function(){
                    $(this).colpickSetColor(this.value);
                });
            })
        </script>



    <div class="formRow">
        <div class="formRight">
            <input type="hidden" name="id" id="id_this_photo" value="<?=@$item['id']?>" />
            <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
        </div>
        <div class="clear"></div>
    </div>     
        
    </div>
   
</form> 