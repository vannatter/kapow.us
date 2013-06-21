
<?php $this->Html->script('page/search', array('inline' => false)); ?>
<?php echo $this->Element('headers/home/index'); ?>

<?php echo $this->Form->create('Search', array('url' => '/search', 'class' => 'form-inline')); ?>
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
		<div class="row random_item">
			<div class="span3 item_detail_img">	
				<?php if ($random_item['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $random_item['Item']['item_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $random_item['Item']['item_name']; ?>" class="detail_img" src="<?php echo $this->Common->thumb($random_item['Item']['img_fullpath'], "50p"); ?>" /><?php } ?>
			</div>
			
			<div class="span6 item_detail">
				<h2><?php echo $this->Html->link($random_item['Item']['item_name'], '/items/' . $this->Common->seoize($random_item['Item']['id'], $random_item['Item']['item_name'])); ?></h2>
				
				<div class="item_description">
					<?php echo $random_item['Item']['description']; ?>
				</div>

				<div class="row item_grid">
					<div class="span2 item_grid_lbl">Series:&nbsp;</div>
					<div class="span4 item_grid_row"><?php echo $this->Common->series($random_item['Item']['series_num'], $random_item['Series']); ?></div>

					<div class="span2 item_grid_lbl">Publisher:&nbsp;</div>
					<div class="span4 item_grid_row"><a href="/publishers/<?php echo $this->Common->seoize($random_item['Item']['publisher_id'], $random_item['Publisher']['publisher_name']); ?>"><?php echo ucwords(strtolower($random_item['Publisher']['publisher_name'])); ?></a></div>

					<div class="span2 item_grid_lbl">Released:&nbsp;</div>
					<div class="span4 item_grid_row"><?php echo date("m/d/Y", strtotime($random_item['Item']['item_date'])); ?></div>
				</div>
				
				<div class="item_tags">
					<?php foreach ($random_item['ItemTag'] as $it) { ?>
						<span class="label"><a href="/tags/<?php echo $this->Common->seoize($it['Tag']['id'], $it['Tag']['tag_name']); ?>"><?php echo $it['Tag']['tag_name']; ?></a></span>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="home_hdr"><h4>Bam! Blog! (<?php echo $blog['Blog']['title']; ?>)</h4></div>
		<div class="row">
			<div class="span9 generic_body home_blog">	
				<?php echo $blog['Blog']['body']; ?>
			</div>
		</div>
		
		<br/>
		
		<div class="home_hdr"><h4>What is Kapow!?</h4></div>
		<div class="row">
			<div class="span9 generic_body home_what">	
				Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops. We're creating tools that make finding new stuff you want much easier (and keeping track of what you already love so you never miss something new). 
				<br/><br/>
				Enough jibber-jabber, why don't you <a href="/users/register">join us</a> for free today!
			</div>
		</div>
		
	</div>
	
	<div class="span3 home_sidebar">
		
		<div class="home_hdr"><h4>What's Hot</h4></div>
		
		<div class="hot_grid">
			<div class="hot_sect">
			
			<?php if (@$ticker['Creator']['id']) { ?>
	
				<div class="row hot_block">
					<div class="span2 hot_img">
						<a href="/creators/<?php echo $this->Common->seoize($ticker['Creator']['id'], $ticker['Creator']['creator_name']); ?>"><?php if ( ($ticker['Creator']['creator_photo'] == "/img/covers") || (!$ticker['Creator']['creator_photo']) ) { ?><img border="0" alt="<?php echo $ticker['Creator']['creator_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $ticker['Creator']['creator_name']; ?>" class="detail_img" src="<?php echo $ticker['Creator']['creator_photo']; ?>" /><?php } ?></a>
					</div>
				</div>
	
				<div class="row hot_block">
					<div class="span3 hot_link">
						<h4><?php echo $this->Html->link($ticker['Creator']['creator_name'], '/creators/' . $this->Common->seoize($ticker['Creator']['id'], $ticker['Creator']['creator_name'])); ?></h4>
					</div>
				</div>
				
				<div class="row hot_block">
					<div class="span3 hot_desc">
						<?php echo $ticker['Creator']['creator_bio']; ?>
					</div>
				</div>
	
			<?php } else { ?>
			
				<div class="row hot_block">
					<div class="span2 hot_img">
						<a href="/items/<?php echo $this->Common->seoize($ticker['Item']['id'], $ticker['Item']['item_name']); ?>"><?php if ($ticker['Item']['img_fullpath'] == "/img/covers") { ?><img border="0" alt="<?php echo $ticker['Item']['item_name']; ?>" src="/img/nocover_large.png" class="detail_img" /><?php } else { ?><img border="0" alt="<?php echo $ticker['Item']['item_name']; ?>" class="detail_img" src="<?php echo $this->Common->thumb($ticker['Item']['img_fullpath'], "50p"); ?>" /><?php } ?></a>
					</div>
				</div>
	
				<div class="row hot_block">
					<div class="span3 hot_link">
						<h4><?php echo $this->Html->link($ticker['Item']['item_name'], '/items/' . $this->Common->seoize($ticker['Item']['id'], $ticker['Item']['item_name'])); ?></h4>
					</div>
				</div>
	
				<div class="row hot_block">
					<div class="span3 hot_desc">
						<?php echo $ticker['Item']['description']; ?>
					</div>
				</div>
			
			<?php } ?>
			</div>
		</div>
		<div class="hot_hold" style="display:none;"></div>
		
		<br/>
		
		<div class="home_hdr"><h4>Connect With Us</h4></div>
				
		<div class="row">
			<div class="span3">
				<a href="https://twitter.com/kapowus"><img src="/img/twitter.png" border="0" alt="Twitter" /></a>
				<a href="https://facebook.com/kapow.us"><img src="/img/facebook.png" border="0" alt="Facebook" /></a>
				<a href="https://plus.google.com/112418984867940299271"><img src="/img/googleplus.png" border="0" alt="Google+" /></a>
			</div>
		</div>
				
	</div>
</div>





