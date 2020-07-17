<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

class UserCfModel extends DAO {
    private static $instance;

    public static function newInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function __construct() {
        parent::__construct();
    }

    public function getSQL($file) {
        $path = USERCF_PATH.'assets/model/'.$file;
        $sql = file_get_contents($path);

        return $sql;
    }

    public function install() {
        $sql = $this->getSQL('install.sql');
        if(!$this->dao->importSQL($sql)) {
            throw new Exception('Installation error: UserCfModel:'.$file);
        }
    }

    public function uninstall() {
        $sql = $this->getSQL('uninstall.sql');
        if(!$this->dao->importSQL($sql)) {
            throw new Exception('Uninstallation error: UserCfModel:'.$file);
        }
    }

    public function updatePlugin($version) {
        $sql = $this->getSQL('update'.$version.'.sql');
        if(!$this->dao->importSQL($sql)) {
            throw new Exception('Update error: UserCfModel:'.$file);
        }
    }
}

class UserCfModel_Meta extends DAO {
    private static $instance;

    public static function newInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function __construct() {
        parent::__construct();
        $this->setTableName('t_user_meta');
        $this->setPrimaryKey('pk_i_id');
        $this->setFields(array('pk_i_id', 'fk_i_user_id', 'fk_i_field_id', 's_value'));
    }

    public function findWhere($where) {
        $this->dao->select();
        $this->dao->from($this->getTableName());
        $this->dao->where($where);

        $result = $this->dao->get();
        if($result == false) {
            return array();
        }

        return $result->row();
    }

    public function listWhere($where) {
        $this->dao->select();
        $this->dao->from($this->getTableName());
        $this->dao->where($where);

        $result = $this->dao->get();
        if($result == false) {
            return array();
        }

        return $result->result();
    }

    public function deleteUser($id) {
        if(!is_numeric($id) || is_null($id)) {
            return array();
        }

        $this->delete(array('fk_i_user_id' => $id));
    }

    public function deleteField($id) {
        if(!is_numeric($id) || is_null($id)) {
            return array();
        }

        $this->delete(array('fk_i_field_id' => $id));
    }

    public function deleteFields($id) {
        $this->dao->delete($this->getTableName(), sprintf('fk_i_field_id IN ("%s")', $id));
    }
}

class UserCfModel_Field extends DAO {
    private static $instance;

    public static function newInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function __construct() {
        parent::__construct();
        $this->setTableName('t_user_cf');
        $this->setPrimaryKey('pk_i_id');
        $this->setFields(array('pk_i_id', 's_name', 's_slug', 's_type', 's_options', 'i_min', 'i_max', 'b_enabled', 'b_public', 'b_required', 'e_position', 'i_order'));
    }

    public function listAll() {
        $this->dao->select($this->getFields());
        $this->dao->from($this->getTableName());
        $this->dao->orderBy('i_order', 'ASC');

        $result = $this->dao->get();
        if($result == false) {
            return array();
        }

        return $result->result();
    }

    public function listWhere($where, $aWhere = null) {
        $this->dao->select();
        $this->dao->from($this->getTableName());
        $this->dao->where($where);
        $this->dao->orderBy('i_order', 'ASC');

        // For more complex queries.
        if(!is_null($aWhere) && is_array($aWhere) && count($aWhere) > 0) {
            foreach($aWhere as $statement) {
                $this->dao->where($statement);
            }
        }

        $result = $this->dao->get();
        if($result == false) {
            return array();
        }

        return $result->result();
    }

    public function listReg($required = false) {
        $where = array('b_enabled' => 1);
        $aWhere = array('e_position = "REG" OR e_position = "BOTH"');

        if($required) $where['b_required'] = 1;

        return $this->listWhere($where, $aWhere);
    }

    public function listDash($required = false) {
        $where = array('b_enabled' => 1);
        $aWhere = array('e_position = "DASH" OR e_position = "BOTH"');

        if($required) $where['b_required'] = 1;

        return $this->listWhere($where, $aWhere);
    }

    public function listBoth($required = false) {
        $where = array('b_enabled' => 1);
        if($required) $where['b_required'] = 1;

        return $this->listWhere($where);
    }

    public function getLastOrder() {
        $this->dao->select('MAX(i_order) AS max');
        $this->dao->from($this->getTableName());

        $result = $this->dao->get();
        if($result === false) {
            return 0;
        }
        if($result->numRows() !== 1) {
            return 0;
        }

        return (int) $result->row()['max'];
    }

    function deleteByPrimaryKey($value) {
        $meta = UserCfModel_Meta::newInstance()->deleteField($value);
        $field = $this->delete(array($this->getPrimaryKey() => $value));

        return ($meta || $field);
    }

    function deleteBulk($value) {
        $meta = UserCfModel_Meta::newInstance()->deleteFields($value);
        $field = $this->dao->delete($this->getTableName(), sprintf('pk_i_id IN ("%s")', $value));

        return ($meta || $field);
    }
}
?>
