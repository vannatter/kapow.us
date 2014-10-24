<?php
/**
 *@var $this View
 */
?>
<?php if(isset($publishers) && is_array($publishers) && count($publishers) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php $open = false; ?>
		<?php foreach($publishers as $publisher) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
				<?php $open = true; ?>
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 publisher_block">
				<?php
				$id = $publisher['Publisher']['id'];
				$name = $publisher['Publisher']['publisher_name'];

				$img = $publisher['Publisher']['publisher_photo'];
				if(empty($img) && isset($publisher['Item'][0])) {
					$img = $publisher['Item'][0]['img_fullpath'];
				}

				$seoString = $this->Common->seoize($id, $name);
				?>
				<div class="preview_img">
					<a href="/publishers/<?php echo $seoString; ?>">
						<?php if (empty($img) || $img == "/img/covers") { ?>
							<img alt="<?php echo $name; ?>" src="/img/nocover.png" width="210" height="140" />
						<?php } else { ?>
							<img alt="<?php echo $name; ?>" src="<?php echo $this->Common->thumb($img); ?>" />
						<?php } ?>
					</a>
				</div>

				<h4><a href="/publishers/<?php echo $seoString; ?>"><?php echo $name; ?></a></h4>

				<div class="item_desc">
					<p><?php echo $publisher['Publisher']['publisher_bio']; ?></p>
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
			<div class="pagination">
				<?php echo $this->Paginator->next('next'); ?>
			</div>
		</div>
	<?php } ?>
<?php } ?>