function ChangeAction(str){
	if(confirm("Are You Sure?"))
	{
		document.f.action = str;
		document.f.submit();
	}
}
//xu ly ajax
var xmlHttpu;
function GetXmlHttpObject()
{
var xmlHttpu=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttpu=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttpu=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttpu=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttpu;
}
function UpdateStatus(idselect, iditem){
	xmlHttpu=GetXmlHttpObject();
	if (xmlHttpu==null)
	  {
	  alert ("Browser does not support HTTP Request");
	  return;
	  }
	var value = document.getElementById(idselect).value;

	var url="ajax/UpdateStatus.php";
	url=url+"?odr_id="+iditem;
	url=url+"&value="+value;
	
	xmlHttpu.onreadystatechange=ReadyUpdateStatus ;
	xmlHttpu.open("GET",url,true);
	xmlHttpu.send(null);
	
}
function ReadyUpdateStatus(){
	if (xmlHttpu.readyState==4 || xmlHttpu.readyState=="complete")
	{
		//xmlHttp.responseText la noi dung ben file updatesta... echo ra
		// Alert
		setTimeout("location.reload(true);",1);
		alert('Update successfully');
	}
}
