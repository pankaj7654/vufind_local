<?php

namespace Inflibnet\Db\Row;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Sql;
use VuFind\Db\Table\Gateway;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\TableGateway\Feature;
use VuFind\Db\Table\PluginManager;
use VuFind\Db\Row\RowGateway;

class User extends \VuFind\Db\Row\User
{
    /**
     * Is encryption enabled?
     *
     * @var bool
     */
    protected $encryptionEnabled = null;

    /**
     * Encryption key used for catalog passwords (null if encryption disabled):
     *
     * @var string
     */
    protected $encryptionKey = null;

    /**
     * VuFind configuration
     *
     * @var \Laminas\Config\Config
     */
    protected $config = null;

    /**
     * Constructor
     *
     * @param \Laminas\Db\Adapter\Adapter $adapter Database adapter
     */
    public function __construct($adapter)
    {
        parent::__construct('id', 'user', $adapter);
    }

    /**
     * Configuration setter
     *
     * @param \Laminas\Config\Config $config VuFind configuration
     *
     * @return void
     */
    public function setConfig(\Laminas\Config\Config $config)
    {
        $this->config = $config;
    }
    
    //update user details by controller call
    public function getSavedUserData($userid,$firstname,$lastname, $email){
        // $this->firstname = $firstname;
        // $this->lastname = $lastname;
        // $this->email = $email;
        // $this->save();
        // return "success";

        // /**
        //  * Get a database table object.
        //  *
        //  * @param string $table Table to load.
        //  *
        //  * @return Gateway
        //  */
        // $table = $this->getDbTable('user');
        // $row = $table->select(['id' => $userid])->current();
        // if (!empty($row)){
        //     $this->firstname = $firstname;
        //     $this->lastname = $lastname;
        //     $this->email = $email;
        //     $this->save();
        //     return "success";
        // }
        // else{
        //     throw new \Exception('value getting wrong !');
        // }

        // $table = $this->getDbTable('user');
        // $row = $table->select(['id' => $userid])->current();
        // if (!empty($row)){
        //     $this->firstname = $firstname;
        //     $this->lastname = $lastname;
        //     $this->email = $email;
        //     $this->save();
        //     return "success";
        // }
        // else{
        //     throw new \Exception('value getting wrong !');
        // }
    }
}

