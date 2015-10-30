<?php echo $this->Element('headers/users/library'); ?>

<div class="row">
	<div class="span3">
		<?php
		echo $this->Form->input('filter', array(
			'type' => 'text',
			'placeHolder' => __('Search My Library'),
			'label' => false,
			'data-href' => '/my/library/filter/'
		));
		?>
		
		<h4 style="border-bottom: 1px solid #fff;">Browse by Series</h4>
		<ul class="unstyled library-series">
			<?php foreach ($series_list as $series) { ?>
			<li>
				<span><?php echo $series['series_name']; ?></span>
				<ul style="display: none;">
					<?php foreach ($series['issues'] as $itemId=>$itemNum) { ?>
					<li>
						<?php
						echo $this->Html->link(
							$itemNum,
							sprintf('/my/library/filter/issue/%s', $itemId),
							array(
								'class' => 'issue-link'
							)
						);
						?>
					</li>
					<?php } ?>
				</ul>
			</li>
			<?php } ?>
		</ul>
	</div>
	
	<div class="span9 item_detail">
		<?php echo $this->Element('users/my/library_scroll'); ?>
	</div>
</div>