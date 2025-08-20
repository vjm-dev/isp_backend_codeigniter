<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends BaseController
{
    use ResponseTrait;
    
    public function getUserData($userId)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserWithPlan($userId);
        
        if (!$user) {
            return $this->failNotFound('User not found');
        }
        
        $auth = new Auth();
        return $this->respond($auth->buildUserResponse($user));
    }
}