<?php

namespace fw\core\base;

use fw\core\Db;
use Valitron\Validator;
use fw\libs\Helper;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected $primaryKey = 'id';
    protected $attributes = [];
    public $errors = [];
    protected $rules = [];

    public function __construct()
    {
        $this->pdo = Db::getInstance();
    }

    /**
     * load data from form.
     *
     * @param $data
     */
    public function load($data)
    {
        foreach($this->attributes as $name => $value) {
            if(isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    /**
     *  сохраняем данные в БД.
     *
     * @param $table
     * @return int|string
     */
    public function save($table)
    {
        $tbl = \R::dispense($table);
        foreach($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }


    /**
     * create view of errors.
     */
    public function getErrors()
    {
        $errors = '<ul>';
        foreach($this->errors as $error) {
            foreach($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['errors'] = $errors;
    }


    /**
     * validation with 'Validator' package.
     *
     * @param $data
     * @param $rule
     * @return bool
     */
    public function validate($data, $rule)
    {
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($rule);
        if($v->validate()) {
            return TRUE;
        } else {
            $this->errors = $v->errors();
            return FALSE;
        }
    }

    /**
     * some query.
     *
     * @param $sql
     * @return bool
     */
//    public function query($sql)
//    {
//        return $this->pdo->execute($sql);
//    }

    /**
     * find all records from table.
     *
     * @return array
     */
//    public function findAll()
//    {
//        $sql = "SELECT * FROM  {$this->table}";
//        return $this->pdo->query($sql);
//    }

    /**
     * find only one record.
     *
     * @param $id
     * @param string $field
     * @return array
     */
//    public function findOne($id, $field = '')
//    {
//        $field = $field ?: $this->primaryKey;
//        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ? LIMIT 1";
//        return $this->pdo->query($sql, [$id]);
//    }

    /**
     * find by raw sql query.
     *
     * @param $sql
     * @param array $params
     * @return array
     */
//    public function findBySql($sql, $params = [])
//    {
//        return $this->pdo->query($sql, $params);
//    }

    /**
     * find by LIKE str.
     *
     * @param $str
     * @param $field
     * @param string $table
     * @return array
     */
//    public function findLike($str, $field, $table = '')
//    {
//        $table = $table ?: $this->table;
//        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
//        return $this->pdo->query($sql, ['%' . $str . '%']);
//    }
}