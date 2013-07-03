<?php
/**
 * @var $this View
 */
?>

<?php echo $this->Element('headers/improve/item'); ?>

<div class="pad">

Questions? Comments? Problems? You can always email us at <a href="mailto:info@kapow.us">info@kapow.us</a>, message us on <a href="http://twitter.com/kapowus">Twitter</a> or use the contact form below. 
<br/><br/>
We look forward to hearing from you, and we'll try to get back to you as soon as we can. Thanks for using Kapow!
<br/><br/>
<br/>

<form id="contact_frm" class="well span11" method="post" action="/submit-contact">
  <div class="row">
		<div class="span3">
			<label>First Name</label>
			<input type="text" class="span3" name="first_name" id="first_name" />
			<label>Last Name</label>
			<input type="text" class="span3" name="last_name" id="last_name" />
			<label>Email Address</label>
			<input type="text" class="span3" name="email" id="email" />
			<label>Subject
			<select id="subject" name="subject" class="span3">
				<option value="" selected="">Choose One:</option>
				<option value="api">API Request</option>
				<option value="bug">Bug Report</option>
				<option value="service">Customer Service</option>
				<option value="request">Feature Request</option>
				<option value="sales">Sales Inquiry</option>
			</select>
			</label>
		</div>
		<div class="span8">
			<label>Message</label>
			<textarea name="message" id="message" class="input-xlarge span8" rows="10"></textarea>
		</div>
	
		<button type="button" class="contact_btn btn btn-custom pull-right">Send</button>
	</div>
</form>


</div>


<h2><?php echo __('Make Changes!'); ?></h2>


<?php echo $this->Form->create('Item', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('section_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('publisher_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('series_id', array('class' => 'span6')); ?>
<?php echo $this->Form->input('stock_id', array('type' => 'text', 'class' => 'span6')); ?>
<?php echo $this->Form->input('printing', array('class' => 'span6')); ?>
<?php echo $this->Form->input('item_date', array('class' => 'span6')); ?>
<?php echo $this->Form->input('item_name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('series_num', array('class' => 'span6')); ?>
<?php echo $this->Form->input('srp', array('class' => 'span6')); ?>
<?php echo $this->Form->input('description', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Submit Changes')); ?>
<h4><?php echo __('Changes will be submitted for admin approval'); ?></h4>
<?php echo $this->Form->end(); ?>