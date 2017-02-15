<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/headers/main_h_v');
$this->load->view('admin/headers/links_v');
?>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/sam_ajx.js' ?>"></script>
</head>
<body>
<?php echo form_open_multipart('/admin/site/upload_image',array('style'=>'visibility:hidden','id'=>'image-upload'));?>
	<input type="file" name="userfile" accept="image/*" /><br/>
	<label>Owner</label>
	<?php 
	$d = array(
		'name' => 'owner',
		'required' => null
		);
	echo form_input($d); 
	?><br/>
	<label>Owner's Instagram</label>
	<?php
	$d = array(
		'name' => 'ig_link',
		'required' => null
		);
	echo form_input($d); 
	?><br/>
	<label>Owner's Twitter</label>
	<?php
	$d = array(
		'name' => 'twitter_link',
		'required' => null
		);
	echo form_input($d); 
	?><br/>
	<br /><br />
	<input type="submit" value="upload" />
	</form>
	