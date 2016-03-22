<?php
/**
 * A simple to use Database Query class for PHP wrapping PHP's mysql functions
 * 
 * @author Shane McIntosh
 */


class DB {
    
    private $db_error_code = 0;
    private $db_error_string = '';
    private $db_handle = NULL;
    private $db_result_set = NULL;
    private $db_query_handle = NULL;
    private $db_connected = FALSE;
    
    /**
     * Creating a database connection to the database server. Returns FALSE on any errors
     * 
     * @param string $username
     * @param string $password
     * @param string $host
     * @param string $dbname
     * @return boolean
     */
    public function __construct($username, $password, $host, $dbname) {
        $this->db_handle = mysql_connect($host, $username, $password);
        if (!$this->db_handle) {
            $this->db_set_errors();
            return;
        }
        
        if (!mysql_select_db($dbname, $this->db_handle)) {
            $this->db_set_errors();
            return;
        }
        
        $this->db_connected = TRUE;
    }
    
    public function is_connected() {
        return $this->db_connected;
    }
    
    /**
     * Sets the class error values Easy peasy..
     */
    private function db_set_errors() {
        $this->db_error_code = mysql_errno();
        $this->db_error_string = mysql_error();
    }
    
    public function __destruct() {
        
    }
    
    /**
     * Takes a string and makes it safe to be used in a query
     * 
     * @param String $string
     * @return String
     */
    public function make_safe($string) {
        $string = mysql_real_escape_string($string);
    }
    
    /**
     * Executes a properly formed Query string on the database this represents
     * DOES NOT SANITIZE THE STRING, CLEANSE IT FIRST!!!
     * 
     * @param String $query
     * @return boolean
     */
    public function query($query) {
        
        $q = mysql_query($query);
        if (!$q) {
            $this->db_set_errors();
            return FALSE;
        }
        
        $this->db_query_handle = $q;
        
        return TRUE;
    }
    
    /**
     * Fetches a single result from the previously executed query
     * 
     * @return boolean|array
     */
    public function fetch_next_result() {
        
        $this->db_result_set = mysql_fetch_assoc($this->db_query_handle);
        if (!$this->db_result_set) {
            $this->db_set_errors();
            return FALSE;
        }
        return $this->db_result_set;
    }
    
    /**
     * Fetches all rows that matched the previously executed array
     * This has a major performance hit on vague queries. Use this wisely.
     * 
     * @return boolean|array
     */
    public function fetch_all() {
        
        $results = array();
        while(($d = mysql_fetch_assoc($this->db_query_handle)) != NULL) {
            if (!$d) {
                $this->db_set_errors();
                return FALSE;
            }
            array_push($results, $d);
        }
        
        return $results;
        
    }
    
    /**
     * Returns the autoincremented id of the last insert query
     * 
     * @return int
     */
    public function get_last_insert_id() {
        return mysql_insert_id($this->db_handle);
    }
    
    /**
     * Returns the number of rows fetched by the last query.
     * 
     * @return boolean|int
     */
    public function get_result_count() {
        $results = mysql_num_rows($this->db_query_handle);
        if (!is_int($results)) {
            $this->db_set_errors();
            return FALSE;
        }
        
        return $results;
            
    }
    
    public function get_error_code() {
        return $this->db_error_code;
    }
    
    public function get_error_message() {
        return $this->db_error_string;
    }
    
}