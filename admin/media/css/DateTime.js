 function ShowTime()
	{
		var dt = new Date();
		var strMonth = new Array("01","02","03","04","05","06","07","08","09","10","11","12"); 
		var strDay = new Array("Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"); 
		var date = strDay[dt.getDay()] + ", ";
		var years = dt.getYear();
		var days=dt.getDate();
		if (years<1900) years += 1900;
		if (days<10)
			date += "0" + dt.getDate() + "/" + strMonth[dt.getMonth()] + "/" + years;
		else
			date += "" + dt.getDate() + "/" + strMonth[dt.getMonth()] + "/" + years;
			var phut=dt.getMinutes();
			if(phut<10)
			{			
			    phut="0"+phut;
			}
        if(document.getElementById("timer")!=null)
        {
		         document.getElementById("timer").innerHTML=date+", "+dt.getHours()+":"+phut+":"+dt.getSeconds();
        }
		
	} 
   