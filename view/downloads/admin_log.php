<section class="donwloads">
	<header><!-- header -->
		<h1> <?php echo $file[0]->name; ?> <small>File log</small></h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<table class="twelve tablesort">
			<thead>
				<tr>
					<th>User id</th>
					<th>User login</th>
					<th>User name</th>
					<th>User iP</th>
					<th>Download date</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($logs as $k=>$v): ?>
				<tr>
					<td><?php echo $v->user_id; ?></td>
					<td><?php echo $v->login; ?></td>
					<td><?php echo $v->firstname.' '.$v->name; ?></td>
					<td><?php echo $v->ip; ?></td>
					<td><?php echo $v->date; ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div><!-- end of content -->
	<footer><!-- footer -->
		
	</footer><!-- end of footer -->
</section>
