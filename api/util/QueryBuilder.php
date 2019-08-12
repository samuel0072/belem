<?php

function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}

function filter($filters, $data, $queryBuilder){
    $params = [];
    $types = '';

    foreach($filters as $k => $v) {
        if (isset($data[$k]) && strlen($data[$k])) {
            $placeholder = [];
            $filter = $data[$k];

            if(strtoupper($v['op']) == 'IN'){
                $values = explode(',', $filter);

                for ($i = 0;$i < count($values);$i++) {
                    $placeholder[] = '?';
                    $types .= $v['type'];
                    $params[] = $values[$i];
                }

                $queryBuilder->where($v['field'].' IN ('.implode(',', $placeholder).')');
            }
            else {
                $types .= $v['type'];
                $params[] = $filter;
                $queryBuilder->where($v['field'].' '.$v['op'].' ?');
            }
        }
    }
    return [$types, $params];
}

class QueryBuilder{
    private $query;
    private $where_used;

    public function select($columns){
        $this->query .= " SELECT ";
        if(is_array($columns)) {
            $this->query .= implode(',', $columns);
        }
        else {
            $this->query .= $columns;
        }
        return $this;
    }

    public function from($table){
        $this->query .= " FROM $table ";

        return $this;
    }

    public function where($condition){
        if(!$this->where_used){
            $this->query .= " WHERE $condition";
            $this->where_used = true;
        }
        else{
            $this->query .= " AND $condition";
        }

        return $this;
    }

    public function equals($lhs, $rhs){
        $this->query .= " $lhs = $rhs ";
        return $this;
    }

    public function _and($condition){
        $this->query .= " AND $condition";

        return $this;
    }

    public function _or($condition){
        $this->query .= " OR $condition";

        return $this;
    }

    public function limit($limit){
        $this->query .= " LIMIT $limit";

        return $this;
    }

    public function insert_into($table, $columns){
        $this->query .= ' INSERT INTO '.$table.'(';

        $i = 0;
        foreach ($columns as $column) {
            $this->query .= strval($column);
            if($i++ != count($columns) - 1){
                $this->query .= ', ';
            }
        }

        $this->query .= ')';

        return $this;
    }

    public function values($values){
        $this->query .= ' VALUES (';

        $i = 0;
        foreach ($values as $value) {
            $this->query .= $value;
            if($i++ != count($values) - 1){
                $this->query .= ', ';
            }
        }

        $this->query .= ')';

        return $this;
    }

    public function update($table){
        $this->query .= " UPDATE $table";

        return $this;
    }

    public function set($columns, $values){
        $this->query .= ' SET ';
        for($i = 0;$i < count($columns);$i++) {
            if ($i){
                $this->query .= ', ';
            }
            $this->query .= $columns[$i] . ' = ' . $values[$i];
        }

        return $this;
    }

    public function join($table, $on, $type = ''){
        $this->query .= "$type JOIN $table ON $on ";
        return $this;
    }

    public function union(){
        $this->query .= " UNION ";
        $this->where_used = false;
        return $this;
    }

    public function delete($table, $condition){
        $this->query .= " DELETE FROM $table WHERE $condition";
    }

    public function get_query(){
        return $this->query;
    }

    public function append($str){
        $this->query .= $str;
        return $this;
    }

    public function clear(){
        $this->query = '';
        $this->where_used = false;
    }

    public function group_by($column){
        $this->query .= " GROUP BY $column ";
        return $this;
    }

    public function order_by($order_by)
    {
        $this->query .= " ORDER BY $order_by ";
    }

    public function paginate($order_by, $last_value)
    {
        if(!empty($last_value)) {
            $mode = strtoupper(explode(' ', $order_by)[1]);

            switch ($mode) {
                case 'ASC':
                    $this->where(explode(' ', $order_by)[0] . ' > ' . $last_value);
                    break;
                case 'DESC':
                    $this->where(explode(' ', $order_by)[0] . ' < ' . $last_value);
                    break;
            }
        }
        $this->order_by($order_by);
    }
}