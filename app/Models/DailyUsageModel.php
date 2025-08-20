<?php namespace App\Models;

use CodeIgniter\Model;

class DailyUsageModel extends Model
{
    protected $table = 'daily_usages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['data_usage_id', 'date', 'download', 'upload'];
    
    public function getOrCreateDailyUsage($dataUsageId, $date)
    {
        $usage = $this->where('data_usage_id', $dataUsageId)
            ->where('date', $date)
            ->first();
            
        if (!$usage) {
            $id = $this->insert([
                'data_usage_id' => $dataUsageId,
                'date' => $date,
                'download' => 0,
                'upload' => 0
            ]);
            return $this->find($id);
        }
        
        return $usage;
    }
}