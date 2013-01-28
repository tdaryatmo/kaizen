<?php
if($_POST)
{
	$q=$_POST['searchword'];
	$query=$this->db->query("select id,email,firstname,lastname,gender from tbl_users where lower(concat_ws(' ', firstname, lastname)) like '%$q%' or email like '%$q%' order by id LIMIT 5");
if ($query->num_rows() > 0)
{
  foreach ($query->result() as $row) {
	$email=$row->email;
	$firstname=$row->firstname;
	$gender=$row->gender;
        $b_firstname            ='<b>'.$q.'</b>';
        $b_email                        ='<b>'.$q.'</b>';
        $final_firstname        = str_ireplace($q, $b_firstname, $firstname);
        $final_email            = str_ireplace($q, $b_email, $email);
?>
<a href="<?=base_url()?>index.php/main/members"><div class="display_box" align="left">
<img src="<?=base_url()?>assets/no-photo.jpg" style="width:50px; height:50px; float:left; margin-right:6px;" />
<span class="name"><?php echo $final_firstname; ?>
</span>&nbsp;<br/><?php echo $final_email; ?><br/>
<span style="font-size:9px; color:#999999">
<?php echo $gender; ?>
</span>
</div>
</a>
<?php
}
}
}
?>
