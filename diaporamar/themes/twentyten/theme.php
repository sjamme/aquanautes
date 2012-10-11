<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.4.23
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.4.x/themes/classic/theme.php $
  $Revision: 5891 $
  $Author: gaugau $
  $Date: 2009-05-01 23:44:32 +0200 (Fr, 01 Mai 2009) $
**********************************************/

// ------------------------------------------------------------------------- //
// This theme has all CORE items removed                                     //
// ------------------------------------------------------------------------- //
define('THEME_IS_XHTML10_TRANSITIONAL',1);

//mod - truncate album description
$album_desc = get_album_desc($superCage->get->getInt('album'));
//mod - truncate album description

/******************************************************************************
** Section <<<$template_tab_display>>> - START
******************************************************************************/
// Template used for tabbed display
$template_tab_display = array(
    'left_text'         => '<td width="100%%" align="left" valign="middle" class="tableh1" style="white-space: nowrap">{LEFT_TEXT}</td>' . $LINEBREAK,
    'tab_header'        => '',
    'tab_trailer'       => '',
    'active_tab'        => '<td align="center" valign="middle" class="tableb tableb_alternate">%d</td>',
    'inactive_tab'      => '<td align="center" valign="middle" class="navmenu"><a href="{LINK}">%d</a></td>' . $LINEBREAK,
    'nav_tab'           => '<td align="center" valign="middle" class="navmenu"><a href="{LINK}">%s</a></td>' . $LINEBREAK,
    'nav_tab_nolink'    => '<td align="center" valign="middle" class="navmenu">%s</td>' . $LINEBREAK,
    'allpages_dropdown' => '<td align="center" valign="middle" style="white-space: nowrap; padding-right: 10px;" class="navmenu">%s</td>' . $LINEBREAK,
    'page_gap'          => '<td align="center" valign="middle" class="navmenu">-</td>' . $LINEBREAK,
    'tab_spacer'        => '<td><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>' . $LINEBREAK,
    'page_link'         => '{LINK}',
);
/******************************************************************************
** Section <<<$template_tab_display>>> - END
******************************************************************************/

// HTML template for sys menu
$template_sys_menu = <<<EOT

<ul class="dropmenu">
<!-- BEGIN home -->
                <li>
                    <a href="{HOME_TGT}" title="{HOME_TITLE}" class="firstlevel"><span class="firstlevel">{HOME_ICO}{HOME_LNK}</span></a>
                    <ul>
                    <!-- BEGIN contact -->
                                <li>
                                    <a href="{CONTACT_TGT}" title="{CONTACT_TITLE}"><span>{CONTACT_ICO}{CONTACT_LNK}</span></a>
                                </li>
                    <!-- END contact --> 
                    <!-- BEGIN sidebar -->
                                    <li>
                                        <a href="{SIDEBAR_TGT}" title="{SIDEBAR_TITLE}"><span>{SIDEBAR_ICO}{SIDEBAR_LNK}</span></a>
                                    </li>
                    <!-- END sidebar -->
                    <!-- BEGIN my_profile -->
                                    <li>
                                        <a href="{MY_PROF_TGT}" title="{MY_PROF_LNK}"><span>{MY_PROF_ICO}{MY_PROF_LNK}</span></a>
                                    </li>
                    <!-- END my_profile -->
					<!-- BEGIN enter_admin_mode -->
                                    <li>
                                    <a href="{ADM_MODE_TGT}" title="{ADM_MODE_TITLE}"><span>{ADM_MODE_ICO}{ADM_MODE_LNK}</span></a>
                                    </li>
                    <!-- END enter_admin_mode -->
                    <!-- BEGIN leave_admin_mode -->
                                    <li>
                                        <a href="{USR_MODE_TGT}" title="{USR_MODE_TITLE}"><span>{USR_MODE_ICO}{USR_MODE_LNK}</span></a>
                                    </li>
                    <!-- END leave_admin_mode -->
                    </ul>
                </li>
<!-- BEGIN allow_memberlist -->
                                    <!--
                                    <li>
                                        <a href="{MEMBERLIST_TGT}" title="{MEMBERLIST_TITLE}"><span>{MEMBERLIST_ICO}{MEMBERLIST_LNK}</span></a>
                                    </li>
                                    -->
<!-- END allow_memberlist -->

<!-- END home -->
<!-- BEGIN my_gallery -->
                <li>
                    <a href="{MY_GAL_TGT}" title="{MY_GAL_TITLE}" class="firstlevel"><span class="firstlevel">{MY_GAL_ICO}{MY_GAL_LNK}</span></a>
                    <ul>
                    <!-- BEGIN allow_memberlist -->
                                    <li>
                                        <a href="{MEMBERLIST_TGT}" title="{MEMBERLIST_TITLE}"><span>{MEMBERLIST_ICO}{MEMBERLIST_LNK}</span></a>
                                    </li>
                    <!-- END allow_memberlist -->
                    
                    </ul>
                </li>
<!-- END my_gallery -->
<!-- BEGIN upload_pic -->
                <li>
                    <a href="{UPL_PIC_TGT}" title="{UPL_PIC_TITLE}" class="firstlevel"><span class="firstlevel">{UPL_PIC_ICO}{UPL_PIC_LNK}</span></a>
                </li>
<!-- END upload_pic -->
<!-- BEGIN register -->
                <li>
                    <a href="{REGISTER_TGT}" title="{REGISTER_TITLE}" class="firstlevel"><span class="firstlevel">{REGISTER_ICO}{REGISTER_LNK}</span></a>
                </li>
<!-- END register -->
<!-- BEGIN login -->
                <li>
                    <a href="{LOGIN_TGT}" title="{LOGIN_LNK}" class="firstlevel"><span class="firstlevel">{LOGIN_ICO}{LOGIN_LNK}</span></a>
                </li>
<!-- END login -->
<!-- BEGIN logout -->
                <li>
                    <a href="{LOGOUT_TGT}" title="{LOGOUT_LNK}" class="firstlevel"><span class="firstlevel">{LOGOUT_ICO}{LOGOUT_LNK}</span></a>
                </li>
<!-- END logout -->
</ul>

EOT;


// HTML template for sub menu
if ($CONFIG['browse_by_date'] != 0) {
    $browsebydatebutton = <<< EOT
                        <li>
                            <a href="{BROWSEBYDATE_TGT}" title="{BROWSEBYDATE_TITLE}" rel="nofollow" class="greybox"><span>{BROWSEBYDATE_ICO}{BROWSEBYDATE_LNK}</span></a>
                        </li>
EOT;
} else {
    $browsebydatebutton = '';
}
$template_sub_menu = <<<EOT

<ul class="dropmenu">
<!-- BEGIN custom_link -->
                <li>
                    <a href="{CUSTOM_LNK_TGT}" title="{CUSTOM_LNK_TITLE}" class="firstlevel"><span class="firstlevel">{CUSTOM_LNK_LNK}</span></a>
                </li>
<!-- END custom_link -->
<!-- BEGIN album_list -->
                <li>
                    <a href="{ALB_LIST_TGT}" title="{ALB_LIST_TITLE}" class="firstlevel"><span class="firstlevel">{ALB_LIST_ICO}{ALB_LIST_LNK}</span></a>
                    <ul>
<!-- BEGIN lastup -->
                        <li>
                            <a href="{LASTUP_TGT}" title="{LASTUP_LNK}" rel="nofollow"><span>{LASTUP_ICO}{LASTUP_LNK}</span></a>
                        </li>
<!-- END lastup -->
<!-- BEGIN lastcom -->
                        <li>
                            <a href="{LASTCOM_TGT}" title="{LASTCOM_LNK}" rel="nofollow" ><span>{LASTCOM_ICO}{LASTCOM_LNK}</span></a>
                        </li>
<!-- END lastcom -->
<!-- BEGIN topn -->
                        <li>
                            <a href="{TOPN_TGT}" title="{TOPN_LNK}" rel="nofollow"><span>{TOPN_ICO}{TOPN_LNK}</span></a>
                        </li>
<!-- END topn -->
<!-- BEGIN toprated -->
                        <li>
                            <a href="{TOPRATED_TGT}" title="{TOPRATED_LNK}" rel="nofollow"><span>{TOPRATED_ICO}{TOPRATED_LNK}</span></a>
                        </li>
<!-- END toprated -->
<!-- BEGIN favpics -->
                        <li>
                            <a href="{FAV_TGT}" title="{FAV_LNK}" rel="nofollow"><span>{FAV_ICO}{FAV_LNK}</span></a>
                        </li>
<!-- END favpics -->
<!-- BEGIN browse_by_date -->
                        $browsebydatebutton
<!-- END browse_by_date -->
                    </ul>
                </li>
<!-- END album_list -->
<!-- BEGIN search -->
                <li>
                    <a href="{SEARCH_TGT}" title="{SEARCH_LNK}" class="firstlevel"><span class="firstlevel">{SEARCH_ICO}{SEARCH_LNK}</span></a>
                </li>
<!-- END search -->
</ul>
                
EOT;

// HTML template for gallery admin menu
$template_gallery_admin_menu = <<<EOT
                            <ul class="dropmenu">
                                <li>
                                    <a href="#" title="{FILES_TITLE}" class="firstlevel"><span class="firstlevel">{FILES_ICO}{FILES_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN admin_approval -->
                                        <li><a href="editpics.php?mode=upload_approval" title="{UPL_APP_TITLE}" class="admin_menu_anim"><span>{UPL_APP_ICO}{UPL_APP_LNK}</span></a></li>
                                    <!-- END admin_approval -->
                                    <!-- BEGIN catmgr -->
                                        <li><a href="catmgr.php" title="{CATEGORIES_TITLE}"><span>{CATEGORIES_ICO}{CATEGORIES_LNK}</span></a></li>
                                    <!-- END catmgr -->
                                    <!-- BEGIN albmgr -->
                                        <li><a href="albmgr.php{CATL}" title="{ALBUMS_TITLE}"><span>{ALBUMS_ICO}{ALBUMS_LNK}</span></a></li>
                                    <!-- END albmgr -->
                                    <!-- BEGIN picmgr -->
                                        <li><a href="picmgr.php" title="{PICTURES_TITLE}"><span>{PICTURES_ICO}{PICTURES_LNK}</span></a></li>
                                    <!-- end picmgr -->
                                    <!-- BEGIN batch_add -->
                                        <li><a href="searchnew.php" title="{SEARCHNEW_TITLE}"><span>{SEARCHNEW_ICO}{SEARCHNEW_LNK}</span></a></li>
                                    <!-- END batch_add -->
                                    <!-- BEGIN admin_tools -->
                                        <li><a href="util.php?t={TIME_STAMP}#admin_tools" title="{UTIL_TITLE}"><span>{UTIL_ICO}{UTIL_LNK}</span></a></li>
                                    <!-- END admin_tools -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="firstlevel" title="{INFO_TITLE}"><span class="firstlevel">{INFO_ICO}{INFO_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN review_comments -->
                                        <li><a href="reviewcom.php" title="{COMMENTS_TITLE}"><span>{COMMENTS_ICO}{COMMENTS_LNK}</span></a></li>
                                    <!-- END review_comments -->
                                    <!-- BEGIN log_ecards -->
                                        <li><a href="db_ecard.php" title="{DB_ECARD_TITLE}"><span>{DB_ECARD_ICO}{DB_ECARD_LNK}</span></a></li>
                                    <!-- END log_ecards -->
                                    <!-- BEGIN view_log_files -->
                                        <li><a href="viewlog.php" title="{VIEW_LOG_FILES_TITLE}"><span>{VIEW_LOG_FILES_ICO}{VIEW_LOG_FILES_LNK}</span></a></li>
                                    <!-- END view_log_files -->
                                    <!-- BEGIN overall_stats -->
                                        <li><a href="stat_details.php?type=hits&amp;sort=sdate&amp;dir=&amp;sdate=1&amp;ip=1&amp;search_phrase=0&amp;referer=0&amp;browser=1&amp;os=1&amp;mode=fullscreen&amp;page=1&amp;amount=50" title="{OVERALL_STATS_TITLE}" ><span>{OVERALL_STATS_ICO}{OVERALL_STATS_LNK}</span></a></li>
                                    <!-- END overall_stats -->
                                    <!-- BEGIN check_versions -->
                                        <li><a href="versioncheck.php" title="{CHECK_VERSIONS_TITLE}"><span>{CHECK_VERSIONS_ICO}{CHECK_VERSIONS_LNK}</span></a></li>
                                    <!-- END check_versions -->
                                    <!-- BEGIN php_info -->
                                        <li><a href="phpinfo.php" title="{PHPINFO_TITLE}"><span>{PHPINFO_ICO}{PHPINFO_LNK}</span></a></li>
                                    <!-- END php_info -->
                                    <!-- BEGIN show_news -->
                                        <li><a href="mode.php?what=news&amp;referer=$REFERER" title="{SHOWNEWS_TITLE}"><span>{SHOWNEWS_ICO}{SHOWNEWS_LNK}</span></a></li>
                                    <!-- END show_news -->
                                    <!-- BEGIN documentation -->
                                        <li><a href="{DOCUMENTATION_HREF}" title="{DOCUMENTATION_TITLE}"><span>{DOCUMENTATION_ICO}{DOCUMENTATION_LNK}</span></a></li>
                                    <!-- END documentation -->
                                    </ul>
                                </li>
                            <!-- BEGIN config -->
                                <li>
                                    <a href="admin.php" title="{ADMIN_TITLE}" class="firstlevel"><span class="firstlevel">{ADMIN_ICO}{ADMIN_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN keyword_manager -->
                                        <li><a href="keywordmgr.php" title="{KEYWORDMGR_TITLE}"><span>{KEYWORDMGR_ICO}{KEYWORDMGR_LNK}</span></a></li>
                                    <!-- END keyword_manager -->
                                    <!-- BEGIN exif_manager -->
                                        <li><a href="exifmgr.php" title="{EXIFMGR_TITLE}"><span>{EXIFMGR_ICO}{EXIFMGR_LNK}</span></a></li>
                                    <!-- END exif_manager -->
                                    <!-- BEGIN plugin_manager -->
                                        <li><a href="pluginmgr.php" title="{PLUGINMGR_TITLE}"><span>{PLUGINMGR_ICO}{PLUGINMGR_LNK}</span></a></li>
                                    <!-- END plugin_manager -->
                                    <!-- BEGIN bridge_manager -->
                                        <li><a href="bridgemgr.php" title="{BRIDGEMGR_TITLE}"><span>{BRIDGEMGR_ICO}{BRIDGEMGR_LNK}</span></a></li>
                                    <!-- END bridge_manager -->
                                    <!-- BEGIN update_database -->
                                        <li><a href="update.php" title="{UPDATE_DATABASE_TITLE}"><span>{UPDATE_DATABASE_ICO}{UPDATE_DATABASE_LNK}</span></a></li>
                                    <!-- END update_database -->
                                    </ul>
                                </li>
                            <!-- END config -->
                            <!-- BEGIN usermgr -->
                                <li>
                                    <a href="usermgr.php" title="{USERS_TITLE}" class="firstlevel"><span class="firstlevel">{USERS_ICO}{USERS_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN banmgr -->
                                        <li><a href="banning.php" title="{BAN_TITLE}"><span>{BAN_ICO}{BAN_LNK}</span></a></li>
                                    <!-- END banmgr -->
                                    <!-- BEGIN groupmgr -->
                                        <li><a href="groupmgr.php" title="{GROUPS_TITLE}"><span>{GROUPS_ICO}{GROUPS_LNK}</span></a></li>
                                    <!-- END groupmgr -->
                                    <!-- BEGIN admin_profile -->
                                        <li><a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}"><span>{MY_PROF_ICO}{MY_PROF_LNK}</span></a></li>
                                    <!-- END admin_profile -->
                                    </ul>
                                </li>
                            <!-- END usermgr -->
                            </ul>
                            
EOT;

// HTML template for user admin menu
$template_user_admin_menu = <<<EOT
                            <ul class="dropmenu">
                                <li>
                                    <a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}" class="firstlevel"><span class="firstlevel">{MY_PROF_ICO}{MY_PROF_LNK}</span></a>
                                    <ul>
                                        <li><a href="albmgr.php" title="{ALBMGR_TITLE}"><span>{ALBUMS_ICO}{ALBMGR_LNK}</span></a></li>
                                        <li><a href="modifyalb.php" title="{MODIFYALB_TITLE}"><span>{MODIFYALB_ICO}{MODIFYALB_LNK}</span></a></li>
                                        <li><a href="picmgr.php" title="{PICTURES_TITLE}"><span>{PICTURES_ICO}{PICTURES_LNK}</span></a></li>
                                    </ul>
                                </li>
                            </ul>

EOT;

/******************************************************************************
** Section <<<pageheader>>> - START
******************************************************************************/
function pageheader($section, $meta = '')
{
    global $CONFIG, $THEME_DIR;
    global $template_header, $lang_charset, $lang_text_dir;

    $custom_header = cpg_get_custom_include($CONFIG['custom_header_path']);

    $charset = ($CONFIG['charset'] == 'language file') ? $lang_charset : $CONFIG['charset'];

    header('P3P: CP="CAO DSP COR CURa ADMa DEVa OUR IND PHY ONL UNI COM NAV INT DEM PRE"');
    header("Content-Type: text/html; charset=$charset");
    user_save_profile();

    $template_vars = array(
        '{LANG_DIR}' => $lang_text_dir,
        '{TITLE}' => theme_page_title($section),
        '{CHARSET}' => $charset,
        '{META}' => $meta,
        '{GAL_NAME}' => $CONFIG['gallery_name'],
        '{GAL_DESCRIPTION}' => $CONFIG['gallery_description'],
        '{SYS_MENU}' => theme_main_menu('sys_menu'),
        '{SUB_MENU}' => theme_main_menu('sub_menu'),
        '{ADMIN_MENU}' => theme_admin_mode_menu(),
        '{CUSTOM_HEADER}' => $custom_header,
        '{JAVASCRIPT}' => theme_javascript_head(),
        '{MESSAGE_BLOCK}' => theme_display_message_block(),
    );
    
    $template_vars = CPGPluginAPI::filter('theme_pageheader_params', $template_vars);
    echo template_eval($template_header, $template_vars);

    // Show various admin messages
    adminmessages();
}
/******************************************************************************
** Section <<<pageheader>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<pagefooter>>> - START
******************************************************************************/
// Function for writing a pagefooter
function pagefooter()
{
    //global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_SERVER_VARS;
    global $USER, $USER_DATA, $CONFIG, $time_start, $query_stats, $queries;
    global $template_footer;

    $custom_footer = cpg_get_custom_include($CONFIG['custom_footer_path']);

    if ($CONFIG['debug_mode']==1 || ($CONFIG['debug_mode']==2 && GALLERY_ADMIN_MODE)) {
        cpg_debug_output();
    }

    $template_vars = array(
        '{GAL_NAME}' => $CONFIG['gallery_name'],
        '{GAL_DESCRIPTION}' => $CONFIG['gallery_description'],
        '{SYS_MENU}' => theme_main_menu('sys_menu'),
        '{SUB_MENU}' => theme_main_menu('sub_menu'),
        '{ADMIN_MENU}' => theme_admin_mode_menu(),
        '{CUSTOM_HEADER}' => $custom_header,
        '{JAVASCRIPT}' => theme_javascript_head(),
        '{CUSTOM_FOOTER}' => $custom_footer,
        '{VANITY}' => (defined('THEME_IS_XHTML10_TRANSITIONAL')) ? theme_vanity() : '',
        '{CREDITS}' => theme_credits(),
    );

    echo template_eval($template_footer, $template_vars);
}
/******************************************************************************
** Section <<<pagefooter>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<$template_cat_list>>> - START
******************************************************************************/
// HTML template for the category list
$template_cat_list = <<<EOT
<!-- BEGIN header -->
        <tr>
                <td class="tableh1" width="80%" align="left">{CATEGORY}</td>
                <td class="tableh1" width="10%" align="center">{ALBUMS}</td>
                <td class="tableh1" width="10%" align="center">{PICTURES}</td>
        </tr>
<!-- END header -->
<!-- BEGIN catrow_noalb -->
        <tr>
                <td class="catrow_noalb" colspan="3"><table border="0"><tr><td align="left">{CAT_THUMB}</td><td align="left"><span class="catlink">{CAT_TITLE}</span>{CAT_DESC}</td></tr></table></td>
        </tr>
<!-- END catrow_noalb -->
<!-- BEGIN catrow -->
        <tr>
                <td class="catrow" align="left"><table border="0"><tr><td width="170px" style="vertical-align:middle">{CAT_THUMB}</td><td style="vertical-align:middle"><span class="catlink">{CAT_TITLE}</span>{CAT_DESC}</td></tr></table></td>
                <td class="catrow" align="center">{ALB_COUNT}</td>
                <td class="catrow" align="center">{PIC_COUNT}</td>
        </tr>
        <tr>
            <td class="tableb tableb_alternate" colspan="3">{CAT_ALBUMS}</td>
        </tr>
<!-- END catrow -->
<!-- BEGIN footer -->
        <tr>
                <td colspan="3" class="tableh1" align="center"><span class="statlink">{STATISTICS}</span></td>
        </tr>
<!-- END footer -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END spacer -->

EOT;
/******************************************************************************
** Section <<<$template_cat_list>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<$template_album_list>>> - START
******************************************************************************/
// HTML template for the album list
$template_album_list = <<<EOT

<!-- BEGIN stat_row -->
        <tr>
                <td colspan="{COLUMNS}" class="tableh1" align="center"><span class="statlink">{STATISTICS}</span></td>
        </tr>
<!-- END stat_row -->
<!-- BEGIN header -->
        <tr class="tableb tableb_alternate">
<!-- END header -->
<!-- BEGIN album_cell -->
        <td width="{COL_WIDTH}%" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0">
        
        <tr>
                <td colspan="3">
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td align="center" style="vertical-align:top" class="thumbnails">
                        <img src="images/spacer.gif" width="{THUMB_CELL_WIDTH}" height="1" style="margin-top: 0px; margin-bottom: 0px; border: none;" alt="" /><br />
                        <a href="{ALB_LINK_TGT}" class="albums">{ALB_LINK_PIC}<br /></a>
                </td>
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" />
                </td>
                <td width="100%" valign="middle" style="vertical-align:middle" align="left" class="tableb tableb_alternate">
                        <span class="alblink"><a href="{ALB_LINK_TGT}">{ALBUM_TITLE}</a></span>
						{ADMIN_MENU}
                        <p>{ALB_DESC}</p>
                        <p class="album_stat">{ALB_INFOS}<br />{ALB_HITS}</p>
                </td>
        </tr>
        </table>
        </td>
<!-- END album_cell -->
<!-- BEGIN empty_cell -->
        <td width="{COL_WIDTH}%" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td height="1" valign="top" class="tableh2">
                        &nbsp;
                </td>
        </tr>
        <tr>
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td width="100%" valign="top" class="tableb tableb_alternate">
                    <div class="thumbnails" style="background-color:transparent"><img src="images/spacer.gif" width="1" height="1" border="0" class="image" style="border:0;margin-top:1px;margin-bottom:0" alt="" /></div>
                </td>
        </tr>
        </table>
        </td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr class="tableb tableb_alternate">
<!-- END row_separator -->
<!-- BEGIN footer -->
        </tr>
<!-- END footer -->
<!-- BEGIN tabs -->
        <tr>
                <td colspan="{COLUMNS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                       {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END tabs -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END spacer -->

EOT;
/******************************************************************************
** Section <<<$template_album_list>>> - END
******************************************************************************/

//begin mod to truncate album descriptions

/******************************************************************************
** Section <<<$template_thumb_view_title_row>>> - START
******************************************************************************/
// HTML template for title row of the thumbnail view (album title + sort options)
$template_thumb_view_title_row = <<<EOT

        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="width:70%;vertical-align:top;padding-top:4px" class="statlink">
                    <h2>{ALBUM_NAME}</h2>
                </td>
                <td style="text-align:right;padding-right:4px">
<!-- BEGIN admin_buttons -->
                    <a href="modifyalb.php?album={ALBUM_ID}"  title="{MODIFY_LNK}"><img src="./images/icons/modifyalb.png"></a>
                    &nbsp;&nbsp;
                    <a href="index.php?cat={CAT_ID}"  title="{PARENT_CAT_LNK}"><img src="./images/icons/category.png"></a>
                    &nbsp;&nbsp;
                    <a href="editpics.php?album={ALBUM_ID}"  title="{EDIT_PICS_LNK}"><img src="./images/icons/edit.png"></a>
                    &nbsp;&nbsp;
                    <a href="albmgr.php?cat={CAT_ID}"  title="{ALBUM_MGR_LNK}"><img src="./images/icons/alb_mgr.png"></a>
<!-- END admin_buttons -->
                </td>
            </tr>
			
			
	
        </table>
		<table>
		<tr><td style="padding-right:4px">
           	<h4>{$album_desc}</h4>
            </td></tr></table>

EOT;
/******************************************************************************
** Section <<<$template_thumb_view_title_row>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<$template_album_admin_menu>>> - START
******************************************************************************/
// HTML template for the ALBUM admin menu displayed in the album list
$template_album_admin_menu = <<<EOT
        <div class="buttonlist align_right">
                <ul>
                        <li>
                                <a title="Delete Album" href="delete.php?id={ALBUM_ID}&amp;what=album&amp;form_token={FORM_TOKEN}&amp;timestamp={TIMESTAMP}" class="adm_menu" onclick="return confirm('{CONFIRM_DELETE}');"><span><img src="./images/icons/delete.png"></span></a>
                        </li>
                        <li>
                                <a title="Edit Album Properties" href="modifyalb.php?album={ALBUM_ID}" class="adm_menu"><span><img src="./images/icons/modifyalb.png"></span></a>
                        </li>
                        <li>
                                <a title="Edit Album Files" href="editpics.php?album={ALBUM_ID}" class="adm_menu"><span class="last"><img src="./images/icons/edit.png"></span></a>
                        </li>
                </ul>
        </div>
        <div class="clearer"></div>

EOT;
/******************************************************************************
** Section <<<$template_album_admin_menu>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<theme_display_album_list>>> - START
******************************************************************************/
function theme_display_album_list(&$alb_list, $nbAlb, $cat, $page, $total_pages)
{

    global $CONFIG, $STATS_IN_ALB_LIST, $statistics, $template_tab_display, $template_album_list, $lang_album_list;

    $theme_alb_list_tab_tmpl = $template_tab_display;

    $theme_alb_list_tab_tmpl['left_text'] = strtr($theme_alb_list_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_album_list['album_on_page']));
    $theme_alb_list_tab_tmpl['page_link'] = strtr($theme_alb_list_tab_tmpl['page_link'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));

    $tabs = create_tabs($nbAlb, $page, $total_pages, $theme_alb_list_tab_tmpl);

    $album_cell = template_extract_block($template_album_list, 'album_cell');
    $empty_cell = template_extract_block($template_album_list, 'empty_cell');
    $tabs_row = template_extract_block($template_album_list, 'tabs');
    $stat_row = template_extract_block($template_album_list, 'stat_row');
    $spacer = template_extract_block($template_album_list, 'spacer');
    $header = template_extract_block($template_album_list, 'header');
    $footer = template_extract_block($template_album_list, 'footer');
    $rows_separator = template_extract_block($template_album_list, 'row_separator');

    $count = 0;

    $columns = $CONFIG['album_list_cols'];
    $column_width = ceil(100 / $columns);
    $thumb_cell_width = $CONFIG['alb_list_thumb_size'] + 2;

    starttable('100%');

    if ($STATS_IN_ALB_LIST) {
        $params = array('{STATISTICS}' => $statistics,
            '{COLUMNS}' => $columns,
            );
        echo template_eval($stat_row, $params);
    }

    echo $header;
	
	 // Tab display
    $params = array('{COLUMNS}' => $columns,
        '{TABS}' => $tabs,
        );
    echo template_eval($tabs_row, $params);

    if (is_array($alb_list)) {
        foreach($alb_list as $album) {
            $count ++;

            $params = array('{COL_WIDTH}' => $column_width,
                '{ALBUM_TITLE}' => $album['album_title'],
                '{THUMB_CELL_WIDTH}' => $thumb_cell_width,
                '{ALB_LINK_TGT}' => "thumbnails.php?album={$album['aid']}",
                '{ALB_LINK_PIC}' => $album['thumb_pic'],
                '{ADMIN_MENU}' => $album['album_adm_menu'],
                '{ALB_DESC}' => myTruncate($album['album_desc'], 100, " "), // the number changes the # of characters printed for the album description.
                '{ALB_INFOS}' => $album['album_info'],
                '{ALB_HITS}' => $album['alb_hits'],
                );

            echo template_eval($album_cell, $params);

            if ($count % $columns == 0 && $count < count($alb_list)) {
                echo $rows_separator;
            }
        }
    }

    $params = array('{COL_WIDTH}' => $column_width,
          '{SPACER}' => $thumb_cell_width
          );
    $empty_cell = template_eval($empty_cell, $params);

    while ($count++ % $columns != 0) {
        echo $empty_cell;
    }

    echo $footer;
    // Tab display
    $params = array('{COLUMNS}' => $columns,
        '{TABS}' => $tabs,
        );
    echo template_eval($tabs_row, $params);

    endtable();

    echo $spacer;
}
/******************************************************************************
** Section <<<theme_display_album_list>>> - END
******************************************************************************/



/******************************************************************************
** Section <<<theme_display_album_list_cat>>> - START
******************************************************************************/
// Function to display first level Albums of a category
function theme_display_album_list_cat(&$alb_list, $nbAlb, $cat, $page, $total_pages)
{
    global $CONFIG, $STATS_IN_ALB_LIST, $statistics, $template_tab_display, $template_album_list_cat, $lang_album_list;
    if (!$CONFIG['first_level']) {
        return;
    }

    $theme_alb_list_tab_tmpl = $template_tab_display;

    $theme_alb_list_tab_tmpl['left_text'] = strtr($theme_alb_list_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_album_list['album_on_page']));
    $theme_alb_list_tab_tmpl['page_link'] = strtr($theme_alb_list_tab_tmpl['page_link'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));

    $tabs = create_tabs($nbAlb, $page, $total_pages, $theme_alb_list_tab_tmpl);
    // echo $template_album_list_cat;
    $template_album_list_cat1 = $template_album_list_cat;
    $album_cell = template_extract_block($template_album_list_cat1, 'c_album_cell');
    $empty_cell = template_extract_block($template_album_list_cat1, 'c_empty_cell');
    $tabs_row = template_extract_block($template_album_list_cat1, 'c_tabs');
    $stat_row = template_extract_block($template_album_list_cat1, 'c_stat_row');
    $spacer = template_extract_block($template_album_list_cat1, 'c_spacer');
    $header = template_extract_block($template_album_list_cat1, 'c_header');
    $footer = template_extract_block($template_album_list_cat1, 'c_footer');
    $rows_separator = template_extract_block($template_album_list_cat1, 'c_row_separator');

    $count = 0;

    $columns = $CONFIG['album_list_cols'];
    $column_width = ceil(100 / $columns);
    $thumb_cell_width = $CONFIG['alb_list_thumb_size'] + 2;

    starttable('100%');

    if ($STATS_IN_ALB_LIST) {
        $params = array('{STATISTICS}' => $statistics,
            '{COLUMNS}' => $columns,
            );
        echo template_eval($stat_row, $params);
    }

    echo $header;

    if (is_array($alb_list)) {
        foreach($alb_list as $album) {
            $count ++;

            $params = array('{COL_WIDTH}' => $column_width,
                '{ALBUM_TITLE}' => $album['album_title'],
                '{THUMB_CELL_WIDTH}' => $thumb_cell_width,
                '{ALB_LINK_TGT}' => "thumbnails.php?album={$album['aid']}",
                '{ALB_LINK_PIC}' => $album['thumb_pic'],
                '{ADMIN_MENU}' => $album['album_adm_menu'],
                '{ALB_DESC}' => myTruncate($album['album_desc'], 100, " "), // the number changes the # of characters printed for the album description.
                '{ALB_INFOS}' => $album['album_info'],
                '{ALB_HITS}' => $album['alb_hits'],
                );

            echo template_eval($album_cell, $params);

            if ($count % $columns == 0 && $count < count($alb_list)) {
                echo $rows_separator;
            }
        }
    }

    $params = array('{COL_WIDTH}' => $column_width,
          '{SPACER}' => $thumb_cell_width
          );
    $empty_cell = template_eval($empty_cell, $params);

    while ($count++ % $columns != 0) {
        echo $empty_cell;
    }

    echo $footer;
    // Tab display
    $params = array('{COLUMNS}' => $columns,
        '{TABS}' => $tabs,
        );
    echo template_eval($tabs_row, $params);

    endtable();

    echo $spacer;
}
/******************************************************************************
** Section <<<theme_display_album_list_cat>>> - END
******************************************************************************/

// Get the name of an album
function get_album_desc($aid)
{
    global $CONFIG;
	global $lang_errors;
    $result = cpg_db_query("SELECT description from {$CONFIG['TABLE_ALBUMS']} WHERE aid = '$aid'");
    $count = mysql_num_rows($result);
    if ($count > 0) {
        $row = mysql_fetch_array($result);
        return bb_decode($row['description']);
    } else {
        return "Album description should load here but the code is not working";
    } 
}

// Function for truncating long text strings.
// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
// Adapted for Coppermine Photo Gallery use by Billy Bullock - www.billygbullock.com
function myTruncate($string, $limit, $break=".", $pad="...")
{
	// return with no change if string is shorter than $limit
	if(strlen($string) <= $limit) return $string;
	
	// is $break present between $limit and the end of the string?
	if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	}
	
	return $string;
}
//end - mod to truncate album descripitions

?>