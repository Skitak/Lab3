<?php
namespace User\Services;

use Zend\Db\TableGateway\TableGatewayInterface;  

class UserManager {
    protected $_tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){
        $this->_tableGateway = $tableGateway;
    }

    public function findByUsername($username){
        return $this->_tableGateway->select(['username' => $username])->current();
    }
}
?>