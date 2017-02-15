<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<?php
dump($category);
if (isset($all_by_category)) {
	// result limited to five latest articles
	foreach ($all_by_category as $article) {
		dump($article);
	}
}
?>