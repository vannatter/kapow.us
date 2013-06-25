<?php
/**
 * @var $this View
 */
?>
<?php echo $this->Form->create('Blog', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('title', array('class' => 'span10')); ?>
<?php echo $this->Form->input('body', array('class' => 'span10', 'rows' => 25)); ?>
<?php echo $this->Form->submit(__('Save Blog')); ?>
<?php echo $this->Form->end(); ?>
<?php echo $this->TinyMCE->editor(array(
	'theme' => 'advanced',
	'mode' => 'textareas',
	'plugins' => 'jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave',
	'theme_advanced_buttons1' => "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
  'theme_advanced_buttons2' => "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
  'theme_advanced_buttons3' => "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	'theme_advanced_buttons4' => "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
	'theme_advanced_toolbar_location' => "top",
  'theme_advanced_toolbar_align' => "left",
  'theme_advanced_statusbar_location' => "bottom",
  'theme_advanced_resizing' => true,
	'relative_urls' => false
)); ?>