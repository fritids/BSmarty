<section class="online_orders index">
	<article>
		<header>
			<h1>Online Orders</h1>
		</header>
		<div class="content">
			<form action="<?php echo Router::url('Online_Orders/proceed'); ?>" method="post">
				<div class="row">
					<?php foreach($rows as $row): ?>
						<div class="four columns">
							<h3 class="subheader"><?php echo $row->category->name; ?></h3>
							<?php foreach($row->items as $k=>$v): ?>
								<div class="item" data-image="<?php echo $v->image; ?>">
									<?php echo $v->name; ?> *<?php echo $v->factor; ?> <?php echo $this->Form->select($v->slug, 'Quantity', $quatity); ?>
								</div>
							<?php endforeach ?>
							
						</div>
					<?php endforeach; ?>
				</div>
				
				<?php echo $this->Form->input('other', 'Other', array('type' => 'texarea', 'rows' => 10)); ?>

				<div class="actions">
	                <input type="submit" class="button" value="Validate" >
	            </div>

			</form>
		</div>
		
	</article>
</section>