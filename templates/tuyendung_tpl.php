<?php 
	$d->reset();
	$sql = "select photo from #_background where type='".$type1."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();

  $d->reset();
  $sql = "select id,ten$lang as ten,tenkhongdau from #_news_danhmuc where type='tuyen-dung' and hienthi=1 order by stt,id desc";
  $d->query($sql);
  $tuyendung_list = $d->result_array();	
?>
<section class="banner about-banner">
    <div>
        <img src="<?=_upload_hinhanh_l.$row_bf['photo']?>" alt="<?=$title_cat?>">
    </div>
</section>
<div class="main-content-container">
  <div class="container">
    <div class="row">
      <aside class="col-sm-3 sidebar-nav career-sidebar multigroup-is-tab">
        <ul class="list-group-wrap">
          <li id="view" class="list-group-block">
              <p class="list-group-title"><?=_thongtinkhac?></p>
              <ul class="list-group">
                <li class="list-group-item <?php if($com=='moi-truong-lam-viec'){echo 'active';} ?>">
                            <a href="moi-truong-lam-viec.html"><?=_moitruonglamviec?></a>
                        </li>
                        <li class="list-group-item <?php if($com=='gia-nhap-doi-ngu'){echo 'active';} ?>">
                            <a href="gia-nhap-doi-ngu.html"><?=_gianhapdoingu?></a>
                        </li>
                        <li class="list-group-item <?php if($com=='co-hoi-nghe-nghiep'){echo 'active';} ?>">
                            <a href="co-hoi-nghe-nghiep.html"><?=_cohoinghenghiep?></a>
                        </li>   
              </ul>
          </li>
          <li>
            <p class="list-group-title"><?=_thongtintuyendung?></p>
            <ul class="list-group">
              <li class="list-group-item <?php if($com=='tuyen-dung' && empty($id_danhmuc)){echo 'active';} ?>">
                      <a href="tuyen-dung.html">
                  <?=_tatca?><span class="count-job-all"> (<?=getcongviec(0)?>)</span>
                </a>
                  </li>
              <?php foreach ($tuyendung_list as $v) {?>
              <li class="list-group-item <?php if($id_danhmuc==$v['tenkhongdau']){echo 'active';} ?>">
                      <a href="tuyen-dung/<?=$v['tenkhongdau']?>">
                  <?=$v['ten']?><span class="count-job-all"> (<?=getcongviec($v['id'])?>)</span>
                </a>
                  </li>
              <?php }?>
            </ul>
          </li>
        </ul>
      </aside>

      <div class="col-sm-9 main-content career-section">
        <div class="section-content">
            <div class="panel job-list-panel">
              <h2 class="panel-title">
                  <?=_thongtintuyendung?> <span>(<?=$totalRows ?>)</span>
              </h2>
              <table class="table rwd-table">
                <thead>
                    <tr>
                        <th><?=_vitri?></th>
                        <th><?=_nganhnghe?></th>
                        <th><?=_khuvuc?></th>
                        <th class="text-center"><?=_ngayhethan?></th>
                        <th class="text-center"> <?=_apply?> </th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($tintuc as $k => $v) {?>
                  <tr>
                    <td data-th="<?=_nghanhnghe?>">
                        <div><a href="tuyen-dung/<?=$v['tenkhongdau']?>.html">
                          <?php if($k==0){ ?>
                          <p class="position-id"><span class="label label-danger">new</span> </p>
                        <?php }?>
                          <p class="position-title"><?=$v['ten']?></p></a>
                        </div>
                    </td>
                    <td data-th="<?=_vitri?>">
                        <div> <?=gettenDM($v['id_danhmuc'])?></div>
                    </td>
                    <td data-th="<?=_khuvuc?>">
                        <div> <?=$v['khuvuc']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_ngayhethan?>">
                        <div><?=$v['ngayhethan']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_apply?>">
                         <div><a class="btn btn-secondary" href="javascript:void(0);" onclick="GoiAjax(<?=$v['id']?>)"><?=_gui?></a></div>
                    </td>
                  </tr>
                  <tr>
                    <td data-th="<?=_nghanhnghe?>">
                        <div><a href="tuyen-dung/<?=$v['tenkhongdau']?>.html">
                          <?php if($k==0){ ?>
                          <p class="position-id"><span class="label label-danger">new</span> </p>
                        <?php }?>
                          <p class="position-title"><?=$v['ten']?></p></a>
                        </div>
                    </td>
                    <td data-th="<?=_vitri?>">
                        <div> <?=gettenDM($v['id_danhmuc'])?></div>
                    </td>
                    <td data-th="<?=_khuvuc?>">
                        <div> <?=$v['khuvuc']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_ngayhethan?>">
                        <div><?=$v['ngayhethan']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_apply?>">
                         <div><a class="btn btn-secondary" href="javascript:void(0);" onclick="GoiAjax(<?=$v['id']?>)"><?=_gui?></a></div>
                    </td>
                  </tr>
                  <tr>
                    <td data-th="<?=_nghanhnghe?>">
                        <div><a href="tuyen-dung/<?=$v['tenkhongdau']?>.html">
                          <?php if($k==0){ ?>
                          <p class="position-id"><span class="label label-danger">new</span> </p>
                        <?php }?>
                          <p class="position-title"><?=$v['ten']?></p></a>
                        </div>
                    </td>
                    <td data-th="<?=_vitri?>">
                        <div> <?=gettenDM($v['id_danhmuc'])?></div>
                    </td>
                    <td data-th="<?=_khuvuc?>">
                        <div> <?=$v['khuvuc']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_ngayhethan?>">
                        <div><?=$v['ngayhethan']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_apply?>">
                         <div><a class="btn btn-secondary" href="javascript:void(0);" onclick="GoiAjax(<?=$v['id']?>)"><?=_gui?></a></div>
                    </td>
                  </tr>
                  <tr>
                    <td data-th="<?=_nghanhnghe?>">
                        <div><a href="tuyen-dung/<?=$v['tenkhongdau']?>.html">
                          <?php if($k==0){ ?>
                          <p class="position-id"><span class="label label-danger">new</span> </p>
                        <?php }?>
                          <p class="position-title"><?=$v['ten']?></p></a>
                        </div>
                    </td>
                    <td data-th="<?=_vitri?>">
                        <div> <?=gettenDM($v['id_danhmuc'])?></div>
                    </td>
                    <td data-th="<?=_khuvuc?>">
                        <div> <?=$v['khuvuc']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_ngayhethan?>">
                        <div><?=$v['ngayhethan']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_apply?>">
                        <div><a class="btn btn-secondary" href="javascript:void(0);" onclick="GoiAjax(<?=$v['id']?>)"><?=_gui?></a></div>
                    </td>
                  </tr>
                  <tr>
                    <td data-th="<?=_nghanhnghe?>">
                        <div><a href="tuyen-dung/<?=$v['tenkhongdau']?>.html">
                          <?php if($k==0){ ?>
                          <p class="position-id"><span class="label label-danger">new</span> </p>
                        <?php }?>
                          <p class="position-title"><?=$v['ten']?></p></a>
                        </div>
                    </td>
                    <td data-th="<?=_vitri?>">
                        <div> <?=gettenDM($v['id_danhmuc'])?></div>
                    </td>
                    <td data-th="<?=_khuvuc?>">
                        <div> <?=$v['khuvuc']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_ngayhethan?>">
                        <div><?=$v['ngayhethan']?> </div>
                    </td>
                    <td class="text-center" data-th="<?=_apply?>">
                        <div><a class="btn btn-secondary" href="javascript:void(0);" onclick="GoiAjax(<?=$v['id']?>)"><?=_gui?></a></div>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="html_Data">
       

    </div>
  </div>
</div>