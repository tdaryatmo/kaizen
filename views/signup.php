<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Test ::</title>
</head>

<body>
</body>
</html>
<!DOCTYPE html>
<html lang="eng">
<head>
<style type="text/css">
<!--
.style1 {
	color: #FF6600;
	font-weight: bold;
}
-->
</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=base_url()?>styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="shadow"> 
<div id="mainbox"> 
<div align="center"> 
  
  <? echo form_open('main/signup_validation','formSignup'); ?>
  
    <table width="150" border="0" cellpadding="3" cellspacing="0" align="center">
          <tr >
            <td colspan="2" class="header_table"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign Up Page!</span></td>
          </tr>
          <tr><?php echo validation_errors(); ?>
            <td width="50"><strong>First Name *</strong></td>
          </tr>
          <tr><?php //echo form_error('firstname'); ?>
            <td><input type="text" name="firstname" size="50"></td>
          </tr>
          <tr>
            <td width="50"><strong>Last Name *</strong></td>
          </tr>
          <tr><?php  //echo form_error('lastname'); ?>
            <td><input type="text" name="lastname" size="50"></td>
          </tr>
          <tr>
            <td width="50"><strong>Email *</strong></td>
          </tr>
          <tr><?php //echo form_error('email'); ?>
            <td><input type="text" name="email" size="50"></td>
          </tr>
          <tr>
          	<td width="50"><strong>Type of Email * &nbsp;&nbsp;<select name="emailtype">
            	<option value="Home">Home</option>
                <option value="Work">Work</option>
                <option value="Other">Other</option>
            </select></strong></td>
          </tr>
          <tr>
          	<td><strong>Gender *</strong>&nbsp;&nbsp;<select name="gender">
            	<option value="Male">Male</option>
                <option value="Female">Female</option>
            </select></td>
          </tr>
          <tr>
            <td width="50"><strong>Password</strong></td>
          </tr>
          <tr><?php //echo form_error('password'); ?>
            <td><input type="password" name="password" size="50"></td>
          </tr>
          <tr>
            <td width="50"><strong>Re-type Password</strong></td>
          </tr>
          <tr><?php  //echo form_error('repassword'); ?>
            <td><input type="password" name="repassword" size="50"></td>
          </tr>
		 <tr>
            <td>
			<? echo $cap_img; ?>
            <input type="text" id="captcha" name="captcha" value="" />
            </td>
         </tr>
          <tr>
            <td><input type="submit" name="submit" value="SUBMIT">
              &nbsp;
              <input type="reset" name="reset" value="RESET">
          </td>
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