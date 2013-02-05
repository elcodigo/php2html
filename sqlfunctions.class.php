<?php
/**
 * Class that contains functions for managing connections
 * @package PHP2HTML 
 * @subpackage databases
 * @version    1.0 BETA
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 *  
 */
/**
 * Class that contains functions for managing connections
 *
 * @abstract Class
 * @package PHP2HTML
 * @subpackage databases
 * @version    1.0
 * @author MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @copyright Copyright (R) 2012, MANUEL GONZALEZ RIVERA <phptohtml@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 *  
 */
abstract class SQLFunctions {
    /**
     * The active connection
     *
     * @var object Connection Object 
     */
    protected $conn;
    /**
     * The active recordset
     *
     * @var object Active Recordset
     */
    public $rs;
    /**
     * Associative array with the current row
     *
     * @var array Current Row
     * @see $rs
     */
    public $row = array();    
    /**
     * Active/Last Sql Query
     *
     * @var string SQL Query
     */
    public $sql;
    /**
     * Database host
     *
     * @var string Database Host 
     */
    protected $host;
    /**
     * Database name
     *
     * @var string Database name
     */
    protected $database;
    /**
     * Database username
     *
     * @var string Database User
     */
    protected $user;
    /**
     * Database password
     *
     * @var string Database Password
     */
    protected $password;
    /**
     * Defines if the connection is persistent
     * 
     * @var string Connection Option
     */
    protected $persistant;
    /**
     *
     * @var object
     */
    protected $HtmlC;
    /**
     * Abstract class for handling connections
     * 
     * @param $host string
     * @param $database string
     * @param $user string
     * @param $password string
     * @param $persistant boolean
     */
    abstract public function __construct($obj, $host, $database, $user, $password, $persistant);
    /**
    * Try running a SQL query. If the parameter is empty, it takes the variable $this->sql
    *
    * @param string $sql Sql Query
    */
    abstract public function Query($sql = '');
    /**
    * Returns an associative array with the following record
    *
    * @param boolean $assoc
    * @return mixed
    */
    abstract public function Fetch($assoc = false);
    /**
    * Move the pointer to the index consultation indicated
    *
    * @param int $num
    * @return boolean
    */
    abstract public function Seek($num = 0);
    /**
    * Return the last id inserted
    *
    * @return int
    */
    abstract public function getInsertedId();
    /**
    * Returns the number of rows affected by a query update, insert or delete
    *
    * @return int
    */
    abstract public function affectedRows();
    /**
    * Returns the number of rows for a SELECT query resolved
    *
    * @return int    
    */
    abstract public function numRows();
    /**
    * Returns the number of columns in the query result
    *
    * @return int
    * @throws ExceptionRecorset
    */
    abstract public function numColumns();
    /**
     * Get the connection info
     * 
     * return string
     */
    abstract public function ConnSummary();
    /**
     * Open the connection
     * 
     */
    abstract protected function Conn();
    /**
     * Close the connection
     */
    abstract public function Close();
    /**
     * Destroy
     */    
    abstract public function __destruct();
}
?>