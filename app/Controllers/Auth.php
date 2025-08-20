<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Models\DataUsageModel;
use App\Models\DailyUsageModel;

class Auth extends BaseController
{
    use ResponseTrait;
    
    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        if (!$email) {
            return $this->fail('Email is required', 400);
        }
        
        $validation = $this->validateRequest([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if ($validation) {
            return $validation;
        }
        
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);
        
        if (!$user) {
            return $this->failNotFound('User not found');
        }
        
        if (!$password || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Invalid email or password');
        }
        
        // Update timestamp
        $userModel->updateLastUpdated($user['id']);
        
        // Get complete user data
        return $this->respond($this->buildUserResponse($user));
    }

    public function logout()
    {
        return $this->respond([
            'status' => 'success',
            'message' => 'Logout successful'
        ]);
    }
    
    public function buildUserResponse($user)
    {
        $dataUsageModel = new DataUsageModel();
        $dailyUsageModel = new DailyUsageModel();
        
        $dataUsage = $dataUsageModel->getCurrentUsage($user['id']);
        $dailyUsage = [];
        
        if ($dataUsage) {
            $dailyUsage = $dailyUsageModel->where('data_usage_id', $dataUsage['id'])->findAll();
        }
        
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'planName' => $user['plan_name'],
            'monthlyPayment' => (float)($user['monthly_payment']),
            'lastUpdated' => $user['last_updated'] ?? date('Y-m-d H:i:s'),
            'data_usage' => $dataUsage ? [
                'start_date' => $dataUsage['start_date'],
                'end_date' => $dataUsage['end_date'],
                'used' => (float)$dataUsage['used'],
                'limit' => (float)$dataUsage['limit'],
                'daily_usage' => array_map(function($item) {
                    return [
                        'date' => $item['date'],
                        'download' => (float)$item['download'],
                        'upload' => (float)$item['upload']
                    ];
                }, $dailyUsage)
            ] : null
        ];
    }
}