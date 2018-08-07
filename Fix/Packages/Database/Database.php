<?php

namespace Fix\Packages\Database;

use Fix\Kernel\Url;

class Database
{


    public static $_query;
    public static $_tablename;
    public static $_grupby;
    public static $_orderyb;
    public static $_limit;
    public static $_multiple;
    public static $_setdata;
    public static $_wheredata;
    public static $_indata;
    public static $_Progress    = "other";
    public static $_Single      = true;
    public static $_Multiple    = false;


    public static function FIX(){

        return new self();

    }

    /**
     * @return \PDO
     */
    public function connect(){

        try {

            $PDO        = new \PDO(Url::getSettings()["database"]["driver"].':host=' . Url::getSettings()["database"]["host"] . ';dbname=' . Url::getSettings()["database"]["table"], Url::getSettings()["database"]["username"], Url::getSettings()["database"]["password"]);
            $PDO->query('SET CHARACTER SET ' . Url::getSettings()["database"]["charset"]);
            $PDO->query('SET NAMES ' . Url::getSettings()["database"]["charset"]);

            return $PDO;

        } catch ( \PDOException $e ){ die($e->getMessage()); }

    }


    /**
     * @param null $table
     * @param string $selector
     * @return $this
     */
    public function select($table = null, $selector = "*") {

        self::$_query = "SELECT" . " " . $selector . " " . "FROM" . " " . $table;
        self::$_tablename = $table;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function insert($columname = null){

        self::$_query = "INSERT INTO"." ".$columname;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function delete($columname = null){

        self::$_query = "DELETE FROM"." ".$columname;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function update($columname = null){

        self::$_query = "UPDATE"." ".$columname;
        return $this;

    }


    /**
     * @param string $query
     * @param array $data
     * @return $this
     */
    public function manuel($query = "", array $data = []){

        self::$_query = $query;
        return $this;

    }


    public function  set(array $colm = null, array $data = null,$bracket = ","){

        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){


            if(count($colm) === count($data)){


                self::$_query .= " "."SET"." ";

                $count = 0;

                foreach($colm as $col){

                    $count = $count+1;
                    if(count($colm) === $count){

                        self::$_query .= " ".$col."=?"." ";

                    }else{

                        self::$_query .= " ".$col."=?"." ".$bracket." ";

                    }

                }

                self::$_setdata = $data;

                return $this;

            }else{ die("Database (set) parameter error : not equal"); }

        }else{ die("Database (set) parameter error : not equal"); }


    }


    public function  where(array $colm = null, array $data = null,$bracket = "AND"){


        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){


            if(count($colm) === count($data)){

                self::$_query .= " "."where"." ";

                $count = 0;

                foreach($colm as $col){

                    $count = $count+1;
                    if(count($colm) === $count){

                        self::$_query .= " ".$col."=?"." ";

                    }else{

                        self::$_query .= " ".$col."=?"." ".$bracket." ";

                    }

                }

                self::$_wheredata = $data;

                return $this;
            }else{ die("Database (set) parameter error : not equal"); }

        }else{ die("Database (set) parameter error : not equal"); }

    }



    public function  in($colm = null, array $data = null,$bracket = ","){


        if( is_array($data)){


            $in  = str_repeat('?,', count($data) - 1) . '?';
            self::$_query .= " ".$colm." "."IN (".$in.")"." ";
            self::$_indata = $data;

            return $this;


        }else{ die("Database (where) parameter (2 - data) error : is not array"); }

    }

    /**
     * @param null $columname
     * @param string $sort
     * @return $this
     */
    public function orderby($columname = null, $sort = "ASC"){

        self::$_query .= " ORDER BY"." ".$columname." ".$sort;
        return $this;


    }

    /**
     * @param null $columname
     * @return $this
     */
    public function groupby($columname = null){

        self::$_query .= " "."GROUP BY"." ".$columname;
        return $this;

    }

    /**
     * @param null $start
     * @param null $finish
     * @return $this
     */
    public function limit($start = null,$finish = null){

        self::$_query .= " "."LIMIT"." ".$start.",".$finish." ";
        return $this;

    }


    public function end($start = ","){

        self::$_query .= " ".$start." ";
        return $this;

    }

    /**
     * @return array
     */
    public function exportsql(){

        return [
            "query"    => self::$_query,
            "where"    => self::$_wheredata,
            "set"      => self::$_setdata,
            "in"       => self::$_indata
        ];

    }


    /**
     * @param bool|false $single
     * @return array|mixed
     */
    public function run($single  = false){

        $array1 = [];
        $array2 = [];
        $array3 = [];

        if(is_array(self::$_setdata)){

            $array1 = self::$_setdata;
        }

        if(is_array(self::$_wheredata)){

            $array2 = self::$_wheredata;
        }

        if(is_array(self::$_indata)){

            $array3 = self::$_indata;
        }

        if(self::$_query !== ""){

            if(is_array(self::$_wheredata) or is_array(self::$_setdata)){

                $sql = $this->connect()->prepare(self::$_query);

            }else{

                $sql = $this->connect()->query(self::$_query);
            }

            if( count(array_merge($array1,$array2,$array3)) > 0 ){

                $sql->execute(array_merge($array1,array_merge($array2,$array3)));

            }

            self::$_indata      = null;
            self::$_wheredata   = null;
            self::$_setdata     = null;

            if ($single === "other"){

                return $sql;

            } else if($single){

                return $sql->fetch(\PDO::FETCH_ASSOC);

            } else{

                return $sql->fetchAll(\PDO::FETCH_ASSOC);

            }



        }

    }


}