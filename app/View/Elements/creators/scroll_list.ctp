<?php
/**
 *@var $this View
 */
?>
<?php if(isset($creators) && is_array($creators) && count($creators) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php $open = false; ?>
		<?php foreach($creators as $creator) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
				<?php $open = true; ?>
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 preview_block">
				<?php
				$id = $creator['Creator']['id'];
				$name = $creator['Creator']['creator_name'];

				$img = $creator['Creator']['creator_photo'];
				if(empty($img) && isset($creator['ItemCreator'][0])) {
					$img = $creator['ItemCreator'][0]['Item']['img_fullpath'];
				}

				$seoString = $this->Common->seoize($id, $name);
				?>
				<div class="preview_img">
					<a href="/creators/<?php echo $seoString; ?>">
						<?php if (empty($img)) { ?>
							<img alt="<?php echo $name; ?>" src="/theme/Kapow/img/nocover.png" width="210" height="140" />
						<?php } else { ?>
							<img alt="<?php echo $name; ?>" src="<?php echo $this->Common->thumb($img); ?>" />
						<?php } ?>
					</a>
				</div>

				<div class="item_blck">			
					<h4><a href="/creators/<?php echo $seoString; ?>"><?php echo $name; ?></a></h4>
					<div class="item_desc">
						<p><?php echo $creator['Creator']['creator_bio']; ?></p>
					</div>
				</div>
			</div>
			<?php if($row == 6) { ?>
				</div>
				<?php $open = false; ?>
				<?php $row = 0; ?>
			<?php } ?>
		<?php } ?>
		<?php
		if($open) {
			echo '</div>';
		}
		?>
	</div>
	<?php if($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
		</div>
	<?php } ?>
<?php } ?>