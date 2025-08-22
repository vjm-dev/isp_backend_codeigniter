<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\PlanModel;

class Plan extends BaseController
{
    use ResponseTrait;
    
    public function getPlans()
    {
        $model = new PlanModel();
        $plans = $model->findAll();
        
        return $this->respond(array_map(function($plan) {
            return [
                'id' => (int)$plan['id'],
                'name' => $plan['name'],
                'speed' => $plan['speed'],
                'data_limit' => (float)$plan['data_limit'],
                'monthly_payment' => (float)$plan['monthly_payment'],
                'created_at' => $plan['created_at'],
                'updated_at' => $plan['updated_at']
            ];
        }, $plans));
    }
}