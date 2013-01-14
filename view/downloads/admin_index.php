<section class="donwloads">
	<header><!-- header -->
		<h1><?php echo $total; ?> Files <small>Add, edit or delete files</small></h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<table class="twelve tablesort">
			<thead>
				<tr>
					<th>Preview</th>
					<th>Name</th>
					<th>Url</th>
					<th>Downloaded</th>
					<th>Status</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($downloads as $k=>$v): ?>
				<tr>
					<td>
						<a href="<?php echo Router::webroot('downloads/'.$v->type.'/'.$v->file); ?>" class="th" title="<?php echo $v->name; ?>" target="_blank" >
							<?php
								$imageSrc = "#";
								if($v->type == "image")   $imageSrc = Router::webroot('downloads/'.$v->type.'/'.$v->file);
								if($v->type == "word")    $imageSrc = Router::webroot('images/icons/word.png');
								if($v->type == "presentation")    $imageSrc = Router::webroot('images/icons/presentation.png');
								if($v->type == "archive") $imageSrc = Router::webroot('images/icons/archive.png'); 
								if($v->type == "text")    $imageSrc = Router::webroot('images/icons/text.png');
								if($v->type == "video")   $imageSrc = Router::webroot('images/icons/video.png'); 
								if($v->type == "csv")     $imageSrc = Router::webroot('images/icons/csv.png');
								if($v->type == "pdf")     $imageSrc = Router::webroot('images/icons/pdf.png');				
							?>
							<img src="<?php echo $imageSrc; ?>" alt="<?php echo $v->name; ?>" style="max-height: 45px;" >
						</a>
					</td>
					<td><?php echo $v->name; ?></td>
					<td><input class="expand" onclick="this.focus();this.select()" value="<?php echo Router::webroot('downloaded/'.$v->type.'/'.$v->file); ?>" /></td>
					<td><a href="<?php echo Router::url('admin/downloads/log/'.$v->id); ?>" title="Display file log"><?php echo $v->downloaded; ?></a></td>
					<td>
						<?php
							if($v->status == 'activated'){
								echo '<span class="success label">Activated</span>';
							}elseif($v->status == 'deactivated'){
								echo '<span class="alert label">Deactivated</span>';
							}else{
								echo '<span class="alert secondary">Unknown</span>';
							}
						?>
					</td>
					<td><?php echo $v->created; ?></td>
					<td>
						<a href="<?php echo Router::url('admin/downloads/edit/'.$v->id); ?>" class="button tiny secondary">Edit</a>
						<a onclick="return confirm('You will delete this file, continue?');" href="<?php echo Router::url('admin/downloads/delete/'.$v->id); ?>" class="button tiny alert">Delete</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<p><a href="<?php echo Router::url('admin/downloads/edit'); ?>" class="button">Add new file</a></p>
	</div><!-- end of content -->
	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>
