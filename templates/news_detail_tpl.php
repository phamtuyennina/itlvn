<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
<div class="box_container">
    <div class="content">   	    
        <?=$tintuc_detail['noidung']?> 
        <?php if(!empty($tags_sp)) { ?>
            <div class="tukhoa">
                <div id="tags">
                    <span>Tags:</span>
                    <?php foreach($tags_sp as $k=>$tags_sp_item) { ?>
                       <a href="tag/<?=changeTitle($tags_sp_item['ten'])?>/<?=$tags_sp_item['id']?>" title="<?=$tags_sp_item['ten']?>"><?=$tags_sp_item['ten']?></a>
                    <?php } ?>
                    <div class="clear"></div>
                </div>					
            </div>   
        <?php } ?>
        <div class="addthis_native_toolbox"></div>    

        <?php if(count($tintuc) > 0) { ?>   
        <div class="othernews">
             <div class="cactinkhac">Các bài khác</div>
             <ul class="phantrang">
                <?php for($i = 0, $count_tintuc = count($tintuc); $i < $count_tintuc; $i++){ ?>
                    <li><a href="<?=$com?>/<?=$tintuc[$i]['tenkhongdau']?>-<?=$tintuc[$i]['id']?>.html" title="<?=$tintuc[$i]['ten']?>"><?=$tintuc[$i]['ten']?></a> (<?=make_date($tintuc[$i]['ngaytao'])?>)</li>
                <?php }?>
             </ul> 
             <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div> 
        </div><!--.othernews-->
        
        <?php }?>     
    </div><!--.content-->
</div><!--.box_container-->
         