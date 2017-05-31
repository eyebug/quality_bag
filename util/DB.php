<?php


class DB
{

    const DB_HOST = "139.162.55.65";
    const DB_USERNAME = 'freda';
    const DB_PASSWORD = 'freda';
    const DB_DATABASE = 'study';

    /**
     * @var DB|null
     */
    private static $_instance = null;

    /**
     * @var null|mysqli
     */
    private $_conn = null;


    /**
     * @throws Exception
     */
    private function __construct()
    {
        $conn = new mysqli(self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_DATABASE);
        if ($conn->connect_error) {
            $errMsg = 'Cannot connect to database. ' . $conn->connect_error;
            throw new Exception($errMsg);
        }
        $conn->set_charset('utf8');
        $this->_conn = $conn;
    }

    public function __destruct()
    {
        if ($this->_conn instanceof mysqli) {
            $this->_conn->close();
        }
    }

    /**
     * @return DB|null
     */
    public static function getDB()
    {
        if (!self::$_instance instanceof DB) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    /**
     * @param      $statement
     * @param null $typeFormat
     * @param      ...$params
     * @return array
     * @throws Exception
     */
    public function query($statement, $typeFormat = null, ...$params)
    {
        $result = array();
        $conn = $this->_conn;


        if (is_null($typeFormat)) {
            $res = $conn->query($statement, MYSQLI_ASSOC);
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                array_push($result, $row);
            }
            return $result;
        }

        $rParams = array();
        $rParams[] = &$typeFormat;
        foreach ($params as $key => $value) {
            $rParams[] = &$params[$key];
        }
        $stmt = $conn->prepare($statement);
        if ($stmt === false) {
            throw new Exception('Wrong SQL: ' . $statement . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
        }

        call_user_func_array(array($stmt, 'bind_param'), $rParams);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($stmt->error) {
            throw new Exception("Error when execute sql");
        }
        while ($res && $row = $res->fetch_array(MYSQLI_ASSOC)) {
            array_push($result, $row);
        }
        return $result;
    }




}