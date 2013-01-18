<!DOCTYPE html>
<html lang="eng">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=base_url()?>styles/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF6600;
	font-weight: bold;
}
-->
</style>
<title>:: Test ::</title></head>

<body>
<div id="shadow"> 
<div id="mainbox"> 
<div id="header_login">
<div align="center"> 
  
  <? echo form_open('main/subforgetpwd'); ?>
  
    <table width="350" border="0" cellpadding="3" cellspacing="0" class="login_table" align="center">
          <tr >
            <td colspan="2" class="header_table"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forget Password?</span></td>
          </tr>
          <tr>
            <td ><strong>Email</strong></td>
          </tr>
          <tr><? echo validation_errors(); ?>
            <td><input type="text" name="email" size="50"></td>
          </tr>
          <tr>
            <td><input type="submit" name="submit" value="LOGIN">
              &nbsp;
              <input type="reset" name="reset" value="RESET">
              &nbsp;&nbsp;</td>
          </tr>
          <tr>
          	<td>&nbsp;</td>
          </tr>
      </table>
	<? echo form_close(); ?>
</div>
</div>
</div>
</div>
</body>
</html>