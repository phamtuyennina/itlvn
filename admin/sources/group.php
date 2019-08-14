<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";

switch ($act) {
    case "man":
        get_items();
        $template = "group/items";
        break;
    case "add":
        $template = "group/item_add";
        break;
    case "edit":
        get_item();
        $template = "group/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
    #===================================================	
    case "man_cat":
        get_cats();
        $template = "group/cats";
        break;
    case "add_cat":
        $template = "group/cat_add";
        break;
    case "edit_cat":
        get_cat();
        $template = "group/cat_add";
        break;
    case "save_cat":
        save_cat();
        break;
    case "delete_cat":
        delete_cat();
        break;
    default:
        $template = "index";

    default:
        $template = "index";
}

function fns_Rand_digit($min, $max, $num) {
    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $result.=rand($min, $max);
    }
    return $result;
}

function get_items() {
    global $d,$type, $items, $paging;

    if (@$_REQUEST['update'] != '') {
        $id_up = @$_REQUEST['update'];

        $tinnoibat = time();

        $sql_sp = "SELECT id,tinnoibat FROM table_group where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $spdc1 = $cats[0]['tinnoibat'];
        //echo "id:". $spdc1;
        if ($spdc1 == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_group SET tinnoibat ='" . $tinnoibat . "' WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_group SET tinnoibat =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    if (@$_REQUEST['hienthi'] != '') {
        $id_up = @$_REQUEST['hienthi'];
        $sql_sp = "SELECT id,hienthi FROM table_group where id='" . $id_up . "' ";
        $d->query($sql_sp);
        $cats = $d->result_array();
        $hienthi = $cats[0]['hienthi'];
        //echo "id:". $spdc1;
        if ($hienthi == 0) {
            $sqlUPDATE_ORDER = "UPDATE table_group SET hienthi =1 WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        } else {
            $sqlUPDATE_ORDER = "UPDATE table_group SET hienthi =0  WHERE  id = " . $id_up . "";
            $resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
        }
    }

    $sql = "select * from #_group where type='".$type."' ";
    if ((int) $_REQUEST['id_cat'] != '') {
        $sql.=" and  	id_item=" . $_REQUEST['id_item'] . "";
    }
    $sql.=" order by stt,id desc";

    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "index.php?com=group&type=".$type."&act=man";
    $maxR = 20;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d,$type, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "index.php?com=group&type=".$type."&act=man");

    $sql = "select * from #_group where id='" . $id . "'";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "index.php?com=group&type=".$type."&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d,$type;
    $file_name = fns_Rand_digit(0, 9, 8);
    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "index.php?com=group&type=".$type."&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	//Phần dữ liệu chung
	if ($_POST['ten_vi'] != '') {
		$data['ten_vi'] = $_POST['ten_vi'];
	}
	$data['ten_en'] = $_POST['ten_en'];
	$data['ten_jp'] = $_POST['ten_jp'];
	$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
	$data['mota_vi'] = $_POST['mota_vi'];
	$data['mota_jp'] = $_POST['mota_jp'];
	$data['mota_en'] = $_POST['mota_en'];
	$data['noidung_vi'] = $_POST['noidung_vi'];
	$data['noidung_jp'] = $_POST['noidung_jp'];
	$data['noidung_en'] = $_POST['noidung_en'];

	$data['title_vi'] = $_POST['title_vi'];
	$data['title_en'] = $_POST['title_en'];
	$data['title_jp'] = $_POST['title_jp'];
	$data['keywords_vi'] = $_POST['keywords_vi'];
	$data['keywords_en'] = $_POST['keywords_en'];
	$data['keywords_jp'] = $_POST['keywords_jp'];

	$data['description_vi'] = $_POST['description_vi'];
	$data['description_en'] = $_POST['description_en'];
	$data['description_jp'] = $_POST['description_jp'];
	$data['h1'] = $_POST['h1'];
	$data['h2'] = $_POST['h2'];
	$data['h3'] = $_POST['h3'];
	$data['type'] = $type;

	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	
    if ($id) {
        $id = themdau($_POST['id']);

        if ($photo = upload_image("file", 'jpg|png|gif', _upload_tintuc, $file_name)) {
            $data['photo'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 255, 320, _upload_tintuc, $file_name);
            $d->setTable('group');
            $d->setWhere('id', $id);
            $d->select();
            if ($d->num_rows() > 0) {
                $row = $d->fetch_array();
                delete_file(_upload_tintuc . $row['photo']);
                delete_file(_upload_tintuc . $row['thumb']);
            }
        }
        
        $data['ngaysua'] = time();

        $d->setTable('group');
        $d->setWhere('id', $id);
        if ($d->update($data))
            redirect("index.php?com=group&type=".$type."&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=group&type=".$type."&act=man");
    }else {

        if ($photo = upload_image("file", 'jpg|png|gif', _upload_tintuc, $file_name)) {
            $data['photo'] = $photo;
            //$data['thumb'] = create_thumb($data['photo'], 255, 320, _upload_tintuc, $file_name);
        }
       
        $data['ngaytao'] = time();

        $d->setTable('group');
        if ($d->insert($data))
            redirect("index.php?com=group&type=".$type."&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "index.php?com=group&type=".$type."&act=man");
    }
}

function delete_item() {
    global $d,$type;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        $d->reset();
        $sql = "select * from #_group where id='" . $id . "'";
        $d->query($sql);
        if ($d->num_rows() > 0) {
            while ($row = $d->fetch_array()) {
                delete_file(_upload_tintuc . $row['photo']);
                delete_file(_upload_tintuc . $row['thumb']);
            }
            $sql = "delete from #_group where id='" . $id . "'";
            $d->query($sql);
        }

        if ($d->query($sql))
            redirect("index.php?com=group&type=".$type."&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "index.php?com=group&type=".$type."&act=man");
    } else
        transfer("Không nhận được dữ liệu", "index.php?com=group&type=".$type."&act=man");
}

//===========================================================
?>