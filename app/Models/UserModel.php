<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'plan_id', 'password', 'last_updated'];
    
    public function getUserByEmail($email)
    {
        return $this->select('users.*, plans.name as plan_name, plans.monthly_payment, plans.data_limit')
                    ->join('plans', 'plans.id = users.plan_id')
                    ->where('users.email', $email)
                    ->first();
    }
    
    public function getUserWithPlan($userId)
    {
        return $this->select('users.*, plans.name as plan_name, plans.monthly_payment, plans.data_limit')
                    ->join('plans', 'plans.id = users.plan_id')
                    ->where('users.id', $userId)
                    ->first();
    }
    
    public function updateLastUpdated($userId)
    {
        return $this->update($userId, ['last_updated' => date('Y-m-d H:i:s')]);
    }
}