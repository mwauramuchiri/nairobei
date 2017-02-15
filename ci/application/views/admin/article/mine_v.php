<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/headers/links_v');
foreach ($my_articles as $article) {
	//dump($article);
	echo $article['title'];
	$str = '<a href="'.site_url('admin/article/edit').'/'.$article['id'].' "> Edit</a>';
	if ((int)$article['type'] == 0) {
		$str .= ' draft';
	}
	$str .= '<br>';
	echo $str;
	?>
	
	<?php
}


?>