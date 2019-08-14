<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="REFRESH" content="4; url=<?=$page_transfer?>">
<title>:: Website Administration ::</title>

<style type="text/css">
body {
  font: 12px/20px 'Lucida Grande', Verdana, sans-serif;
  color: #404040;
  background: #343137;
}
.container {
  margin: 20px auto;
  width: 500px;
}
.container .notif {
  margin: 10px 0;
}
.notif {
  position: relative;
  padding: 25px 30px;
  min-height: 50px;
  line-height: 22px;
  background: white;
  border-radius: 2px;
}
.notif p {
  color: #666;
  margin:0px;
  text-align:center;
}
.notif-title {
  margin: 0 0 5px;
  font-size: 14px;
  font-weight: bold;
  color: #333;
}
</style>
</head>

<body>
<div class="container">

 <section class="notif">
 <p><?=$showtext?></p>
 <p>-----------------------------------------</p>
 <p>(<a href="<?=$page_transfer?>">Click vào đây nếu bạn không muốn đợi lâu </a>)</p>
 </section>
 </div>
</body>
</html>