<?php
    /* Set the default timezone */
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    /* Set the date */
    if($_GET['datepicker']!=''){
        $date = strtotime($_GET['datepicker']);
    } else {
        $date = strtotime(date('y-m-d'));
    } 

    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    /* Get the name of the week days */
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for ($i = 0; $i < 7; $i++) {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thống kê truy cập tháng : <?php echo $month ?> - <?php echo $year ?> '
        },
        subtitle: {
            text: 'Devetloper by : <a href="http://nina.vn">Nina .LTD</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Arial'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Số người truy cập'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Tổng : <b>{point.y:.1f} Lượt truy cập</b>'
        },
        series: [{
            name: 'Population',
            data: [
            <?php for($i = 1; $i <= $daysInMonth; $i++):

                $k = $i+1;
                $begin = strtotime($year.'-'.$month.'-'.$i);
                if($i==$daysInMonth){
                    if($month==12){
                        $year_tt = $year+1;
                        $end = strtotime($year_tt.'-1-1');
                    } else {
                        $month_tt = $month+1;
                        $end = strtotime($year.'-'.$month_tt.'-1');
                    }
                    
                } else {
                    $end = strtotime($year.'-'.$month.'-'.$k);
                }

                $query             =    "SELECT COUNT(*) AS todayrecord FROM counter WHERE tm>='$begin' and tm<'$end' "; 
                $todayrc  = mysql_fetch_assoc($d->query($query)); 
                $today_visitors     =    $todayrc['todayrecord']; 

            ?>
                ['<?=$i?>', <?=$today_visitors?>],
            <?php endfor; ?>


            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: -25, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Arial'
                }
            }
        }]
    });
    $( "#datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd'
    });
});
</script>

<div class="wrapper">
<form name="supplier" id="validate" class="form" action="index.php" method="get" enctype="multipart/form-data">

<div class="widget">
   <div class="title"><h6>Chào mừng bạn đến với Administrator - HỆ THỐNG QUẢN TRỊ NỘI DUNG WEBSITE - Powered by <a href="http://www.nina.vn" target="_blank"><span style="color:#f00;">Thiết kế website NINA</span></a></h6><div class="clear"></div></div>
   <p>Nếu bạn có thắc mắc trong quá trình sử dụng, xin vui lòng gởi mail về địa chỉ <strong><a href="mailto:nina@nina.vn">nina@nina.vn</a></strong></p>

   <div class="clear"></div>

   <div class="formRow">
        <label>Thống kê theo tháng</label>
        <div class="formRight">
                <input type="text" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd">
                <input type="submit" class="blueB xemthongke" onclick="TreeFilterChanged2(); return false;" value="Xem thống kê" />
        </div>
        <div class="clear"></div>
   </div>

   <div class="clear"></div>

   <div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>
   <div class="clear"></div>
   <!-- 2 columns widgets -->
    
</div>
<div class="clear"></div>
<?php echo $today = date("F j, Y, g:i a");  ?>
</form></div>

<script src="js/highcharts/highcharts.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>

