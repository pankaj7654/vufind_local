<?php

namespace Inflibnet\Controller;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Sql\Expression;
use Laminas\Db\Sql\Select; 
use Inflibnet\Db\Row\User;
use Laminas\Db\Adapter\Adapter;

use Laminas\Session\Container;
use VuFind\Db\Row\RowGateway;

class MyResearchController extends \VuFind\Controller\MyResearchController
{
    // use \VuFind\ILS\Logic\SummaryTrait;
    // protected $adapter;

    // private $table;

    // public function __construct(User $table)
    // {
    //     $this->table = $table;
    // }
   
    public function updateUserDetailsAction(){
        // global $adapter;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = $this->getUserTable();
            // $user = $this->getUser();
            if (!$user) {
                return $this->forceLogin();
            }
            $view = $this->createViewModel();
            $view->request = $this->getRequest()->getPost();

            $table = 'user';
            $userid = $view->request['userid'];
            $firstname = $view->request['firstname'];
            $lastname = $view->request['lastname'];
            $email = $view->request['email'];
            // print_r(' '.$userid.' '.$firstname.' '.$lastname.' '.$email);

            // print_r($user->pass_hash);
            // exit;
            
            // $user = new user($this->adapter);
            // $user->getSavedUserData($userid,$firstname,$lastname, $email);
            // exit;

            $user->getSavedUserData($userid,$firstname,$lastname, $email);
            return $this->forwardTo('MyResearch', 'Profile');
        }
        else{
            return $this->forwardTo('MyResearch', 'Profile');
        }

        
    }
}

