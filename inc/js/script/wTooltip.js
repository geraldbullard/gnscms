	$("#wTooltip1").wTooltip();
	
	$("#wTooltip2").wTooltip({
		timeToStop: 2000,
		theme: "blue"
	});
	
	$("#wTooltip3").wTooltip({
		position: "mouse",
		timeToStop: 2000,
		theme: "plum"
	});
	
	$("#wTooltip4").wTooltip({
		position: "mouse",
		title: "This box is on",
		theme: "green"
	});
	
	$("#wTooltip5, #wTooltip6").wTooltip({
		position: "mouse"
	});
	
	$("#wTooltip7").wTooltip({theme:'orange'});
	
	$("#wTooltip8").wTooltip({html:false});
	
	$("#wTooltip9").wTooltip({html:false});
	
	$("#wTooltip10").wTooltip({html:false});	

	function tooltip_toggle()
	{
		if($("#wTooltip4").hasClass("active"))
		{
			$("#wTooltip4").removeClass("active");
			$("#wTooltip4").wTooltip("title", "This box is off");
		}
		else
		{
			$("#wTooltip4").addClass("active");
			$("#wTooltip4").wTooltip("title", "This box is on");
		}
	}
	
	function html_toggle()
	{
		$("#wTooltip9").wTooltip("title", "<span style='color:red;'>still no html</span>");
	}
	
	function html_toggle2()
	{
		$("#wTooltip10").wTooltip('html', true);
		$("#wTooltip10").wTooltip('title', '<span style="color:red;">yes html</span>');
	}