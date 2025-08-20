<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\DataUsageModel;
use App\Models\DailyUsageModel;

class DataUsage extends BaseController
{
    use ResponseTrait;
    
    public function updateUsage($userId)
    {
        // Use service locator to avoid warnings from Intelephense
        $request = service('request');

        $amount = $request->getVar('amount');
        
        $validation = $this->validateRequest([
            'amount' => 'required|numeric'
        ]);
        
        if ($validation) {
            return $validation;
        }
        
        $dataUsageModel = new DataUsageModel();
        $dailyUsageModel = new DailyUsageModel();
        
        $currentUsage = $dataUsageModel->getCurrentUsage($userId);
        
        if (!$currentUsage) {
            return $this->failNotFound('Usage register not found');
        }
        
        // Update total usage
        $dataUsageModel->incrementUsage($currentUsage['id'], $amount);
        
        // Update daily usage
        $today = date('Y-m-d');
        $dailyUsage = $dailyUsageModel->getOrCreateDailyUsage($currentUsage['id'], $today);
        
        $dailyUsageModel->update($dailyUsage['id'], [
            'download' => $dailyUsage['download'] + $amount
        ]);
        
        return $this->respond(['status' => 'success']);
    }
}