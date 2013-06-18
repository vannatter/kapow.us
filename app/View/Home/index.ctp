
<?php $this->Html->script('page/search', array('inline' => false)); ?>
<?php echo $this->Element('headers/home/index'); ?>

<?php echo $this->Form->create('search', array('url' => '/search', 'class' => 'form-inline')); ?>
<div class="store_search_bar">
	<div class="pagination-centered">
		<?php echo $this->Form->input('type', array('class' => 'span3', 'value' => @$type)); ?>
		<?php echo $this->Form->input('terms', array('class' => 'span6', 'value' => @$terms)); ?>
		<?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-custom btn-hgh')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<div class="row">

	<div class="span9 home_main">	
	
		<div class="home_hdr"><h4>Random Goodness</h4></div>
		<div class="row">
			<div class="span3 item_detail_img">	
				<?php if ($random_item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $random_item['Item']['item_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $random_item['Item']['item_name']; ?>" class="detail_img" src="<?php echo $this->Common->thumb($random_item['Item']['img_fullpath'], "50p"); ?>" /><?php } ?>
			</div>
			
			<div class="span6 item_detail">
				<h2><?php echo $this->Html->link($random_item['Item']['item_name'], '/items/' . $this->Common->seoize($random_item['Item']['id'], $random_item['Item']['item_name'])); ?></h2>
				
				<div class="item_description">
					<?php echo $random_item['Item']['description']; ?>
				</div>
				
				<div class="item_tags">
					<?php foreach ($random_item['ItemTag'] as $it) { ?>
						<span class="label"><a href="/tags/<?php echo $this->Common->seoize($it['Tag']['id'], $it['Tag']['tag_name']); ?>"><?php echo $it['Tag']['tag_name']; ?></a></span>
					<?php } ?>
				</div>
			</div>
		</div>

		<br/>

		<div class="home_hdr"><h4>Bam! Blog!</h4></div>
		<div class="row">
			<div class="span6 blog_body">	
				herp derp
			</div>
		</div>
		
		<div class="home_hdr"><h4>What is Kapow!?</h4></div>
		<div class="row">
			<div class="span6 generic_body">	
				herp derp
			</div>
		</div>
		
	</div>
	
	<div class="span3 home_sidebar">
		
		<div class="home_hdr"><h4>What's Hot</h4></div>
		
	</div>
</div>


