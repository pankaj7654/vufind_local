<?php

namespace Inflibnet\AjaxHandler;
use Laminas\Mvc\Controller\Plugin\Params;
use VuFind\AjaxHandler\AbstractBase;
use Inflibnet\View\Helper\Root\Record;
use Vufind\Db\Row\ExternalSession;
use PDO;
use VuFind\Db\Row\User;


class SaveUserDetails extends User
{
    public function saveUserDetail($userId, $fname, $lname, $userEmail)
    {
        // Validate and sanitize input data if necessary.

        $userTableObj = $this->getDbTable('user');
        $row = $userTableObj->select(['id' => $userId])->current();

        if (!empty($row)) {
            // Check if any fields need to be updated.
            $changed = false;

            if ($row->firstname !== $fname) {
                $row->firstname = $fname;
                $changed = true;
            }

            if ($row->lastname !== $lname) {
                $row->lastname = $lname;
                $changed = true;
            }

            if ($row->email !== $userEmail) {
                $row->email = $userEmail;
                $changed = true;
            }

            if ($changed) {
                // Save only if changes were made.
                $row->save();
            }
            
            // Return a success message or other relevant data.
            return ['message' => 'User details updated successfully'];
        } else {
            // Handle the case where the user does not exist.
            return ['error' => 'User not found'];
        }
    }

    public function handleRequest(Params $params)
    {
        $userId = $params->fromQuery('userid');
        $fname = $params->fromQuery('fname');
        $lname = $params->fromQuery('lname');
        $userEmail = $params->fromQuery('useremail');

        $data = $this->saveUserDetail($userId, $fname, $lname, $userEmail);

        // Handle and format the response based on the result.
        if (isset($data['error'])) {
            // Return an error response.
            return $this->formatResponse($data, 404); // You can use a different HTTP status code as needed.
        } else {
            // Return a success response.
            return $this->formatResponse($data);
        }
    }
}


// // class SaveUserDetails extends AbstractBase
// class SaveUserDetails extends User
// {
//     public function saveuserdetail($userid, $fname, $lname, $useremail){
//         $usertableobj = $this->getDbTable('user');
//         $row = $usertableobj->select(['id' => $userid, 'firstname' => $fname,'lastname' =>$lname, 'email'=>$useremail])->current();
//         if (!empty($row)) {
//             $this->firstname = $row->firstname;
//             $this->lastname = $row->lastname;
//             $this->email = $row->email;
//             $this->save();
//         }
//     }

//     public function handleRequest(Params $params)
//     {
//         $userid = $params->fromQuery('userid');
//         $fname = $params->fromQuery('fname');
//         $lname = $params->fromQuery('lname');
//         $useremail = $params->fromQuery('useremail');

//         $data = $this->saveuserdetail($userid, $fname, $lname, $useremail);
//         return $this->formatResponse($data);
//         // return $userid;
//     }
// }
