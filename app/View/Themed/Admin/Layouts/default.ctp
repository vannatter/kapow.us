<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kpaow - Admin</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<?php echo $this->Html->css('style'); ?>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<?php echo $this->element('admin/nav'); ?>
  
  <div class="container-fluid">
    <div class="row">
    	<?php echo $this->element('admin/sidebar'); ?>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
      </div>
    </div>
  </div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</body>
</html>