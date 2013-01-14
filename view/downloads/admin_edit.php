<section class="categories edit">
	<header><!-- header -->
		<h1>File edit</h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<form action="<?php echo Router::url('admin/downloads/edit/'.$id); ?>" method="post" enctype="multipart/form-data" class="four" >
			<?php echo $this->Form->input('name', 'Name'); ?>
			<?php echo $this->Form->input('file', 'File', array('type'=>'file')); ?>
			<?php echo $this->Form->input('id', 'hidden'); ?>
			
			<div class="clearfix"><label for="input-status">Status</label><div class="input"><select id="input-status" name="status"><option value="activated">Activated</option><option value="deactivated">Deactvated</option></select></div></div><br />

			<?php echo $this->Form->input('description', 'Description', array('class' => 'xxlarge wysiwyg', 'type' => 'texarea', 'rows' => 10)); ?>

			<div class="actions">
				<input type="submit" class="button" value="Validate" >
			</div>
		</form>
	</div><!-- end of content -->
</section>

<script type="text/javascript" src="<?php echo Router::webroot('js/tinymce/tiny_mce.js'); ?>"></script>
<script type="text/javascript">
    tinyMCE.init({
            // General options
            mode : "specific_textareas",
            editor_selector: "wysiwyg",
            theme : "advanced",
            relative_urls : false,
            plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,image,|",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            theme_advanced_buttons4 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Skin options
            skin : "o2k7",
            skin_variant : "silver"

    });
</script>