<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/><title>:: Test ::</title>
<link rel="stylesheet" href="<?=base_url()?>styles/style.css" type="text/css"/>
<script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(function(){
$(".search").keyup(function() 
{ 
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
	$.ajax({
	type: "POST",
	url: "<? echo base_url().'main/search'; ?>",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#divResult").html(html).show();
	}
	});
}return false;    
});

jQuery("#divResult").live("click",function(e){ 
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#inputSearch').val(decoded);
});
jQuery(document).live("click", function(e) { 
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#divResult").fadeOut(); 
	}
});
$('#inputSearch').click(function(){
	jQuery("#divResult").fadeIn();
});
});
</script>
<style type="text/css">
	body{ 
		font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;
	}
	.contentArea{
		width:600px;
		margin:0 auto;
	}
	#inputSearch
	{
		width:350px;
		border:solid 1px #000;
		padding:3px;
	}
	#divResult
	{
		position:absolute;
		width:350px;
		display:none;
		margin-top:-1px;
		border:solid 1px #dedede;
		border-top:0px;
		overflow:hidden;
		border-bottom-right-radius: 6px;
		border-bottom-left-radius: 6px;
		-moz-border-bottom-right-radius: 6px;
		-moz-border-bottom-left-radius: 6px;
		box-shadow: 0px 0px 5px #999;
		border-width: 3px 1px 1px;
		border-style: solid;
		border-color: #333 #DEDEDE #DEDEDE;
		background-color: white;
	}
	.display_box
	{
		padding:4px; border-top:solid 1px #dedede; 
		font-size:12px; height:50px;
	}
	.display_box:hover
	{
		background:#3bb998;
		color:#FFFFFF;
		cursor:pointer;
	}
</style>

</head>
<body>

<div id="thebox">
	<? include("header.php"); ?>
  <div id="content">
 
<h1>Profile</h1>
	<p>
    Welcome, <b><?=$this->session->userdata('firstname');?></b>!<br />
<div class="contentArea">
Member Search: <input type="text" class="search" id="inputSearch" /><br /> 
<div id="divResult">
</div>
</div>
    </p>
	
</p>

  </div></div>
<br /><br />
	<? include("footer.php"); ?>
</body></html>
