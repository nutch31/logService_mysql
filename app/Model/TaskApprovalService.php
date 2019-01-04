<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskApprovalService extends Model
{
    //
    protected $table = "log_task_approval_service";

    protected $fillable = [
                            'user_type', 
                            'user_id', 
                            'event', 
                            'auditable_type', 
                            'auditable_id', 
                            'old_values', 
                            'new_values', 
                            'url', 
                            'ip_address', 
                            'user_agent', 
                            'tags', 
                            'created_at', 
                            'updated_at'
                        ];
}