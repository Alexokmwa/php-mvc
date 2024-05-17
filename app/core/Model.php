<?php

namespace app\core;

// deny acess to app files and folders access.
defined('ROOTPATH') or exit('Access Denied!');
use app\core\Database;

trait Model
{
    use Database;
    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_Column = "id";
    public function findAll()
    {

        $query = " select *from $this->table order by $this->order_Column $this->order_type limit $this->limit offset $this->offset";
        // echo $query;
        return $this -> query($query);
    }
    public function where($data, $data_not = [])
    {
        $keys  = array_keys($data);
        $keys_not  = array_keys($data_not);
        $query = "select *from $this->table where ";
        foreach ($keys as $key) {
            $query  .= $key . " = :". $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query  .= $key . " != :". $key . " && ";
        }
        $query = trim($query, " && ");
        $query .= " order by $this->order_Column $this->order_type limit $this->limit offset $this->offset";
        // echo $query;
        $data = array_merge($data, $data_not);
        return $this -> query($query, $data);
    }
    public function first($data, $data_not = [])
    {
        $keys  = array_keys($data);
        $keys_not  = array_keys($data_not);
        $query = "select *from $this->table where ";
        foreach ($keys as $key) {
            $query  .= $key . " = :". $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query  .= $key . " != :". $key . " && ";
        }
        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset";
        // echo $query;
        $data = array_merge($data, $data_not);
        $result = $this -> query($query, $data);
        if($result) {
            return $result[0];
        } else {

            return false;
        }

    }

    public function insert($data)
    {
        //remove unwanted data
        if(!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if(!in_array($key, $this->allowedcolumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys  = array_keys($data);
        $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).") ";
        // echo $query;
        $this -> query($query, $data);
        return false;
    }

    public function update($id, $data, $idColumn = 'id')
    {

        //remove unwanted data
        if(!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if(!in_array($key, $this->allowedcolumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys  = array_keys($data);
        $query = "update $this->table set ";
        foreach ($keys as $key) {
            $query  .= $key . " = :". $key . " , ";
        }

        $query = trim($query, " , ");
        $query .= " where $idColumn =:$idColumn";
        $data [$idColumn] = $id;
        // echo $query;
        $this -> query($query, $data);
        return false;
    }

    public function delete($id, $idColumn = 'id')
    {
        $data [$idColumn] = $id;
        $query = "delete from $this->table where $idColumn =:$idColumn ";
        // echo $query;
        $this -> query($query, $data);
        return false;
    }
}
