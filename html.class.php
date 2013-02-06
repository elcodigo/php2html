<?php
/**
 * Class for creating a web page using only PHP. 
 * It supports connections to MySQL, Oracle and SQL Server. 
 * Allowing automate the creation of a complete website in a few lines of code.
 * 
 * @todo Add HTML5 support
 * @package PHP2HTML
 * @version    1.0 BETA
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
ini_set( 'display_errors', 1 );
error_reporting(0);

set_exception_handler('captureException');
register_shutdown_function('captureShutdown');

require_once 'html.def.php';
require_once 'html.attributes.php';
require_once 'html.attributes.ext.php';
require_once 'html.actions.php';


/**
 * Class for creating a web page using only PHP. 
 * It supports connections to MySQL, Oracle and SQL Server. 
 * Allowing automate the creation of a complete website in a few lines of code.
 * 
 * 
 * @todo Code optimization
 * @package PHP2HTML
 * @version    1.0
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
class PHP2HTML{
    
    /**
     * Determines whether the class is in development mode.
     * This allows you to show or hide the errors.
     * 
     * @var Boolean 
     */
    private $DevelopMode;
    /**
     * Connection Type
     *
     * @var string Connection Type 
     */
    private $connType;
    /**
     * DocType
     *
     * @var string DocType
     */
    private $docType;
    /**
     * Array for Meta tags
     *
     * @var array Meta tags
     */
    private $meta_array = array();    
    /**
     * Array with the CSS Files added
     *
     * @var array CSS Files 
     */
    private $css_array = array();
    /**
     * Array with the JS Files added
     *
     * @var array JS Files
     */
    private $js_array = array();
    /**
     * Css Styles added
     *
     * @var string CSS styles
     */
    private $css_style = array();
    /**
     * Header section (Js, CSS, Styles, Meta tags)
     *
     * @var string Header section 
     */
    private $head_scr = '';
    /**
     * Body section
     *
     * @var string Body section
     */
    private $body_doc = '';
    /**
     * The css class for body tag
     *
     * @var string CSS body
     */
    private $body_class='';
    /**
     * 
     * This is the active connection object
     * 
     * @var object $Cnn Connection object
     */
    public  $Cnn;    
    /**
     * Time when the class starts
     * @var time 
     */
    private $start;  
   
    /**
     * The time that the class is started.
     */
    function Start(){
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $this->start = $time;    
    }
    /**
     * Time when the class ends
     */
    function Ends(){
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $this->start), 4);
        echo BK.'<!--Page generated in '.$total_time.' seconds.-->'; 
    }
    /**
     * Initialize the class and set default meta data, css and js defined in html.var.php
     * 
     * @param boolean $mode
     */    
    function __construct($mode=DEVELOP){ 
        set_error_handler(array( $this, 'handleBasicError' ));                  
        $this->Start();
        $this->DevelopMode = $mode;
        $this->docType(DOC_TYPE);
        $this->Set_Meta();        
        $this->setConnType();
    }    
    /**
     * Ends the connection associated to class     
     */
    function __destruct() {
        $this->letConnection();
        $this->Ends();
              
    }
    /**     
     * Set the database connection used in the class.
     * The class can use different connections types 
     * for example switching from Oracle to MySql and then 
     * to a Sql Server connection and retrieve data 
     * from diferent sources for different parts of the page.
     * This use is restricted to only one connection at time
     * 
     * Example:
     * <code>
     * $p = new PHP2HTML();
     * 
     * //Set the parameters at execution time
     * $p->setConnection("MyServer", "MyUser", "MyPass", "MyDB");
     * 
     * //Use the default parameters stored in html.var.php
     * $p->setConnection();
     * </code>
     * 
     * This variables could be set by default in the <strong>html.var.php</strong> 
     * and changed at execution time.
     * 
     * @todo Add PostegreSQL support
     * @param String $dbHost  Database Host 
     * @param String $db_User Database User
     * @param String $db_Pass User database Password
     * @param String $db_Database Database name
     * @param Boolean $db_persist Connection persistant
     * 
     */
    function setConnection($dbHost = DB_HOST, $db_User = DB_USER, $db_Pass = DB_PASS, $db_Database = DB_DATABASE, $db_persist = DB_PERSIST){
        if($this->connType=='none'){
            $this->letConnection();
            $this->Cnn = null;
        }elseif($this->connType=='mssql'){
            $this->Cnn = null;
            require_once 'mssql.class.php'; 
            $this->Cnn = new mssqlConn($this, $dbHost, $db_Database, $db_User, $db_Pass, $db_persist);            
        }elseif($this->connType=='mysql'){
            $this->Cnn = null;
            require_once 'mysql.class.php';            
            $this->Cnn = new mysqlConn($this, $dbHost, $db_Database, $db_User, $db_Pass, $db_persist);
        }elseif($this->connType=='mysqli'){
            $this->Cnn = null;
            require_once 'mysqli.class.php';            
            $this->Cnn = new mysqliConn($this, $dbHost, $db_Database, $db_User, $db_Pass, $db_persist);            
        }elseif($this->connType=='oracle'){
            $this->Cnn = null;
            require_once 'oracle.class.php';
            $this->Cnn = new oracleConn($this, $dbHost, $db_Database, $db_User, $db_Pass, $db_persist);
        }else{
            $this->Cnn = null;
        }
    }
    /**
     * Close the active connection
     * 
     * @return null 
     */
    private function letConnection(){
        if($this->Cnn!=null){
            $this->Cnn->Close();
        }
    }    
    /**
     * Sets the connection type that will be used to populate the 
     * contents of the page (none,mssql,oracle, mysql, mysqli).
     * Is limited to one connection at time
     * Example:
     * 
     * <code>
     *  $p->setConnType('mysqli');
     * </code>
     * 
     * @param string $connType mysql|mysqli|oracle|mssql
     */
    function setConnType($connType=CON_TYPE){
        $this->connType=$connType;        
    }
    /**
     * Returns the connection object
     *
     * Example:
     * <code>
     *  $myconn = $p->getConn();
     * </code>
     * 
     * @return object Returns the connection object
     */
    function getConn(){
        return $this->Cnn;
    }
    /**
     * Gets the connection type that will be used to populate the contents of the page
     * (none, mssql, mysql, oracle and mysqli)
     * 
     * Example:
     * <code>
     *  $p->setConnType("oracle");
     *  $connType = $p->getConn();
     *  echo $connType;
     *  //Prints Oracle
     * </code>
     * 
     * @return String Returns the active connection Type
     */    
    function getConnType(){
        return $this->connType;
    }    
    /**
    * Sets the new DocType HTML document (Transitional, Estrict, ETC)
    * Example:
    * 
    * <code>
    *   $newDocType='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN..."';
    *   $p->docType($newDocType);
    * </code> 
     * 
    * @param string $newDocType
    */
    function doctype($newDocType){
        $this->docType = $newDocType;
    }
    /**
     * Sets the Body Class
     *   
     * Example:
     * 
     * <code>
     *  $p->BodyClass("myBodyClass");
     * </code>
     * 
     * @param string $class
     */
    function BodyClass($class){
        $this->body_class.=" ".$class;
    }
    /**     
     * Add the meta data defined by user in execution time 
     * or defined in html.var.php
     * 
     * Example:
     * 
     * <code>
     *  $p->Set_Meta("New Title for the page");
     * </code>
     *  
     * @param string $meta_title
     * @param string $meta_content
     * @param string $meta_charset     
     * @param string $meta_description
     * @param string $meta_keywords
     * @param string $meta_author
     * @param string $meta_robots
     * 
     * This variables could be set by default in the <strong>html.var.php</strong> 
     * and changed at execution time.
     */
    function Set_Meta($meta_title = META_TITLE, $meta_content = META_CONTENT, $meta_charset = META_CHARSET, $meta_description = META_DESC, $meta_keywords = META_KEYWORD, $meta_author = META_AUTHOR, $meta_robots = META_ROBOTS){        
        $this->meta_array['m_lang']   =  HTML_LANG;
        $this->meta_array['m_contnt'] =  $meta_content;
        $this->meta_array['m_charst'] =  $meta_charset;
        $this->meta_array['m_ptitle'] =  $meta_title;
        $this->meta_array['m_descri'] =  $meta_description;
        $this->meta_array['m_keywor'] =  $meta_keywords;
        $this->meta_array['m_author'] =  $meta_author;
        $this->meta_array['m_robots'] =  $meta_robots;                
    }
    /**
     * Add a user defined meta data definition
     *           
     * @param String $meta Meta Name
     * @param String $description Meta Description
     */
    function Add_MetaData($meta, $description){
        $this->meta_array[$meta] = $description;
    }
    /**
     * Add a style to the header
     * 
     * Example:
     * 
     * <code>
     *  $myStyle= 'input{text-align:center;}';
     *  $p->Style($myStyle);     
     * </code>
     * 
     * @param String $style
     */
    function Add_Style($style){
        array_push($this->css_style,$style);         
    }
    /**
     * Return to the user an array with the meta data definitions
     *
     * Example:
     * 
     * <code>
     *  $myMeta= $p->Return_Meta();
     *  print_r($myMeta);
     * </code>
     * 
     * @return Array Returns array containing the meta tags
     */
    function Return_Meta(){        
        return $this->meta_array;
    }
    /**
     * Add a CSS file to the headers. 
     * If the file does not exists adds a comment
     * 
     * Example:
     * 
     * <code>
     *  $p->CSS('css/styles.css');     
     * </code>
     * 
     * @param string Add the css link to the header
     */
    function CSS($cssfile=""){        
        if(checkCurl()){            
            if(!strstr($cssfile,"http")){                
                if(file_exists($cssfile)){
                    $cssfile = '<link type="text/css" rel="stylesheet" href="'.$cssfile.'"/>';
                    array_push($this->css_array, $cssfile);
                }else{
                    $this->Comment("The local file $cssfile does not exists");
                }
            }else{
                if($this->remoteFileExists($cssfile)){
                    $cssfile = '<link type="text/css" rel="stylesheet" href="'.$cssfile.'"/>';
                    array_push($this->css_array, $cssfile);
                }else{
                    $this->Comment("The external file $cssfile does not exists");
                }
            }            
        }else{
            if(!strstr($cssfile,"http")){
                $cssfile = '<link type="text/css" rel="stylesheet" href="'.$cssfile.'"/>';
                array_push($this->css_array, $cssfile);
            }else{                
                $this->Comment("The file $cssfile is external an CURL is deactivated");
                $cssfile = '<link type="text/css" rel="stylesheet" href="'.$cssfile.'"/>';
                array_push($this->css_array, $cssfile);
            }
        }
         
    }
    /**
     * Return to the user the CSS files added
     *
     * Example:
     * 
     * <code>
     *  $myCSSFiles= $p->Return_CSS();
     *  print_r($myCSSFiles);
     * </code>
     * 
     * @return Array Returns array containing the css files added
     */
    function Return_CSS(){
        return $this->css_array;
    }
    /**
     * Add a JS file to the page header
     * If the file does not exists adds a comment
     * 
     * Example:
     * 
     * <code>
     *  $p->JS('http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');     
     * </code>
     * 
     * @param string $jsfile
     */
    function JS($jsfile){
        if(checkCurl()){            
            if(!strstr($jsfile,"http")){
                if(file_exists($jsfile)){
                    $jsfile = '<script type="text/javascript" src="'.$jsfile.'"></script>';
                    array_push($this->js_array, $jsfile);
                }else{
                    $this->Comment("The local file $jsfile does not exists");
                }
            }else{
                if($this->remoteFileExists($jsfile)){
                    $jsfile = '<script type="text/javascript" src="'.$jsfile.'"></script>';
                    array_push($this->js_array, $jsfile);
                }else{
                    $this->Comment("The external file $jsfile does not exists");
                }
            }            
        }else{
            if(!strstr($jsfile,"http")){
                $jsfile = '<script type="text/javascript" src="'.$jsfile.'"></script>';
                array_push($this->js_array, $jsfile);
            }else{                
                $this->Comment("The file $jsfile is external an CURL is deactivated");
                $jsfile = '<script type="text/javascript" src="'.$jsfile.'"></script>';
                array_push($this->js_array, $jsfile);
            }
        }
    }
    /**
     * Returns the array whitch contains the js libraries imported
     * 
     * Example:
     * 
     * <code>
     *  $myJSFiles= $p->Return_JS();
     *  print_r($myJSFiles);
     * </code>
     * 
     * @return array Returns array containig the JS files added
     */
    function Return_JS(){
        return $this->js_array;
    }
    
    /**
     * Create de Page with the user defined contents
     * 
     * @todo Validate and complete or remove this function
     * @deprecated since version 0.1 alpha
     * @param String $Template  
     */
    function CreateFromTemplate($Template){
        $result = file_get_contents($Template);
        $result = str_replace('{d_type}',DOC_TYPE, $result);
        $meta_tag = $this->Return_Meta();   
        
        foreach ($meta_tag as $key=>$value) {
            $result = str_replace('{'.$key.'}', $value, $result);
        }
        foreach($this->Return_CSS() as $value){
            $result = str_replace('</head>',$value.BK."</head>".BK, $result);
        }
        foreach($this->Return_JS() as $value){
            $result = str_replace('</head>',$value.BK."</head>".BK, $result);
        }        
        $result = ($this->head_scr=='' ? $result : str_replace('</head>','<script type="text/javascript">'.$this->head_scr.BK."</script>".BK."</head>".BK, $result));
        $result = ($this->body_doc=='' ? $result : str_replace('</body>',$this->body_doc.BK."</body>".BK, $result));
        print $result;
    }
    /**
     * Append an HTML Comment to the body
     * 
     * Example:
     * 
     * <code>
     *  $p->Comment('This is a HTML Comment');
     * </code>
     * 
     * @param String $comment
     */
    function Comment($comment){
        $this->body_doc = $this->body_doc .BK.'<!--'.$comment.'-->';
    }
    /**
     * Append an HTML tag/string to the body
     * Example:
     * 
     * <code>
     *  $p->Body('Add something to the body');
     *  $p->Body('<span>Add something more to the body</span>');
     * </code>
     *  
     * @param string $htmlTags
     */
    function Body($htmlTags){
        $this->body_doc = $this->body_doc . $htmlTags;
    }
     /**     
     * Append a file content to the body
     * 
     * Example:
     * 
     * <code>
     *  $p->File('contents/myFile.txt');
     *  $p->File('../libs/myLib.js');
     * </code>
     * 
     * @param string $file 
     */    
    function File($file){        
        $result = htmlspecialchars(utf8_decode(file_get_contents($file)));        
        if($result){
            $this->body_doc = $this->body_doc .BK. $result;        
        }else{
            $this->Comment("Error reading the file: $file");
        }
    }
    /**     
     * Append a html file content to the body
     * 
     * Example:
     * 
     * <code>
     *  $p->HTML('contents/myPage.htm');
     *  $p->HTML('../libs/other.html');
     * </code>
     * 
     * @param string $file 
     */    
    function HTML($file){        
        $result = utf8_decode(file_get_contents($file));
        if($result){
            $this->body_doc = $this->body_doc .BK. $result;        
        }else{
            $this->Comment("Error reading the file: $file");
        }
    }
    /**
     * Append a php file
     * 
     * Example:
     * 
     * <code>
     *  $p->AddPHP('myfunctions.php');     
     * </code>
     * 
     * @param String $file
     */
    function AddPHP($file){
        ob_start();
        include($file);
        $returned = ob_get_contents();        
        ob_end_clean();        
        $this->body_doc = $this->body_doc .BK. $returned;
    }
    /**
     * Append a Javascript Code
     * 
     * Example:
     * 
     * <code>
     *  $myCode = '$("#target").click(function() {
     *      alert("Handler for .click() called.");
     *  });';
     *  $p->AddJS($myCode);
     * </code>
     * 
     * @param String Add a javascript code to the header
     */
    function AddJS($code){
        $this->head_scr = $this->head_scr.BK.$code.BK; 
    }
    /**
     * Add a html break line
     * 
     * @param int $c The number of html breaks
     */
    function HTMLbr($c=1){
        for($i=0;$i<$c;$i++){
            $this->body_doc = $this->body_doc.BK.br_;
        }
    }
    /**
     * Append a Form tag to the body
     * 
     * Example:
     * 
     * <code>
     *  $frmObj = $p->Text("", "", "txtName", "txtName");
     *  $frmObj.= $p->Pswd("", "", "txtPass", "txtPass");
     *  $frmObj.= $p->Btn(ST, "Go...");
     *  $p->Body($p->Form("myForm","POST","response.php", $frmObj));
     * </code>
     * 
     * @param String $name Form Name
     * @param String $method Method Form POST/GET
     * @param string   $action Default Action
     * @param String $objects Objects 
     * @param String $properties
     * @return String
     */
    function Form($name = "", $method = "", $action = "", $objects = "", $properties=""){        
        $form = $this->iT(form_, name($name). method($method). action($action). $properties);
        $form.= BK. $objects;
        $form.=_form;
        return $form;
    }    
    /**
     * Returns the Password input
     * 
     * Example:
     * 
     * <code>
     *  $frmObj = $p->Text("", "25", "", "txtName", "txtName");
     *  $frmObj.= $p->Pswd("", "20", "", "txtPass", "txtPass");
     *  $frmObj.= $p->Btn(ST, "Go...");
     *  $p->Body($p->Form("myForm","POST","response.php", $frmObj));
     * </code>
     *  
     * @param String $value
     * @param String $size
     * @param String $class
     * @param String $id
     * @param String $name
     * @param String $properties
     * @return String
     */
    function Pswd($value="", $size="", $class="", $id="", $name="", $properties=""){
        $Pswd = '<input type="password"';
        $Pswd.= size($size);
        $Pswd.= cClass($class);
        $Pswd.= id($id);
        $Pswd.= name($name);
        $Pswd.= ($properties==""? "":' '.$properties);
        $Pswd.= value($value);
        $Pswd.='>';
        return $Pswd.BK;
    }
    /**
     * Returns the Input text field
     * 
     * Example:
     * 
     * <code>
     *  $frmObj = $p->Text("", "25", "", "txtName", "txtName");
     *  $frmObj.= $p->Pswd("", "20", "", "txtPass", "txtPass");
     *  $frmObj.= $p->Btn(ST, "Go...");
     *  $p->Body($p->Form("myForm","POST","response.php", $frmObj));
     * </code>
     * 
     * @param String $value
     * @param String $size 
     * @param String $class
     * @param String $id
     * @param String $name
     * @param String $properties
     * @return String
     */
    function Text($value="", $size="", $class="",$id="", $name="", $properties=""){
        $Text = '<input type="text"';
        $Text.= size($size);
        $Text.= cClass($class);
        $Text.= id($id);
        $Text.= name($name);
        $Text.= ($properties==""? "":' '.$properties);
        $Text.= value($value);
        $Text.= '>';
        return $Text.BK;        
    }
    /**
     * Returns a table
     * 
     * @param String $data
     * @param String $class
     * @param String $id
     * @param String $name
     * @param String $properties
     * @return String
     */
    function tableField($data="", $class="",$id="", $name="", $properties=""){
        $table = '<table ';        
        $table.= cClass($class);
        $table.= id($id);
        $table.= name($name);
        $table.= ($properties==""? "":' '.$properties);        
        $table.= '>';
        $table.= $data;
        $table.= _table;
        return $table;
    }
    /**
     * Returns the table header
     * 
     * @todo Complete the function
     * 
     * @param String $class
     * @param String $id
     * @param String $name
     * @param String $properties
     * @return String
     */
    function tableHead($class="",$id="", $name="", $properties=""){    
        return $tHead;
    }
    /**
     * Returns the table body
     * 
     * @todo Complete the function
     * 
     * @param String $class
     * @param String $id
     * @param String $name
     * @param String $properties
     * @return String
     */
    function tableBody($class="",$id="", $name="", $properties=""){        
        return $tBody;
    }
    /**
     * Returns the table footer
     * 
     * @todo Complete the function
     * 
     * @param String $class
     * @param String $id
     * @param String $name
     * @param String $properties
     * @return String
     */
    function tableFoot($class="",$id="", $name="", $properties=""){        
        return $tFoot;        
    }
    /**
     * Convert a query to table
     * 
     * 
     * @param String $caption
     * @param String $class
     * @param String $id
     * @param String $name
     * @param String $properties
     * @return String
     */
    function query2Table($caption="",$class="",$id="", $name="", $properties=""){        
        if($this->connType=='none'){
            $this->Comment("There is no valid resource to create the table.");
            return null;
        }else{        
            $cols = $this->Cnn->numColumns();
            $rows = $this->Cnn->numRows();
            $table_cols = "";
            $table_rows = "";
            $table = $this->iT(table_, 
                    cClass($class). 
                    id($id).
                    name($name).
                    ' '. $properties);            
            $table.= ($caption== "" ? "": capt_  . $caption . _capt);
            $n = 0; 
            while($this->Cnn->Fetch(false)){                
                if($n==0){
                    if($this->connType=='mssql'){
                        $table_cols = tr_;
                        for($i=0;$i<$cols;$i++){
                            $finfo = mssql_fetch_field($this->Cnn->rs,$i);
                            $table_cols.=th_.$finfo->name._th;
                        }
                        $table_cols.= _tr;
                    }elseif($this->connType=='mysql'){
                        $table_cols = tr_;
                        for($i=0;$i<$cols;$i++){
                            $finfo = mysql_fetch_field($this->Cnn->rs,$i);
                            $table_cols.=th_.$finfo->name._th;
                        }
                        $table_cols.= _tr;
                    }elseif($this->connType=='mysqli'){
                        $table_cols = tr_;
                        while ($finfo = mysqli_fetch_field($this->Cnn->rs)) {
                            $table_cols.=th_.$finfo->name._th;
                        }
                        $table_cols.= _tr;
                    }elseif($this->connType=='oracle'){                        
                        $table_cols = tr_;
                        for($i=0;$i<$cols;$i++){
                            $finfo = oci_field_name($this->Cnn->rs,$i);
                            $table_cols.=th_.$finfo->name._th;
                        }
                        $table_cols.= _tr;
                    }
                }
                $table_rows.= tr_;
                for($colx=0; $colx<$cols; $colx++){
                    $table_rows.= td_ . $this->Cnn->row[$colx] ._td;
                }                
                $table_rows.= _tr;                
                $n++;
            }
            $table.=$table_cols.$table_rows._table;
            return $table;
        }
    }
    /**
     * Converts an array to table
     * 
     * @todo Complete the function
     * 
     * @param array $data
     * @param array $ColsName
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function arrayToTableData($data=array(), $ColsName=array(), $class="",$id="", $name="", $properties=""){
        return $table;
    }
    /**
     * Converts a database recordset in array
     * 
     * @param object $result
     * @return array
     */
    function db_result_array_values($result) {
        $type=$this->getConnType();
        if($type=='mysql'){
            for ($array = array(); $row = mysql_fetch_row($result); isset($row[0]) ? $array[$row[0]] = $row[1] : $array[] = $row[1]); 
        }elseif($type=='mysqli'){
            for ($array = array(); $row = mysqli_fetch_row($result); isset($row[0]) ? $array[$row[0]] = $row[1] : $array[] = $row[1]); 
        }elseif($type=='mssql'){
            for ($array = array(); $row = mssql_fetch_row($result); isset($row[0]) ? $array[$row[0]] = $row[1] : $array[] = $row[1]); 
        }elseif($type=='oracle'){
            for ($array = array(); $row = oci_fetch_row($result); isset($row[0]) ? $array[$row[0]] = $row[1] : $array[] = $row[1]); 
        }
        return $array; 
    } 

    /**
     * Returns a Combo witch is populated from an array
     * 
     * Example:
     * <code>
     * $data = array();
     * 
     * for($i=1;$i<=10;$i++){
     *      array_push($data, "Option ".$i);
     * }     
     * 
     * $p->Body($p->Combo($data));
     * </code>
     * 
     * @param array $data
     * @param bool $recordset
     * @param string $selected
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function Combo($data = array(), $recordset = false, $selected="", $class="",$id="", $name="", $properties=""){
        $combo = $this->iT(select_, 
                    cClass($class).
                    id($id).
                    name($name).
                    ($properties==""? "":' '.$properties)
                ).BK;
        if($recordset==true){
            $data = $this->db_result_array_values($data);
        }        
        if($selected == ""){              
            $combo.= $this->iT(opt_, id("-1").selected_).SELECT_DEFAULT._opt;
            foreach($data as $key=>$value){
                $combo.= $this->iT(opt_, id($key)).$value._opt;                
            }
        }else{
            $combo.= $this->iT(opt_, id("-1")).SELECT_DEFAULT._opt;          
            foreach($data as $key=>$value){
                if($selected == $key){                    
                    $combo.= $this->iT(opt_, id($key).selected_).$value._opt;
                }else{
                    $combo.= $this->iT(opt_, id($key)).$value._opt;                    
                }
            }            
        }
        $combo.=_select;
        return $combo;
    }
    /**
     * Returns a Check element
     * 
     * Example:
     * 
     * <code>
     *  $lb = $p->lblFor("Checkbox","chjs");
     *  $cj = $p->Check("ON", "chjs", "chjs", true, false);     
     *  $p->Body($lb.$cj);
     * </code>
     * 
     * @param string $value
     * @param boolean $checked
     * @param boolean $disabled
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function Check($value ="", $checked=false, $disabled=false, $class="", $id="", $name="", $properties=""){
        $check = '<input type="checkbox"';
        $check.= cClass($class);
        $check.= id($id);
        $check.= name($name);
        $check.= ($properties==""? "":' '.$properties); 
        $check.= ' value="'.$value.'">';
        $check = ($checked ==false ? $check : str_replace('>',checked_.'>', $check));
        $check = ($disabled==false ? $check : str_replace('>',disabled_.'>', $check));
        return $check.BK;
    }
    /**
     * Returns a ratio element
     * 
     * Example:
     * 
     * <code>
     *  $lb = $p->lblFor("Ratio button","rtbt");
     *  $rt = $p->Ratio("ON", "rtbt", "rtbt", true, false);     
     *  $p->Body($lb.$rt);
     * </code>
     * 
     * @param string $value
     * @param boolean $checked
     * @param boolean $disabled
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function Ratio($value ="", $checked=false, $disabled=false, $class="", $id="", $name="", $properties=""){
        $radio = '<input type="radio"';
        $radio.= value($value);
        $radio.= cClass($class);
        $radio.= id($id);
        $radio.= name($name);
        $radio.= ($properties==""? "":' '.$properties); 
        $radio.= '>';         
        $radio = ($checked ==false ? $radio : str_replace('>',checked_.'>', $radio));
        $radio = ($disabled==false ? $radio : str_replace('>',disabled_.'>', $radio));
        return $radio;
    }
    /**
     * Returns a Textarea Element
     * 
     * Example:
     * 
     * <code>  
     *  $p->Body($p->Area());
     * </code>
     * 
     * @param string $value
     * @param int $rows
     * @param int $cols
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function Area($value ="", $rows=AREA_ROWS, $cols=AREA_COLS, $class="", $id="", $name="", $properties=""){
        $area = '<textarea rows="'.$rows.'" cols="'.$cols.'" ';        
        $area.= cClass($class);
        $area.= id($id);
        $area.= name($name);
        $area.= ($properties==""?"":' '.$properties); 
        $area.= '>';
        $area.= $value;
        $area.= '</textarea>';
        return $area.BK;
    }
    /**
     * Returns a Button element
     * 
     * Example:
     * 
     * <code>  
     *  $buttons = $p->Btn(BT, "I'm a normal button","myClass") .
     *                $p->Btn(ST, "I'm a submit button") .
     *                $p->Btn(RT, "I'm a reset button");
     *  $p->Body($buttons);     
     * </code>
     *
     * @param string $type
     * @param string $value
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function Btn($type=BT, $value="", $class="", $id="", $name="", $properties=""){
        $button ='<button type="'.$type.'"';
        $button.= cClass($class);
        $button.= id($id);
        $button.= name($name);
        $button.= ($properties  == "" ? "" : ' '.$properties);
        $button.= '>'.$value.'</button>';
        return $button.BK;
    } 
    /**
     * Returns a Input element
     * 
     * Example:
     * 
     * <code>  
     *  $inputs = $p->Inp(BT, "I'm a normal input","myClass") .
     *                $p->Inp(ST, "I'm a submit input") .
     *                $p->Inp(RT, "I'm a reset input");
     *  $p->Body($inputs);     
     * </code>
     *
     * @param string $type
     * @param string $value
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function Inp($type=BT, $value="", $class="", $id="", $name="", $properties=""){
        $inp = '<input type="'.$type.'"';
        $inp.= cClass($class);
        $inp.= id($id);
        $inp.= name($name);
        $inp.= ($properties == "" ? "" : ' '.$properites);
        $inp.= value($value);
        $inp.= '/>';
        return $inp.BK;
    }
    /**
     * Returns a label element
     * 
     * Example:
     * 
     * <code>  
     *  $lb = $newPage->lblFor("This is the label for Ratio button","rtbt");
     *  $rt = $newPage->Ratio("ON", "rtbt", "rtbt", true, false);     
     *  $p->Body($lb.$rt);    
     * </code>
     * 
     * @param string $value
     * @param string $tag
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function lblFor($value="", $tag ="", $class="", $id="", $name="", $properties=""){
        $label = '<label for="'.$tag.'"';
        $label.= cClass($class);
        $label.= id($id);
        $label.= name($name);
        $label.= ($properties==""?"":' '.$properties);
        $label.= '>'.$value._lbl;        
        return $label.BK;
    }
    /**
     * Returns an ordered/unordered list
     * 
     * Example:
     * 
     * <code>  
     *  $data = array();
     *  for($i=1;$i<=10;$i++){
     *     array_push($data, "Option ".$i);
     *  }
     *  $p->Body($p->listUi($data, false, "unorderedList"));
     *  $p->Body($p->listUi($data, true, "orderedList"));
     * </code>
     * 
     * @param array $data
     * @param boolean $ordered
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function listUi($data=array(), $ordered=false, $class="", $id="", $name="", $properties=""){        
        $list = ($ordered== true?'<ol':'<ul');
        $list.= cClass($class);        
        $list.= id($id);
        $list.= name($name);
        $list.= ($properties==""?"":' '.$properties);
        $list.= '>'.BK;        
        foreach($data as $key=>$value){            
            $list.= $this->iT(li_,id($key)).$value._li.BK;            
        }
        $list.=($ordered==true ? _ol : _ul);
        return $list.BK;
    }
    /**
     * Returns a file input element
     * 
     * Example:
     * 
     * <code>       
     *  $p->Body($p->FileInput("upload"));     
     * </code>
     * 
     * @param String $name
     * @param String $width
     * @param boolean $enabled
     * @return String
     */
    function FileInput($name="", $width="", $enabled=true){
        $fileInp = '<input type="file"';        
        $fileInp.= name($name);
        $fileInp.= width($width);
        $fileInp.= '>';
        $fileInp.= ($enabled==true ? '>': disabled_.'>');
        return $fileInp;
    }
    /**
     * Returns a Code Element
     * 
     * Example:
     * 
     * <code>  
     *  $p->Body($p->TagCode($data));
     * </code>
     * 
     * @param string $value
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function TagCode($value="", $class="", $id="", $name="", $properties=""){
        $tagCode = $this->iT(code_,cClass($class).id($id).name($name).($properties==""? "":' '.$properties)).BK;
        $tagCode.= $value._code;
        return $tagCode;
    }
    /**
     * Returns a Pre element
     * 
     * Example:
     * 
     * <code>  
     *  $p->Body($p->TagPre($data));
     * </code>
     * 
     * @param string $value
     * @param string $class
     * @param string $id
     * @param string $name
     * @param string $properties
     * @return string
     */
    function TagPre($value="", $class="", $id="", $name="", $properties=""){        
        $tagPre = $this->iT(pre_, cClass($class).id($id).name($name).($properties==""? "":' '.$properties)).BK;
        $tagPre.= $value._pre;
        return $tagPre;       
    }
    /**
     * Returns a Image element. If the file does not exists adds a comment
     * 
     * Example:
     * 
     * <code>  
     *  $p->Body($p->Image("user.jpg","300","200","The User Picture"));
     * </code>
     * 
     * @param string $filename  Filename
     * @param string $height    File Height
     * @param string $width File Width 
     * @param string $alt   Alternative text
     * @param string $class Picture class
     * @param string $id    Id tag
     * @param string $name  Name tag
     * @param string $properties Extended Properties
     * @return string|Comment If the file does not exists adds a comment
     */
    function Image($filename, $height="", $width="", $alt="", $class="", $id="", $name="", $properties=""){
        if(file_exists($filename)){
            $image = '<img src="'.$filename.'" alt="'.$alt.'" title="'.$alt.'"';
            $image.= height($height);
            $image.= width($width);
            $image.= cClass($class);        
            $image.= id($id);
            $image.= name($name);
            $image.= ($properties==""?"":' '.$properties);
            $image.= '/>';
        }else{
            $image = "";
            $comment = "The file $filename does not exist";
            $this->Comment($comment);
        }
        return $image;
    }
    /**
     * Returns an anchor element
     * An anchor is a piece of text which marks the beginning and/or the end of a hypertext link.
     * 
     * Example:
     * 
     * <code>  
     *  $p->Body($p->Anchor("TheTopOfMyPage"));
     *  $p->Body($p->Anchor("TheBottomOfMyPage"));
     * </code>
     * 
     * @param string $name
     * @return string
     */
    function Anchor($name){
        return $this->iT(a_, name($name).id($name))._a;
    }
    /**
     * Returns an hyperlink tag. 
     * 
     * Example:
     * 
     * <code>  
     *  $link = $p->Link(PAGEF, "http://www.google.com.mx", "Google");
     *  $mail = $p->Link(MAIL,"user@example.org","Wrote me!!!");
     *  $p->Body($link. ' - ' .$mail);
     * </code>
     * 
     * @param string $type  The type of hyperlink (mail, ftp, http)
     * @param string $url   The Url
     * @param string $description The description
     * @param string $target    The target
     * @param string $class The css class for the link
     * @param string $id    The id for the link
     * @param string $name  The name for the link
     * @param string $properties    Extended properties
     * @return string   Returns the tag
     */
    function Link($type=PAGEF, $url="",$description="", $target="", $class="", $id="", $name="", $properties=""){
        switch ($type) {
            case MAIL:
                $lnk = '<a href="mailto:'.$url.'"';
                break;
            case FTP:
                $lnk = '<a href="ftp://'.$url.'"';
                break;
            default:
                $lnk = '<a href="'.$url.'"';
                break;
        }
        $lnk.= target($target);
        $lnk.= cClass($class);        
        $lnk.= id($id);
        $lnk.= name($name);
        $lnk.= ($properties  == ""?"":' '.$properties);
        $lnk.= '>'.$description.'</a>';
        return $lnk .BK;        
    }
    /**
     * Returns an iFrame tag
     * 
     * @param string $src
     * @param integer $height
     * @param integer $width
     * @param string $scrolling Recive yes,no,auto. Depreceated in HTML5
     * @param string $name
     * @return string
     */
    function iFrame($src, $height, $width, $scrolling="auto", $name){        
        $ifr = $this->iT(ifr_, 
                src($src).
                height($height).
                width($width).
                name($name).
                ' scrolling="'.$scrolling.'"').
                _ifr;                
        return $ifr;        
    }
    /**
     * Check if a remote file exists
     * 
     * @param string $url File route
     * @return boolean 
     */
    function remoteFileExists($url) {
        $curl = curl_init($url);
        //don't fetch the actual page, you only want to check the connection is ok
        curl_setopt($curl, CURLOPT_NOBODY, true);
        //do request
        $result = curl_exec($curl);
        $ret = false;
        //if request did not fail
        if ($result !== false) {
            //if request was ok, check response code
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
            if ($statusCode == 200) {
                $ret = true;   
            }
        }
        curl_close($curl);
        return $ret;
    }
    
    /**
     * Converts a decimal, double value to currency
     * 
     * @param decimal $value
     * @param integer $decimals
     * @param string $dec_point
     * @param string $thousands_sep
     * @return string
     */
    function nCurrency($value, $decimals=2, $dec_point=".", $thousands_sep=","){        
        return '$'.number_format($value, $decimals, $dec_point, $thousands_sep);
    }
    /**
     * Formats number
     * 
     * @param decimal $value
     * @param integer $decimals
     * @param string $dec_point
     * @param string $thousands_sep
     * @return string
     */
    function nNumber($value, $decimals=2, $dec_point=".", $thousands_sep=","){        
        return number_format($value, $decimals, $dec_point, $thousands_sep);
    }
    /**
     * Format a value to date YYYYMMDD to DD/MM/YYYY
     * @param string/date $value
     * @return string/date
     */
    function nDate($value){
        return ereg_replace('([0-9]{4})([0-9]{2})([0-9]{2})', '\\3/\\2/\\1', $value);
    }
    /**
     * Insert extended properties
     * 
     * @param string $tag
     * @param string $properties
     * @return string
     */
    function iT($tag, $properties){
        return preg_replace('/>/', $properties.'>', $tag, 1);
    }
    /**
     * Create the header tag
     * 
     * @param integer $i
     * @param string $value
     * @return string
     */
    function h($i=1, $value =""){
        if($i>6){
            $description = "The value \$i can not be higher than 6.";            
            $this->display_error('html.class.php::h($i, $value)', $description);
        }else{
            return "<h$i>$value</h$i>".BK;
        }
    }
    /**
     * Return errors when the DevelopMode is true
     * 
     * @param string $source
     * @param string $description
     */
    function display_error($source="", $description = ""){
        $msj = $this->iT(p_, style('background:#fef1ec; color:#cd0a0a;'));
        $msj.= $this->iT(span_, style('color:#333;font-weight:bold;'));
        $msj.= "An error occurred: "._span;   
        $msj.= $this->iT(span_, style('font-weight:bold;')).$source._span. br_. htmlentities($description);
        $msj.= _p;
        if($this->DevelopMode==TRUE){
            $this->Body($msj);
        }
    }    
    
    /**
     * Create de Page with the user defined contents
     * prints Html generated code
     * Example:
     * 
     * <code>  
     *  $p = new PHP2HTML();
     *  $p->Body("Hello World");
     *  $p->Create();
     * </code>
     * 
     * 
     */    
    function Create(){
        $styles = "";
        $result = DOC_TYPE.BK;
        $result = $result . '<html xmlns="http://www.w3.org/1999/xhtml" lang="{m_lang}">'.BK;
        $result = $result . '<head>'.BK;
        $result = $result . '<title>{m_ptitle}</title>'.BK;
        $result = $result . '<meta http-equiv="Content-Type" content="{m_contnt}" charset="{m_charst}"/>' .BK;
        $result = $result . '<meta name="title" content="{m_ptitle}"/>'.BK;
        $result = $result . '<meta name="keywords" content="{m_keywor}"/>'.BK;
        $result = $result . '<meta name="description" content="{m_descri}"/>'.BK;
        $result = $result . '<meta name="author" content="{m_author}"/>'.BK;
        $result = $result . '<meta name="robots" content="{m_robots}"/>'.BK;
        if(FAV_ICON==true){
            $result = $result . '<link rel="shortcut icon" href="'.FAV_ICON_URL.'"/>'.BK;
        }
        $result = $result . '</head>';        
        $meta_tag = $this->Return_Meta();        
        foreach ($meta_tag as $key=>$value) {
            $result = str_replace('{'.$key.'}', $value, $result);
        }        
        foreach($this->Return_CSS() as $value){
            $result = str_replace('</head>',$value.BK."</head>", $result);
        }
        foreach($this->css_style as $value){
            $styles.= $value.BK;
        }
        $result =($styles=="" ? $result : 
            str_replace('</head>','<style type="text/css">'.$styles.BK."</style></head>",$result));
        
        foreach($this->Return_JS() as $value){
            $result = str_replace("</head>", $value.BK."</head>", $result);
        }
        $result.=BK.(trim($this->body_class)=="" ? "<body>" :'<body class="'.trim($this->body_class).'">');
        $result.= '</body></html>';        
        $result = ($this->head_scr=='' ? $result : str_replace('</head>','<script type="text/javascript">'.$this->head_scr.BK."</script>".BK."</head>".BK, $result));
        $result = ($this->body_doc=='' ? $result : str_replace('</body>',$this->body_doc.BK."</body>".BK, $result));        
        print $result;
        restore_error_handler();  
    }

    
    function handleBasicError($code, $message, $file, $line) {    
        $this->display_error("PHP2HTML", $message);
    }
    
    
}
/*End of the class*/
    

    /**
     * Returns if the curl extension is loaded
     * 
     * @return boolean 
     */
    function checkCurl(){        
        return (extension_loaded('curl') ? true : false);
    }
    /**
     * Returns if the mysql extension is loaded
     * 
     * @return boolean
     */
    function checkMySQL(){
        return (extension_loaded('mysql') ? true : false);        
    }
    /**
     * Returns if the mysqli extension is loaded
     * 
     * @return boolean
     */
    function checkMySQLi(){
        return (extension_loaded('mysqli') ? true : false);          
    }
    /**
     * Returns if the mssql extension is loaded
     * 
     * @return boolean
     */
    function checkMsSQL(){
        return (extension_loaded('mssql') ? true : false);            
    }
    /**
     * Returns if the oracle extension is loaded
     * 
     * @return boolean
     */
    function checkOracle(){
        return (extension_loaded('oci8') ? true : false);
    }
    /**
     * Returns information about whether the necessary libraries are installed.
     * 
     * @return string
     */
    function requirements(){       
        $msj = div_.span_.'Libraries'._span. _div.p_;       
        $msj.= ul_;
        $msj.= li_.(checkCurl() ? "The CURL extension is loaded":"The CURL extension is not loaded")._li;
        $msj.= li_.(checkMySQL() ? "The MySQL extension is loaded":"The MySQL extension is not loaded")._li;
        $msj.= li_.(checkMySQLi() ? "The MySQLi extension is loaded":"The MySQLi extension is not loaded")._li;
        $msj.= li_.(checkMsSQL() ? "The MsSQL extension is loaded":"The MsSQL extension is not loaded")._li;
        $msj.= li_.(checkOracle() ? "The OCI8 extension is loaded":"The OCI8 extension is loaded")._li;                
        $msj.= _ul._p;
        return $msj;
    }
      
 
        
    
    function captureNormal($code, $message, $file, $line) {    
        echo '<p style="background:#fef1ec; color:#cd0a0a;">
        <span style="color:#333; font-weight:bold;">An error occurred:</span>
        '.htmlentities($message).'</p>';
    }
    
    set_error_handler('captureNormal');   
    
    function captureException($exception){
        
        echo '<p style="background:#fef1ec; color:#cd0a0a;">
        <span style="color:#333; font-weight:bold;">An error occurred:</span>
        <span style="font-weight:bold;">PHP2HMTL</span></p>
        <pre style="background:#fef1ec; color:#cd0a0a;">';        
        echo $exception;        
        echo br_.strong_."Script Execution stoped"._strong; 
        echo '</pre>';
        
    }
    
    // UNCATCHABLE ERRORS
    
    function captureShutdown( ){
        $error = error_get_last( );
        if($error) {
            //IF YOU WANT TO CLEAR ALL BUFFER, UNCOMMENT NEXT LINE:
            //ob_end_clean( );            
            // Display content $error variable
            echo '<p style="background:#fef1ec; color:#cd0a0a;">
            <span style="color:#333; font-weight:bold;">An error occurred:</span>
            <span style="font-weight:bold;">PHP2HMTL</span></p>
            <pre style="background:#fef1ec; color:#cd0a0a;">';        
            //echo $error['message'];        
            print_r($error);
            echo br_.strong_."Script Execution stoped"._strong; 
            echo _pre;
        }else{ 
            return true;            
        }
    }
    
?>