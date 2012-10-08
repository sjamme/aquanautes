<?php

/**
* @copyright Copyright (C) 2009 Guessous Mehdi Imed
* @license GNU/GPLv2 see http://www.gnu.org/licenses/gpl-2.0.html
**/

 ?><?php
/*
  written by Guessous Mehdi http://www.mehdiplugins.com/misc
*/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

if (isset($bridge_lookup)) {
    $default_bridge_data[$bridge_lookup] = array(
                                               'full_name' => 'Joomla! 1.5',
                                               'short_name' => 'joomla15',
                                               'support_url' => 'http://www.joomla.org/',
                                               'full_forum_url_default' => 'http://localhost',
                                               'full_forum_url_used' => 'mandatory,not_empty,no_trailing_slash',
                                               'relative_path_to_config_file_default' => '../',
                                               'relative_path_to_config_file_used' => 'lookfor,configuration.php',
                                               'use_post_based_groups_default' => '0',
                                               'use_post_based_groups_used' => 'radio,1,0',
                                           );
}//end if (isset($bridge_lookup))
else { //NOT isset($bridge_lookup)
// define('USE_BRIDGEMGR', 1); //Nope I don't want that
    if (defined('BRIDGEMGR_PHP')) return; //nothing to do here, move along
//-----------------------------------------------
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    //---- I'm sorry but must access to _source
    function liberate_cage() {
        $superCage = Inspekt::makeSuperCage();
        $_COOKIE=$superCage->cookie->_source;
        $_SERVER=$superCage->server->_source;
        $_ENV=$superCage->env->_source;
        //----------- I  don't need these ones -------------
        $_REQUEST=$_GET=$_POST=$_FILES=array();
    }//end function liberate_cage
    
    function destroy_superglobals() {
        $_REQUEST=$_GET=$_POST=$_COOKIE=$_SERVER=$_FILES=$_ENV= '';
    }//end function destroy_globals
    
    //-- inspired by post_extraction function
    function swfupload_cookie_fix() {
        // Get the super cage instance
        $superCage = Inspekt::makeSuperCage();
        // We will extract the auth info from post only on upload page.
        if (defined('UPLOAD_PHP') && ($superCage->post->keyExists('process') || $superCage->post->keyExists('plugin_process'))) {
        	define('swfupload_cookie_fixed',1);
            $user='';
            // Get the user id and password hash from post
            $user = @unserialize(base64_decode($superCage->post->getRaw('user')));
            if ( !is_array($user)) {
                $user = array();
            }
            $_COOKIE=$user;
        }
    }//end swfupload_cookie_fix
    
    //--------------------------------------------------------------------------
    // inspired by function captcha_plugin_enabled in functions.inc.php --------
    function joomla_visualinteg_enabled() {
        global $CPG_PLUGINS;
        
        $test_plug = false;
        if (!empty($CPG_PLUGINS)) { // plugins present
            foreach ($CPG_PLUGINS as $plugin) {
                $test_plug = isset($plugin->filters['template_html']);
                $test_plug = $test_plug && (strcmp($plugin->filters['template_html'],'joomla_visualinteg_template_html')==0);
                if ($test_plug) {
                    break;
                }
            }//end foreach
        }//end if plugins present
        return $test_plug;
    }//end function joomla_visualinteg_enabled
    
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    liberate_cage(); // sorry again
    swfupload_cookie_fix();
    
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//---------- some initialisations -------------------------------------
    $joomQS="option=com_coppermine&Itemid=0";
    $joomUrl=$BRIDGE['full_forum_url'];
    $joomRel=$BRIDGE['relative_path_to_config_file'];
    $joomIntegrate = (!defined('swf_upload_cookie_fixed')) && joomla_visualinteg_enabled();
    
//------------- get rid of gzip compression
    if (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) unset($_SERVER['HTTP_ACCEPT_ENCODING']);
    
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

//---- a big function for a small need ---------------------------------
//---- give the relative path from one absolute path to an other -------
//------ currently only used for the logout link -----------------------
//--------- maybe more in the future -----------------------------------

    function twoAbsToRel($pathAbs1,$pathAbs2,$whichRel) {
        if ( strpos($pathAbs1,"\\")!==false || strpos($pathAbs2,"\\")!==false ) {//windows path
            $pathAbs1=strtr($pathAbs1,"\\","/");
            $pathAbs2=strtr($pathAbs2,"\\","/");
            //path are not case sensitive under windows:
            $pathAbs1=strtolower($pathAbs1);
            $pathAbs2=strtolower($pathAbs2);
        }//end windows path
        
        $pathAbs1=trim($pathAbs1,"/. ");
        $pathAbs2=trim($pathAbs2,"/. ");
        if ($pathAbs1==$pathAbs2) return(".");
        
        if ($pathAbs1=="") $tmpArray1= array();
        else $tmpArray1 = explode("/",$pathAbs1);
        if ($pathAbs2=="") $pathAbs2= array();
        else $tmpArray2=explode("/",$pathAbs2);
        
        $nbr1=count($tmpArray1);
        $nbr2=count($tmpArray2);
        $testNbr=min($nbr1,$nbr2);
        $baseNbr=0;
        $a=$b=NULL;
        
        $stopTest= $testNbr==0; //false if one array empty
        
        while (!$stopTest) {
            $a=array_shift($tmpArray1);
            $b=array_shift($tmpArray2);
            $testNbr--;
            $baseNbr++;
            if ($a!=$b || $testNbr<=0) $stopTest=true;
        }//end while
        
        if ($a!=$b) {
            array_unshift($tmpArray1,$a);
            array_unshift($tmpArray2,$b);
            $baseNbr--;
        }
        
        $nbr1=$nbr1-$baseNbr;
        $nbr2=$nbr2-$baseNbr;
        
        $relPath="";
        if ($whichRel==2) {
            for ($i=0;$i<$nbr1;$i++) $relPath.="../";
            $relPath.= implode("/",$tmpArray2);
        } else {
            for ($i=0;$i<$nbr2;$i++) $relPath.="../";
            $relPath.= implode("/",$tmpArray1);
        }
        
        return($relPath);
    }//end function twoAbsToRel
    
//------- path that begin with slash (ie root)
    function getSlashPath($live_url) {
        $tmp=$live_url;
        $tmp=str_replace("://","#",$tmp);
        $tmp=explode("/",$tmp);
        $tmp[0]="";
        $tmp=implode("/",$tmp);
        return($tmp);
    }//end function slashPath
    
//$$$$$$$$$$$$$$$$$$$$$$$$  Let's  joomla do its job $$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    {//bloc for joomla job
        //-------- save current dir  ----------------------------------------------
        $tmpdir=getcwd();
        
        //------------------------------------------------------------------------
        //----- backup all globals -----------------------------------------------
        //--- now the content of all globals is saved inside  $_ENV because ------
        //--- when joomla emulate "globals off" i.e define( 'RG_EMULATION', 0 );--
        //---- all vars from the script are destroyed ----------------------------
        
        //A call to isset($array[$var]) is a lot faster than in_array($var, array_keys($array))
        
        $_ENV['globalsBackup']= array();
        $excludeKeys= array (
                          'excludeKeys' => 1,
                          '_ENV'        => 1,
                          'GLOBALS'     => 1,
                          'key'         => 1,
                          'val'         => 1
                      );
                      
        foreach($GLOBALS as $key => $val) {
            if (!isset($excludeKeys[$key])) $_ENV['globalsBackup'][$key]=$val;
        }
        unset($excludeKeys);
        
        
        //-------- now let's affect the system a bit, do as if we were requesting ---
        //-------- the joomla index page with query string $joomQS ------------------
        $tmparray=array();
        parse_str($joomQS,$tmparray);
        
        $_POST = $_GET = $tmparray;
        $_REQUEST = array_merge($_COOKIE,$_GET); //preserve cookies
        
        $tmparray=parse_url($joomUrl);
        if (!isset($tmparray['path'])) $joombasepath="";
        else $joombasepath=rtrim($tmparray['path'],"/"); //rtrim , just in case ...
        
        $_SERVER['REQUEST_URI'] = $joombasepath . "/index.php?" . $joomQS;
        $_SERVER['SCRIPT_NAME'] = $_SERVER['PHP_SELF'] = $joombasepath . "/index.php";
        $_SERVER['QUERY_STRING'] = $joomQS;
        
        if (! @chdir($joomRel) ) //change current dir
            die("Unable to switch to Joomla dir<br>Is the provided relative path correct ?");
            
        if (!file_exists('./components/com_content/content.php'))
            die("Unable to detect Joomla install.<br /><br />
                According to the relative path you provided<br />
                Joomla's root should be:<br />"
                . "<b>". getcwd(). "</b><br /><br />".
                "If that's wrong, correct the relative path you provided."
               );
               
        //warning !! for consistency with $joomRel var, now I  append a slash at end of
        //value $scriptRel. Which means every code that use $scriptRel must be corrected
        
        //$scriptRel var will be used much later, don't forget to wrap it inside $_ENV
        $_ENV['globalsBackup']['scriptRel']= twoAbsToRel($tmpdir,getcwd(),1) . '/'; //let's get inverse relative path
        
        //A problem occurs when enabling "system cach plugin" (not caching in global configuration):
        //if page is already cached, joomla show cached page and exits, preventing any further execution
        //see file plugins\system\cache.php ...
        //To disable that plugin, I  "break" the test $_SERVER['REQUEST_METHOD'] == 'GET'
        //Notice that the test $requestMethod != 'POST' is also used to prevent spoofing
        //see file plugins\system\legacy\functions.php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' ) $_SERVER['REQUEST_METHOD'] = '';
        
        //--------------  joomla inclusion section ---------------------------------
        //from index2.php code
        if (!$joomIntegrate) $_REQUEST['tmpl'] = 'component';
        
        if (isset($_GET['option'])) {
            $option=$_GET['option'];
            if (strpos( $option, 'com_' ) !== 0)
                die("Invalid component, does not begin with com_");
            else
                if (!file_exists("./components/$option/" . substr($option,4) . ".php" ) )
                    die("<strong> Cannot find \"$option\" component .</strong><br />
                        Seems you need to install it first.");
        }
        
        //--------------- let's detect if community builder is present -----------------
        if (file_exists('./components/com_comprofiler/comprofiler.php')) {
            define('_CB_PROFILER_',true);
        }
        
        ob_start();
        include("./index.php");
        $joomlaOutput= ob_get_contents();
        ob_end_clean();
        
        //-------- check we didn't include wrong joomla version ---------------------
        if ( !defined('_JEXEC'))
            die('<b>Mistake !!!</b> The bridge used doesn\'t match your joomla version!
                (expected Joomla 1.5) <br> Please, correct settings using <a href="bridgemgr.php"> bridge manager </a>');
                
        //--------- now that we retrieved what we are interested in, ---------------
        //--------- let's restore globals + current dir ----------------------------
        foreach($_ENV['globalsBackup'] as $key => $val) {
            $GLOBALS[$key]=$val;
        }
        
        //--- because $_GET &  $_POST are the main array overwritten  -----------------------------
        //--- and then restored we take adavantage of Joomla's JRequest::_cleanArray function -----
        //--- to  check if these arrays weren't spoofed.-------------------------------------------
        //--- seems it's not necessary to check $_REQUEST according to ----------------------------
        //--- libraries\joomla\environment\request.php  -------------------------------------------
        
        JRequest::_cleanArray( $_GET );
        JRequest::_cleanArray( $_POST );
        
        if (! @chdir($tmpdir)) //restore previous dir
            die("Unable to go back to script folder");
            
        unset($_ENV['globalsBackup'], $key ,$val , $tmparray , $joombasepath, $tmpQSarr, $tmpdir); //let's forget that
    }//bloc for joomla job
    
//$$$$$$$$$$$$$$$$$$$$$$$$ end of Joomla Job  $$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

    destroy_superglobals(); //  the way cpg wanted it
    
    $scriptUrl=rtrim($CONFIG['site_url'],"/");
    $script_slash_path = getSlashPath($scriptUrl) . '/' ;
    
//------- now let's do a  minimal job with coppermine ------------------------------

    require_once 'bridge/udb_base.inc.php';
    
    class cpg_udb extends core_udb {
        function cpg_udb() {
            global $BRIDGE;
            
            //remark: $mosConfig_live_site == substr_replace(JURI::root(), '', -1, 1)
            //and  $BRIDGE[full_forum_url] should have the same value
            //according to plugins\system\legacy.php
            
            $this->boardurl = $BRIDGE['full_forum_url'];
            $this->use_post_based_groups = $BRIDGE['use_post_based_groups'];
            
            $this->multigroups = 0; //nope, each user belong to a single group
            $this->group_overrride = 1; //we use collect_groups func to synchronize user group table
            
            //Database connection settings
            //used to determine if coppermine can perform a join query
            //connection already done by joomla
            
            $joomConf=& JFactory::getConfig();
            
            $this->db = array(
                            'name' => $joomConf->getValue('config.db'),
                            'host' => $joomConf->getValue('config.host'),
                            'user' => $joomConf->getValue('config.user') ,
                            'password' => $joomConf->getValue('config.password'),
                            'prefix' => $joomConf->getValue('config.dbprefix')
                        );
                        
            // Board table names
            $this->table = array(
                               'users' => 'users',
                               'groups' => 'core_acl_aro_groups',
                               //   'sessions' => 'session'
                           );
                           
            // Derived full table names
            $this->usertable = '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['users'];
            $this->groupstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['groups'];
            // $this->sessionstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['sessions'];
            
            
            // Table field names
            $this->field = array(
                               'username' => 'username', // name of 'username' field in users table
                               'user_id' => 'id', // name of 'id' field in users table
                               'password' => 'password', // name of 'password' field in users table
                               'email' => 'email', // name of 'email' field in users table
                               'regdate' => 'UNIX_TIMESTAMP(registerDate)', // name of 'registered' field in users table
                               'lastvisit' => 'UNIX_TIMESTAMP(lastvisitDate)', // last time user logged in
                               'active' => '1-block', // is user account active?
                               'location' => "''", // name of 'location' field in users table
                               'website' => "''", // name of 'website' field in users table
                               'usertbl_group_id' => 'gid', // name of 'group id' field in users table
                               'grouptbl_group_id' => 'id', // name of 'group id' field in groups table
                               'grouptbl_group_name' => 'name' // name of 'group name' field in groups table
                           );
                           
            // Pages to redirect to
            $this->page = array();
            
            // Group ids - admin and guest only.
            $this->admingroups = array(24,25);
            $this->guestgroup = $this->use_post_based_groups ? 50 : 3; //50 is a value that does not conflict
            //with other existing groups
            
            // Connect to db
            $joomDb =&  JFactory::getDBO();
            if ($joomDb->name=='mysql') {
                $this->connect($joomDb->_resource); //re-use the already existing connection
            } else {
                $this->connect();
            }
            
            
            //no need to do session update, already done by joomla
        }//end of cpg_udb constructor
        
        //------------joomla groups don't change, so let's give them directly
        function collect_groups() {
            //------ actual joomla groups' values + 100
            $udb_groups = Array( $this->guestgroup => "Guests", 118 => "Registered" , 119 => "Author", 120 => "Editor", 121 => "Publisher", 123 => "Manager", 124 => "Administrator", 125 => "Super Administrator" );
            return $udb_groups;
        }
        
        //------------ function usertype_into_gid no more necessary ----------------
        //------------  just use :$user->get('gid') --------------------------------
        //------------- note: the old $my->gid is reached now by $user->get('aid') -
        
        //------------let's override the coppermine authenticate function ----------------------------------------------------
        //------------ this makes things much easier: no need to bother with cookies, session, or user password. sweet! ------
        
        function authenticate() {
            //well, the aim of this function is after all to convert data from "JFactory::getUser" object into "$USER_DATA"
            global $USER_DATA;
            
            $joomUser= & JFactory::getUser();
            if (!$joomUser->get('guest')) { //user connected
                //we don't call function load_user_data
                //we handle data directly
                
                $USER_DATA['user_id'] = $joomUser->get('id');
                $USER_DATA['user_name'] = $joomUser->get('username');
                $gid=100+$joomUser->get('gid');
                $supported_groups = Array(118,119,120,121,123,124,125);  //100 + numbers in core_acl_aro_groups table
                if (!in_array($gid,$supported_groups))
                    die("Non standard joomla group used. Sorry this is not supported by the bridge");
                    
                if ($this->use_post_based_groups) {
                    $USER_DATA['groups'] = array( 0 => $gid );
                } else {
                    $USER_DATA['groups'] = array( 0 => (in_array($gid-100,$this->admingroups) ? 1 : 2) );
                }
            }//end if user connected
            else { //this is a guest
                $this->load_guest_data();
            }//end if this is a guest
            
            //------ from here almost nothing is changed ------------
            
            $user_group_set = '(' . implode(',', $USER_DATA['groups']) . ')';
            $USER_DATA = array_merge($USER_DATA, $this->get_user_data($USER_DATA['groups'][0], $USER_DATA['groups'], $this->guestgroup));
            
            if ($this->use_post_based_groups) {
                $USER_DATA['has_admin_access'] = (in_array($USER_DATA['groups'][0] - 100,$this->admingroups)) ? 1 : 0;
            } else {
                $USER_DATA['has_admin_access'] = ($USER_DATA['groups'][0] == 1) ? 1 : 0;
            }
            
            $USER_DATA['can_see_all_albums'] = $USER_DATA['has_admin_access'];
            // avoids a template error
            if (!$USER_DATA['user_id']) $USER_DATA['can_create_albums'] = 0;
            // For error checking
            $CONFIG['TABLE_USERS'] = '**ERROR**';
            
            define('USER_ID', $USER_DATA['user_id']);
            define('USER_NAME', addslashes($USER_DATA['user_name']));
            define('USER_GROUP', $USER_DATA['group_name']);
            define('USER_GROUP_SET', $user_group_set);
            define('USER_IS_ADMIN', $USER_DATA['has_admin_access']);
            define('USER_CAN_SEND_ECARDS', (int)$USER_DATA['can_send_ecards']);
            define('USER_CAN_RATE_PICTURES', (int)$USER_DATA['can_rate_pictures']);
            define('USER_CAN_POST_COMMENTS', (int)$USER_DATA['can_post_comments']);
            define('USER_CAN_UPLOAD_PICTURES', (int)$USER_DATA['can_upload_pictures']);
            define('USER_CAN_CREATE_ALBUMS', (int)$USER_DATA['can_create_albums']);
            
            define('USER_ACCESS_LEVEL', (int)$USER_DATA['access_level']);
        }//end function authenticate
        
        //--------------- login function is used if you want to  connect to coppermine by using a third party tool --------
        //--------------- example: xp publish -----------------------------------------------------------------------------
        //--------------- also used by coppermine's default login page ----------------------------------------------------
        //--------------- solution is not obvious, so we won't allow this -------------------------------------------------
        function login( $username = null, $password = null, $remember = false ) {
            return false;
        }
        
        //------------------------------------------------
        //this function only exist because of swfupload and the flash cokie bug
        //nope I won't re-authenticate, just save and restore my cookies
        function get_user_pass($user_id) {
            $superCage = Inspekt::makeSuperCage();
            return($superCage->cookie->_source);
        }
        
        
        //-------- we use the joomla login page , can't use coppermine's one ---------
        //----------------------------------------------------------------------------
        function login_page() {
            global $joomUrl,$script_slash_path;
            $target=  '';
            if (defined('_CB_PROFILER_')) { //cb login page
                $target ='/index.php?option=com_comprofiler&task=login';
                //return value can't be pased with $_GET
            }//end if cb login page
            else {//standard joomla login page
                $target ='/index.php?option=com_user&view=login';
                $target .='&return=' . base64_encode($script_slash_path);
            }//end if standard joomla login page
            $this->redirect($target);
        }//end function login_page
        
        function logout_page() {
            global $joomUrl,$script_slash_path;
            $target='';
            if (defined('_CB_PROFILER_')) {//cb logout
                $target ='/index.php?option=com_comprofiler&task=logout';
                //return value can't be pased with $_GET
            }//end if cb logout
            else { //standard joomla logout
                $target='/index.php?option=com_user&task=logout';
                $target .='&return=' . base64_encode($script_slash_path);
            } //end if standard joomla logout
            $this->redirect($target);
        }//end function logout_page
        
        function register_page() {
            $target='';
            if (defined('_CB_PROFILER_')) {
                $target ='/index.php?option=com_comprofiler&task=registers';
            } else {
                $target ='/index.php?option=com_user&task=register';
            }
            $this->redirect($target);
        }
        
        function edit_profile() {
            $target='';
            if (defined('_CB_PROFILER_')) {
                $target='/index.php?option=com_comprofiler&task=UserDetails';
            } else {
                $target='/index.php?option=com_user&view=user&task=edit&Itemid=0';
            }
            $this->redirect($target);
        }
        
        function view_users() {} //disable a redirection... where is this one ?
        function view_profile() {} //disable a redirection... where is this one ?
        
        //---------- let's override get_users function --------------------
        //---------- two reasons: if we use separate joomla/cpg databases -
        //---------- and if use_post_based_groups set to 0 ----------------
        //-------- adaptation from punbb12.php function -------------------
        
        function get_users($options = array()) {
            global $CONFIG;
            
            // Copy UDB fields and config variables (just to make it easier to read)
            $f =& $this->field;
            $C =& $CONFIG;
            
            // Sort codes
            $sort_codes = array('name_a' => 'user_name ASC',
                                'name_d' => 'user_name DESC',
                                'group_a' => 'group_name ASC',
                                'group_d' => 'group_name DESC',
                                'reg_a' => 'user_regdate ASC',
                                'reg_d' => 'user_regdate DESC',
                                'pic_a' => 'pic_count ASC',
                                'pic_d' => 'pic_count DESC',
                                'disku_a' => 'disk_usage ASC',
                                'disku_d' => 'disk_usage DESC',
                                'lv_a' => 'user_lastvisit ASC',
                                'lv_d' => 'user_lastvisit DESC',
                               );
                               
            if (in_array($options['sort'], array('group_a', 'group_d', 'pic_a', 'pic_d', 'disku_a', 'disku_d'))) {
            
                $sort = '';
                list($this->sortfield, $this->sortdir) = explode(' ', $sort_codes[$options['sort']]);
                $this->adv_sort = true;
                
            } else {
            
                $sort = "ORDER BY " . $sort_codes[$options['sort']];
                $this->adv_sort = false;
            }
            
            // Build WHERE clause, if this is a username search
            if ($options['search']) {
                $options['search'] = 'WHERE u.'.$f['username'].' LIKE "'.$options['search'].'" ';
            }
            
            $sql = "SELECT group_id, group_name, group_quota FROM {$C['TABLE_USERGROUPS']}";
            
            $result = cpg_db_query($sql);
            
            $groups = array();
            
            while ($row = mysql_fetch_assoc($result)) {
                $groups[$row['group_id']] = $row;
            }
            
            $sql ="SELECT {$f['grouptbl_group_id']} FROM {$this->groupstable}";
            
            $result = cpg_db_query($sql, $this->link_id);
            $udb_groups = array();
            
            while ($row = mysql_fetch_assoc($result)) {
                $udb_groups[] = $row['group_id'];
            }
            
            
            $sql = "SELECT u.{$f['user_id']} as user_id, u.{$f['usertbl_group_id']} AS user_group, {$f['username']} as user_name, {$f['email']} as user_email, {$f['regdate']} as user_regdate, {$f['lastvisit']} as user_lastvisit, '' as user_active, 0 AS pic_count ".
                   "FROM {$this->usertable} AS u ".
                   $options['search'] .
                   $sort .
                   " LIMIT {$options['lower_limit']}, {$options['users_per_page']}";
                   
            $result = cpg_db_query($sql, $this->link_id);
            
            // If no records, return empty value
            if (!mysql_num_rows($result)) {
                return array();
            }
            
            // Extract user list to an array
            while ($user = mysql_fetch_assoc($result)) {
                if ($this->use_post_based_groups) {
                    $gid = $user['user_group'] +100;
                } else {
                    $gid = in_Array($user["user_group"], $this->admingroups) ? 1 : 2;
                }
                $userlist[$user['user_id']] = array_merge($user, $groups[$gid]);
                $users[] = $user['user_id'];
            }
            
            $user_list_string = implode(', ', $users);
            
            $sql = "SELECT owner_id, COUNT(pid) as pic_count, ROUND(SUM(total_filesize)/1024) as disk_usage FROM {$C['TABLE_PICTURES']} WHERE owner_id IN ($user_list_string) GROUP BY owner_id";
            
            $result = cpg_db_query($sql);
            
            while ($owner = mysql_fetch_assoc($result)) {
                $userlist[$owner['owner_id']] = array_merge($userlist[$owner['owner_id']], $owner);
            }
            
            if ($this->adv_sort) usort($userlist, array('cpg_udb', 'adv_sort'));
            
            return $userlist;
        }//end function get_users
    }//end class cpg_udb
    
    
// and go !
    $cpg_udb = new cpg_udb;
    
}//end if NOT isset($bridge_lookup)