<?php
/**
 * Class used for handle Oracle 9i(or higher) Connections
 * @package PHP2HTML
 * @subpackage databases
 * @version    1.0 BETA
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 *  
 */
/**
 * SQLFunctions class is needed
 * @see SQLFunctions
 */
require_once 'sqlfunctions.class.php';
/**
 * Class used for handle Oracle 9i(or higher) Connections
 * 
 * @package PHP2HTML
 * @subpackage databases
 * @version    1.0
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 *  
 */
class oracleConn extends SQLFunctions{
    /**
     * Open the connection
     * 
     */
    protected function Conn() {
        try{
            if($this->persistant==true){
                $this->conn = oci_pconnect($this->user, $this->password, $this->host.'/'.$this->database);
            }else{
                $this->conn = oci_connect($this->user, $this->password, $this->host.'/'.$this->database);
            }
            if(!$this->conn){
                $e = oci_error();
                $this->HtmlC->display_error('oracleConn:Conn()', htmlentities($e['message']));
            }
        }catch(Exception $e){
            $this->HtmlC->display_error('oracleConn:Conn()',$e->getMessage());
        }
    }
    /**
     * Close the connection
     */
    public function Close() {
        $type = (is_resource($this->conn) ? get_resource_type($this->conn) : "none");
        if(strstr($type,"oci8")){
            oci_close($this->conn);            
        }else{                       
            if($type!='Unknown'){
                //
            }
        }
    }
    /**
     * Get the connection info
     * 
     * return string
     */
    public function ConnSummary() {
        return $this->user.'@'.$this->database.':'.$this->host;  
    }
    /**
     * Returns an associative array with the following record
     * 
     * @param boolean $assoc
     * @return mixed
     */
    public function Fetch($assoc = true) {
        if($assoc==true){
            $this->row = oci_fetch_assoc($this->rs);
        }else{
            $this->row = oci_fetch_array($this->rs);
        }
        return is_array($this->row);
    }
    /**
    * Try running a SQL query. If the parameter is empty, it takes the variable $this->sql
    *
    * @param string $sql Sql Query
    */
    public function Query($sql = ''){
        if(is_resource($this->rs)) {
            oci_free_statement($this->rs);            
        }
        $this->sql = ($sql=="" ? $this->sql : $sql);
        $this->rs = oci_parse($this->conn, $this->sql);
    }
    /**
    * Move the pointer to the index consultation indicated
    * Does not works in Oracle
    *
    * @todo find alternatives 
    * @param int $num
    * @return boolean false
    */
    public function Seek($num = 0) {
        return false;
    }
    /**
     * Initialize the class
     * 
     * @param $host string
     * @param $database string
     * @param $user string
     * @param $password string
     * @param $persistant boolean
     */
    public function __construct($obj, $host =DB_HOST, $database = DB_DATABASE, $user = DB_USER, $password = DB_PASS, $persistant = DB_PERSIST) {
        $this->HtmlC = $obj;
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->persistant = $persistant;
        $this->Conn();
    }
    /**
     * Destroy
     */
    public function __destruct() {
        try{
            $this->Close();
        }catch(Exception $e){
            echo "Error: ". $e->getMessage();
        }        
    }
    /**
    * Returns the number of rows affected by a query update, insert or delete
    *
    * @return int
    */
    public function affectedRows() {
        if(!empty($this->rs)){
            return oci_num_rows($this->conn);        
        }else{
            return 0;
        }
    }
    /**
    * Return the last id inserted
    * Does not works in Oracle
    *
    * @todo Find alternatives
    * @return int 0
    */
    public function getInsertedId() {
        return 0;
    }
    /**
    * Returns the number of columns in the query result
    *
    * @return int
    */
    public function numColumns() {
        if(!empty($this->rs)){
            return oci_num_fields($this->conn);        
        }else{
            return 0;
        }
    }
    /**
    * Returns the number of rows for a SELECT query resolved
    * Does not work in oracle
    * @todo Find alternatives
    * @return int    
    */
    public function numRows() {
        return 0;
    }
}
?>
