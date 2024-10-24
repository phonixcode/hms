<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait SoftDeleteTrait
{
    public function restoreModel($id)
    {
        $model = $this->model::withTrashed()->find($id);
        
        // Check if the model exists and is soft deleted
        if (!$model || !$model->trashed()) {
            return null;
        }
        
        $model->restore();
        return $model;
    }
}
