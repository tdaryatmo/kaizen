<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/><title>:: Test ::</title>
<link rel="stylesheet" href="<?=base_url()?>styles/style.css" type="text/css"/>
</head>
<body>

<div id="thebox">
	<? include("header.php"); ?>
  <div id="content">
 
<h1>Profile</h1>
	<p>
    Welcome, <b><?=$this->session->userdata('firstname');?></b>!<br />
   <!-- <pre>
	<? //print_r ($this->session->all_userdata()); ?>
    </pre> -->
    This where the magic happens :)
    </p>
    <?
		echo "<pre>";
	//	print_r($data);
		$memberdata = $this->fbconnect->user;
			echo "Name : ".$memberdata['first_name']." ".$memberdata['last_name']."<br>";
			echo "Username : ".$memberdata['username']."<br>";
			if(isset($memberdata['birthday'])){ echo "Birthday : ".$memberdata['birthday']."<br>"; }
			if(isset($memberdata['hometown'])){ echo "Hometown : ".$memberdata['hometown']['name']."<br>"; }
			if(isset($memberdata['location'])){ echo "Location : ".$memberdata['location']['name']."<br>"; }
			if(isset($memberdata['work'])){ echo "Work : ".$memberdata['work'][0]['employer']['name']."<br>"; }
		echo "</pre>";
	?>
</p>

  </div></div>
<br /><br />
	<? include("footer.php"); ?>
</body></html>
