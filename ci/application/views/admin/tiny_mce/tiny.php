<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    
    <script src="<?php echo base_url(); ?>tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url(); ?>tinymce/jquery.tinymce.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sam_ajx.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#editor_txtarea',
            theme: 'modern',
            width: 600,
            height: 300,
            subfolder:"",
            forced_root_block: 0,
            relative_urls: false,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor filemanager"
            ],
            image_advtab: true,
            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
        });
    </script>
</head>