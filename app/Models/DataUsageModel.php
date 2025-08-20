<?php namespace App\Models;

use CodeIgniter\Model;

class DataUsageModel extends Model
{
    protected $table = 'data_usages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'start_date', 'end_date', 'used', 'limit'];
    
    public function getCurrentUsage($userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('end_date', 'DESC')
            ->first();
    }
    
    public function incrementUsage($dataUsageId, $amount)
    {
        $this->set('used', "used + $amount", false)
            ->where('id', $dataUsageId)
            ->update();
    }
}