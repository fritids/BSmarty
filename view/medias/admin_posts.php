<h3 class="subheader">Add an image</h3>
<form action="<?php echo Router::url('admin/medias/posts/' . $post_id); ?>" method="post" enctype="multipart/form-data" class="four">
	<input type="hidden" name="url" value="<?php echo Router::url('admin/medias/posts/' . $post_id); ?>">
	<?php echo $this->Form->input('file', 'File', array('type'=>'file', 'required' => '')); ?>
	<?php echo $this->Form->input('name', 'Name', array('required' => '')); ?>
	<progress style="display: none; width: 100%; margin: 10px 0;"></progress>
	<div class="actions">
		<input type="submit" value="Upload" class="button">
	</div>
</form>


<hr>

<h3 class="subheader">Select a file</h3>
<dl class="tabs contained two-up">
  <dd class="active"><a href="#currentpost">Uploaded for the current post</a></dd>
  <dd><a href="#library">Library</a></dd>
</dl>
<ul class="tabs-content">
	<li class="active" id="currentpostTab"><!-- current post tab -->
	  	
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
				<?php 
					if(empty($postMedias)):
				?>
					<tr>
						<td colspan="5"><div class="panel">No media for this post.</div></td>
					</tr>
				<?php
					else:
						foreach($postMedias as $k=>$v):
				?>
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
				<?php
						endforeach;
					endif;
				?>
			</tbody>
		</table>

		<!--<ul class="pagination">
			<?php for($i=1; $i<=$allMediasPage; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>-->

	</li><!-- end of current post tab -->
	<li id="libraryTab"><!-- library tab -->
		


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
				<?php 
					if(empty($allMedias)):
				?>
					<tr>
						<td colspan="5"><div class="panel">No media in the library.</div></td>
					</tr>
				<?php
					else:
						foreach($allMedias as $k=>$v):
				?>
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
				<?php
						endforeach;
					endif;
				?>
			</tbody>
		</table>

		<!--<ul class="pagination">
			<?php for($i=1; $i<=$allMediasPage; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>-->

	</li><!-- end of library tab -->
</ul>