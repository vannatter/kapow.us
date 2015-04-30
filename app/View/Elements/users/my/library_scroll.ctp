<?php
/**
 *@var $this View
 */
?>
<?php $this->Html->script('page/users.pulllist.js', array('inline' => false)); ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($items as $item) { ?>
			<?php if ($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<?php
			$description = $item['Item']['description'];
			$name = $item['Item']['item_name'];
			?>
			<div class="span2 preview_block">
				<div class="preview_img"><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php if ($item['Item']['img_fullpath'] == "/img/covers") { ?><img alt="<?php echo $item['Item']['item_name']; ?>" src="/theme/Kapow/img/nocover.png" width="210" height="140" /><?php } else { ?><img alt="<?php echo $item['Item']['item_name']; ?>" src="<?php echo $this->Common->thumb($item['Item']['img_fullpath']); ?>" /><?php } ?></a></div>

				<?php echo $this->Common->libraryRemoveButton($item['UserItem']['id']); ?>

				<div class="item_blck">			
					<h4><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php echo $name; ?></a></h4>
					<div class="item_desc">
						<?php echo $this->Common->printing($item['Item']['printing']); ?>
						<p><?php echo $description; ?></p>
					</div>
				</div>
			</div>
			<?php if ($row == 6) { ?>
				</div>
				<?php $row = 0; ?>
			<?php } ?>
		<?php } ?>
		
		<?php if ($row == 6) { ?>
		<?php } else { ?>
			<?php if ($row == 0) { ?>
			
			<?php } else { ?>
				<?
					$fill = 6 - $row;
					for ($i = 0; $i < $fill; $i++) {
						?>
							<div class="span2 preview_block <?php if ($hasPull) { echo "preview_block_on"; } ?>">xxx</div>
						<?						
					}
				?>
				</div>
			<?php } ?>
		<?php } ?>
				
	</div>
	
<?php if ($this->Paginator->hasNext()) { ?>
	<div id="item-scroll-nav">
		<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
	</div>
<?php } ?>

