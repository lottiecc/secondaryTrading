function getByClass(obj,sClass)
{
	var aRr=[];
	var aTag=obj.getElementsByTagName('*');
	for(var i=0;i<aTag.length;i++)
	{
		var aClass=aTag[i].className.split(" ");
		for(var j=0;j<aClass.length;j++)
		{
			if(aClass[j]==sClass)
			{
				aRr.push(aTag[i]);
				break;	
			}
		}
	}
	return aRr;
}
function addClass(obj,sClass)
{
	if(!getClass(obj,sClass))
	{
		obj.className+=" "+sClass;
	}
}
function getClass(obj,sClass)
{
	var aClass=obj.className.split(" ");
	for(var i=0;i<aClass.length;i++)
	{
		if(aClass[i]==sClass)
		{
			return true;
		}
	}
	return false;
}
function removeClass(obj,sClass)
{
	var aClass=obj.className.split(" ");
	for(var i=0;i<aClass.length;i++)
	{
		if(aClass[i]==sClass)
		{
			aClass[i]="";
		}
	}
	obj.className=aClass.join(" ");
}