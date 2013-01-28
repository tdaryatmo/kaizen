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
</head>

<body>
<div id="shadow"> 
<div id="mainbox"> 
<div id="header_login">
<div align="center"> 
  
  <? echo form_open('main/login_validation','formLogin'); ?>
  
    <table width="350" border="0" cellpadding="3" cellspacing="0" class="login_table" align="center">
          <tr >
            <td colspan="2" class="header_table"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Do Login!</span></td>
          </tr>
          <tr>
            <td ><strong>Email</strong></td>
          </tr>
          <tr><? // echo validation_errors(); ?><?php echo form_error('username'); ?>
            <td><input type="text" name="username" size="50"></td>
          </tr>
          <tr>
            <td ><strong>Password</strong></td>
          </tr>
          <tr><?php echo form_error('password'); ?>
            <td><input type="password" name="password" size="50"></td>
          </tr>
          <tr>
            <td><input type="submit" name="submit" value="LOGIN">
              &nbsp;
              <input type="reset" name="reset" value="RESET">
             </td>
           </tr>
           <tr>
           <td>
              &nbsp;&nbsp;<a href="<? echo base_url().'main/fbrequest'; ?>">Login with Facebook</a> | <a href="<?=base_url().'main/signup'?>">Sign Up!</a> | <a href="<?=base_url().'main/forgetpwd'?>">Forget Password?</a></td>
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
