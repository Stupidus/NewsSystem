<?php
/**
 * Description of connection
 *
 * @author Victor
 */
class Connection {
    private $db;
    
    /**
     *
     * @param String $host MySQL server name/IP adress
     * @param String $dbname Database name
     * @param String $username Database username
     * @param String $password Database password
     * @param String $port MySQL server port
     * @throws Exception 
     */
    public function  __construct($host, $dbname, $username, $password, $port = '3306')
    {
        try
        {
            $this->db = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.'', $username, $password);
            $this->db->query("SET NAMES UTF8");
        }
        catch (Exception $e)
        {
            throw new Exception("Connection to database '".$dbname."' failed. (".$e->getMessage().")");
        }
    }
    
    public function getDb()
    {
        return $this->db;
    }
}

?>
