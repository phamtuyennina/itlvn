function createScroller(name, div, table, direction, delayTime, pixelAmount, rowIndex, autoPause)
{
	if(!name) return;
	if(!table) return;
	if(!window.scrollers)
	{
		window.scrollers = new Array();
	}
	
	window.scrollers[name] = new ScrollerClass(name, div, table, direction, delayTime, pixelAmount, rowIndex, autoPause);

	if(window.scrollers[name].direction == 1)
		window.scrollers[name].timerID = window.setInterval("scrollHScroller(\"" + name + "\")", window.scrollers[name].delayTime);
	else
		window.scrollers[name].timerID = window.setInterval("scrollVScroller(\"" + name + "\")", window.scrollers[name].delayTime);
}

function GetNumber(inp)
{
    return parseInt(inp.replace('px',''));
}

function ScrollerClass(name, div, table, direction, delayTime, pixelAmount, rowIndex, autoPause)
{
	this.name = name;
	this.table = document.getElementById(table);
	this.div = document.getElementById(div);
	this.direction = direction;
	this.delayTime = delayTime;
	this.pixelAmount = pixelAmount;
	this.rowIndex = rowIndex;
	this.div.scroller = this;
	this.play = 1;
	if(autoPause)
	{
		this.div.onmouseover = function()
		{
			this.scroller.play = 0;
		}
		this.div.onmouseout = function()
		{
			this.scroller.play = 2;
		}
	}
	this.table.style.position = "relative";
	this.table.style.left = 0;
	this.table.style.top = 0;

	return this;
}

function scrollVScroller(name)
{
	var firstRow;
	var newRow;
	var scroller;
	var itemHeight;
	
	if(!name) return;
	scroller = window.scrollers[name];
	if(!scroller) return;
	if(!scroller.play) return;
	firstRow = scroller.table.rows[0];
	if(Math.abs(GetNumber(scroller.table.style.top)) >= firstRow.clientHeight)
	{
		itemHeight = firstRow.clientHeight;
		newRow = scroller.table.insertRow(-1);
		scroller.table.tBodies[0].replaceChild(firstRow, newRow);
		scroller.table.style.top = (scroller.pixelAmount * 1) + 'px';
	}
	else
	{
		scroller.table.style.top = (GetNumber(scroller.table.style.top) - scroller.pixelAmount)+ 'px';
	}
}

function scrollHScroller(name)
{
	var rowContainer;
	var firstCell;
	var newCell;
	var scroller;
	var itemWidth;
	if(!name) return;
	scroller = window.scrollers[name];
	if(!scroller) return;
	if(!scroller.play) return;
	rowContainer = scroller.table.rows[scroller.rowIndex];
	if(!rowContainer) return;
	firstCell = rowContainer.cells[0];
	if(!firstCell) return;
	if(Math.abs(GetNumber(scroller.table.style.left)) >= firstCell.clientWidth)
	{
		itemWidth = firstCell.clientWidth;
		newCell = rowContainer.insertCell(-1);
		rowContainer.replaceChild(firstCell, newCell);
		scroller.table.style.left = (scroller.pixelAmount * 1) + 'px';
	}
	else
	{
		scroller.table.style.left = (GetNumber(scroller.table.style.left) - scroller.pixelAmount) + 'px';
	}
}