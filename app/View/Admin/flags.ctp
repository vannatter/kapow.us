<?php
/**
 *@var $this View
 */
?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('Flag.id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('Flag.status', __('Status')); ?></th>
			<th><?php echo $this->Paginator->sort('Flag.item_type', __('Type')); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo $this->Paginator->sort('Flag.created', __('Created')); ?></th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($flags as $flag) { ?>
			<tr>
				<td><?php echo $flag['Flag']['id']; ?></td>
				<td><?php echo $this->Admin->getReportStatus($flag['Flag']['status']); ?></td>
				<td><?php echo $this->Admin->getReportType($flag['Flag']['item_type']); ?></td>
				<td>
					<?php
					$name = '';
					switch($flag['Flag']['item_type']) {
						case 1:   ## ITEM
							$name = $flag['Item']['item_name'];
							break;
						case 2:   ## SERIES
							$name = $flag['Series']['series_name'];
							break;
						case 3:   ## CREATOR
							$name = $flag['Creator']['creator_name'];
							break;
						case 4:   ## PUBLISHER
							$name = $flag['Publisher']['publisher_name'];
							break;
						case 5:   ## SHOP
							$name = $flag['Store']['name'];
							break;
					}

					echo substr($name, 0, 30);
					?>
				</td>
				<td><?php echo $this->Admin->cleanDate($flag['Flag']['created']); ?></td>
				<td>
					<?php
					if ($flag['Flag']['status'] == 0 || $flag['Flag']['admin_user_id'] == $this->Session->read('Auth.User.id')) {
						echo $this->Html->link(__('Open'), sprintf('/admin/flags/view/%s', $flag['Flag']['id']), array(
							'class' => 'btn btn-small btn-inverse'));
					} elseif ($flag['Flag']['status'] == 1) {
						echo $flag['LockUser']['username'];
					}
					?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php echo $this->Paginator->pagination(); ?>