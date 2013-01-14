<section class="online_orders index">
	<article>
		<header>
			<h1>Online Orders</h1>
		</header>
		<div class="content">
			<div class="six columns centered">
				<form action="<?php echo Router::url('Online_Orders/checkout'); ?>" method="post">
					<input type="hidden" name="items" value='<?php echo serialize($items); ?>'>

					<h3 class="subheader">Confirm your order</h3>
					<p>You have selected <?php echo count((array)$items); ?> items.</p>
					<hr>
					<table class="twelve tablesort">
						<thead>
							<tr>
								<th>Name</th>
								<th>Factor</th>
								<th>Quantity</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($items as $k=>$v): ?>
							<tr>
								<td><?php echo $v->name; ?></td>
								<td><?php echo $v->factor; ?></td>
								<td><?php echo $v->quantity; ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>

					<hr>
					<?php echo $this->Form->select('shipping', 'Shipping', $shipping); ?>

					<?php
						if(isset($other)){
							echo '<input type="hidden" name="other" value=\''.$other.'\'>';
							echo '<hr>';
							echo '<h4 class="subheader">Your message:</h4><p>'.$other.'</p>';
						}
					?>

					<hr>
					<div class="actions">
						<a href="<?php echo Router::url('Online_Orders'); ?>" class="button alert">Back</a>
		                <input type="submit" class="button" value="Validate" >
		            </div>
		        </form>
			</div>
		</div>
		
	</article>
</section>