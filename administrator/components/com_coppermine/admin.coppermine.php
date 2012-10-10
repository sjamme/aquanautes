<?php

/**
* @copyright Copyright (C) 2009 Guessous Mehdi Imed
* @license GNU/GPLv2 see http://www.gnu.org/licenses/gpl-2.0.html
**/

 ?><?php
// by Guessous Mehdi 2008
// Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html

// ensure this file is being included by a parent file
// no direct access
defined('_JEXEC') or die('Restricted access');

$msg = "Nothing to configure for the component " . $option . ". You can forget it.";
$mainframe->redirect( 'index.php', $msg);
?>