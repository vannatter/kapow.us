<?php if (@$shop['Hour']['id']) { ?>

	<div class="store_hours">
		<h4>Hours:</h4>
		Sunday: <?php echo $this->Common->store_hours($shop['Hour']['sunday_open'], $shop['Hour']['sunday_close']); ?><br/>
		Monday: <?php echo $this->Common->store_hours($shop['Hour']['monday_open'], $shop['Hour']['monday_close']); ?><br/>
		Tuesday: <?php echo $this->Common->store_hours($shop['Hour']['tuesday_open'], $shop['Hour']['tuesday_close']); ?><br/>
		Wednesday: <?php echo $this->Common->store_hours($shop['Hour']['wednesday_open'], $shop['Hour']['wednesday_close']); ?><br/>
		Thursday: <?php echo $this->Common->store_hours($shop['Hour']['thursday_open'], $shop['Hour']['thursday_close']); ?><br/>
		Friday: <?php echo $this->Common->store_hours($shop['Hour']['friday_open'], $shop['Hour']['friday_close']); ?><br/>
		Saturday: <?php echo $this->Common->store_hours($shop['Hour']['saturday_open'], $shop['Hour']['saturday_close']); ?><br/>
	</div>

<?php } ?>