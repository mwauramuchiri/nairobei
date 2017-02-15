<div class="upload-site">
<p><strong>Enter the details of the site: </strong></p>
<?php echo form_open_multipart('admin/music/3'); 
// id name link_to_logo link_to_site
echo form_hidden('id',  set_value('id', $site->id));

?>
<table>
	<tr>
		<td>Name</td>
		<td><?php
			$dl = array(
			'name' => 'name',
			'value' => $site->name,
			'required' => null
			);
		echo form_input($dl); 
		?></td>
	</tr>
	<tr>
		<td>Logo</td>
		<td>
			<img width="100" src="<?php echo base_url().$site->link_to_logo ?>">
			<input type="file" name="link_to_logo" value="link_to_logo" id="link_to_logo" accept="image/*" />
		</td>
	</tr>
	<tr>
		<td>Site link</td>
		<td><?php
		$dl = array(
			'name' => 'link_to_site',
			'value' => $site->link_to_site,
			'required' => null
			);
		echo form_input($dl); 
		?></td>
	</tr>
</table>
<?php
echo form_submit('submit','Upload site details');
echo form_close();?>
</div>