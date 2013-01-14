<section class="explorer">
	<header><!-- header -->
        <h1>File management</h1>
    </header><!-- end of header --> 
    <div class="content"><!-- content -->

    	<div class="row">
    		<div class="five columns">
    			<form action="<?php echo Router::url('admin/medias/index/'); ?>" method="post" enctype="multipart/form-data">
					<?php echo $this->Form->input('file', 'File', array('type'=>'file')); ?>
					<?php echo $this->Form->input('name', 'Title'); ?>
					<div class="actions">
						<input type="submit" value="Upload" class="button">
					</div>
				<form>
    		</div>
    	</div>


		<hr>

		<table class="twelve tablesort">
			<thead>
				<tr>
					<th>Preview</th>
					<th>Title</th>
					<th>Type</th>
					<th>URL</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($medias as $k=>$v): ?>
				<tr>
					<td>
						<a href="<?php echo Router::webroot('medias/'.$v->type.'/' . $v->file); ?>" class="th" title="<?php echo $v->name; ?>" target="_blank" >
							<?php
								$imageSrc = "#";
								if($v->type == "image")   $imageSrc = Router::webroot('medias/'.$v->type.'/' . $v->file);
								if($v->type == "word")    $imageSrc = Router::webroot('images/icons/word.png');
								if($v->type == "archive") $imageSrc = Router::webroot('images/icons/archive.png'); 
								if($v->type == "text")    $imageSrc = Router::webroot('images/icons/text.png');
								if($v->type == "video")   $imageSrc = Router::webroot('images/icons/video.png'); 
								if($v->type == "csv")     $imageSrc = Router::webroot('images/icons/csv.png');
								if($v->type == "pdf")     $imageSrc = Router::webroot('images/icons/pdf.png');				
							?>
							<img src="<?php echo $imageSrc; ?>" alt="<?php echo $v->name; ?>" style="max-height: 100px;" >
						</a>
					</td>
					<td><?php echo $v->name; ?></td>
					<td><?php echo $v->type; ?></td>
					<td><input class="expand" onclick="this.focus();this.select()" value="<?php echo Router::webroot('medias/'.$v->type.'/' . $v->file); ?>" /></td>
					<td>
						<a onclick="return confirm('You will delete this file, continue?');" href="<?php echo Router::url('admin/medias/delete/' . $v->id); ?>" class="button tiny alert">Delete</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>

	</div><!-- end of content -->
	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>

