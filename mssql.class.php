<?php
/**
 * Class used for handle Microsoft Sql Server Connections
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
 * Class used for handle Microsoft Sql Server Connections
 * 
 * @package PHP2HTML
 * @subpackage databases
 * @version    1.0
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 *  
 */
class mssqlConn extends SQLFunctions{
    /**
     * Open the connection
     * 
     */
    protected function Conn() {        
        try{
            if($this->persistant==true){
                $this->conn = mssql_pconnect($this->host, $this->user, $this->password) or die("BIG ERROR: " . $this->ConnSummary());
            }else{
                $this->conn = mssql_connect($this->host, $this->user, $this->password) or die("BIG ERROR: " . $this->ConnSummary());                
            }
            mssql_select_db($this->database, $this->conn);
        }catch(Exception $e){
            echo "Error: ". $e->getMessage();
        }        
    }
    /**
     * Close the connection
     */
    public function Close() {
        $type = (is_resource($this->conn) ? get_resource_type($this->conn) : "none");
        if(strstr($type,"mssql")){        
            mysql_close($this->conn);            
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
    * @return mixed
    */
    public function Fetch($assoc = true) {
        if($assoc==true){
            $this->row = mssql_fetch_assoc($this->rs);
        }else{
            $this->row = mssql_fetch_array($this->rs);
        }
        return is_array($this->row);
    }
    /**
    * Try running a SQL query. If the parameter is empty, it takes the variable $this->sql
    *
    * @param string $sql Sql Query
    */
    public function Query($sql = '') {
        if(is_resource($this->rs)) {
            mssql_free_result($this->rs);            
        }
        $this->sql = ($sql=="" ? $this->sql : $sql);
        $this->rs = mssql_query($this->sql, $this->conn);
    }
    /**
    * Move the pointer to the index consultation indicated
    *
    * @param int $num
    * @return boolean
    */
    public function Seek($num = 0) {
        if (!empty($this->rs)) {
            $this->row = mssql_data_seek($this->rs, $i);
            return true;
        }
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
    public function __construct($host =DB_HOST, $database = DB_DATABASE, $user = DB_USER, $password = DB_PASS, $persistant = DB_PERSIST) {
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
        $this->Close();
    }
    /**
    * Returns the number of rows affected by a query update, insert or delete
    *
    * @return int
    */
    public function affectedRows() {
        if(!empty($this->rs)){
            return mssql_rows_affected($this->conn);        
        }else{
            return 0;
        }
    }
    /**
    * Return the last id inserted
    *
    * @return int
    */
    public function getInsertedId() {
        $this->Query('SELECT @@identity AS ID');
        if ($this->Fetch()) {
          return $this->row['ID'];
        }
    }
    /**
    * Returns the number of columns in the query result
    *
    * @return int
    * @throws ExceptionRecorset
    */
    public function numColumns() {
        if(!empty($this->rs)){
            return mssql_num_columns($this->conn);        
        }else{
            return 0;
        }
    }
    /**
    * Returns the number of rows for a SELECT query resolved
    *
    * @return int    
    */
    public function numRows() {
        if(!empty($this->rs)){
            return mssql_num_rows($this->conn);        
        }else{
            return 0;
        }
    }
}
?>