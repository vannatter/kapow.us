<?php
/**
 *@var $this View
 */
?>
<table class="table table-striped">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Report.id', __('ID')); ?></th>
		<th><?php echo $this->Paginator->sort('Report.status', __('Status')); ?></th>
		<th><?php echo $this->Paginator->sort('Report.item_type', __('Type')); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo $this->Paginator->sort('Report.created', __('Created')); ?></th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($reports as $report) { ?>
		<tr>
			<td><?php echo $report['Report']['id']; ?></td>
			<td><?php echo $this->Admin->getReportStatus($report['Report']['status']); ?></td>
			<td><?php echo $this->Admin->getReportType($report['Report']['item_type']); ?></td>
			<td>
				<?php
				$name = '';
				switch($report['Report']['item_type']) {
					case 1:   ## ITEM
						$name = $report['Item']['item_name'];
						break;
					case 2:   ## SERIES
						$name = $report['Series']['series_name'];
						break;
					case 3:   ## CREATOR
						$name = $report['Creator']['creator_name'];
						break;
					case 4:   ## PUBLISHER
						$name = $report['Publisher']['publisher_name'];
						break;
					case 5:   ## SHOP
						$name = $report['Store']['name'];
						break;
				}

				echo substr($name, 0, 30);
				?>
			</td>
			<td><?php echo $this->Admin->cleanDate($report['Report']['created']); ?></td>
			<td>
				<?php
				if($report['Report']['status'] == 0 || $report['Report']['admin_user_id'] == $this->Session->read('Auth.User.id')) {
					echo $this->Html->link(__('Open'), sprintf('/admin/reports/view/%s', $report['Report']['id']), array(
						'class' => 'btn btn-small btn-inverse'));
				} elseif($report['Report']['status'] == 1) {
					echo 'OPEN';
				}
				?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?= $this->Paginator->pagination(); ?>