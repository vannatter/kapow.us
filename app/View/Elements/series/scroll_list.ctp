<?php
/**
 *@var $this View
 */
?>
<?php if(isset($series) && is_array($series) && count($series) > 0) { ?>
	<div id="item-scroll-list">
		<?php $row = 0; ?>
		<?php foreach($series as $ser) { ?>
			<?php if($row == 0) { ?>
				<div class="row thisweek scroll-list-item">
			<?php } ?>
			<?php $row++; ?>
			<div class="span2 publisher_block">
				<?php
				$id = $ser['Series']['id'];
				$name = $ser['Series']['series_name'];

				$img = "/theme/Kapow/img/nocover.png";

				if(isset($ser['Item'][0]['img_fullpath'])) {
					$img = $ser['Item'][0]['img_fullpath'];
					$img = $this->Common->thumb($img);
				}

				$seoString = $this->Common->seoize($id, $name);
				?>
				<div class="preview_img">
					<a href="/series/<?php echo $seoString; ?>">
						<?php echo $this->Html->image($img, array('border' => 0, 'alt' => $name, 'width' => 210, 'height' => 140)); ?>
					</a>
				</div>

				<h4><a href="/series/<?php echo $seoString; ?>"><?php echo $name; ?></a></h4>
			</div>
			<?php if($row == 6) { ?>
				</div>
				<?php $row = 0; ?>
			<?php } ?>
		<?php } ?>
	</div>
	<?php if($this->Paginator->hasNext()) { ?>
		<div id="item-scroll-nav">
			<div class="pagination"><ul><?php echo $this->Paginator->next('next'); ?></ul></div>
		</div>
	<?php } ?>
<?php } ?>