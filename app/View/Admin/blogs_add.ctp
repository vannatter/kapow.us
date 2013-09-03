<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Form->create('Blog', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('title', array('class' => 'span10')); ?>
<?php echo $this->Form->input('body', array('class' => 'span10', 'rows' => 25, 'required' => false)); ?>
<?php echo $this->TinyMCE->editor(array(
	'theme' => 'advanced',
	'mode' => 'textareas',
	'plugins' => 'jbimages,fullscreen',
	'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect,|,hr,removeformat,|,fullscreen,|,jbimages",
	'theme_advanced_buttons2' => "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	'theme_advanced_buttons3' => '',
	'theme_advanced_toolbar_location' => "top",
	'theme_advanced_toolbar_align' => "left",
	'theme_advanced_statusbar_location' => "bottom",
	'theme_advanced_resizing' => true,
	'relative_urls' => false
)); ?>
<?php echo $this->Form->submit(__('Save Blog')); ?>
<?php echo $this->Form->end(); ?>