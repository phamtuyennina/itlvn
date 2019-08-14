
$(document).ready(function(e) {
	$('input.key').click(function(){
		if($(this).val()=='Tên...')
		{
			$(this).val('');
		}
	});
	$('input.key').blur(function(){
		if($(this).val()=='')
		{
			$(this).val('Tên...');
		}
	});
});


function FormatNumber(obj) {
var strvalue;
if (eval(obj))
	strvalue = eval(obj).value;
else
	strvalue = obj;	
var num;
	num = strvalue.toString().replace(/\$|\,/g,'');

	if(isNaN(num))
	num = "";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	num = Math.floor(num/100).toString();
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	//return (((sign)?'':'-') + num);
	eval(obj).value = (((sign)?'':'-') + num);
}
function isNumberKey(evt)
   {
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
   return false;
   return true;
   }





