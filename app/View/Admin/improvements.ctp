<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Improvement.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Improvement.improve_type', __('Type')); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo $this->Paginator->sort('Improvement.created', __('Created')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($improvements as $improve) { ?>
			<tr>
				<td><?php echo $improve['Improvement']['id']; ?></td>
				<td><?php echo $this->Admin->getReportType($improve['Improvement']['improve_type']); ?></td>
				<td>
					<?php
					$name = '';
					switch($improve['Improvement']['improve_type']) {
						case 1:   ## ITEM
							$name = $improve['ImproveItem']['item_name'];
							break;
						case 2:   ## SERIES
							$name = $improve['Series']['series_name'];
							break;
						case 3:   ## CREATOR
							$name = $improve['Creator']['creator_name'];
							break;
						case 4:   ## PUBLISHER
							$name = $improve['Publisher']['publisher_name'];
							break;
						case 5:   ## SHOP
							$name = $improve['Store']['name'];
							break;
					}

					echo substr($name, 0, 30);
					?>
				</td>
				<td><?php echo $this->Admin->cleanDate($improve['Improvement']['created']); ?></td>
				<td>
					<?php
						echo $this->Html->link(__('Open'), sprintf('/admin/improvements/view/%s', $improve['Improvement']['id']), array(
							'class' => 'btn btn-small btn-inverse'));
					?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?= $this->Paginator->pagination(); ?>