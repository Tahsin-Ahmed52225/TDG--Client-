<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'assign_employee', 'due_date', 'status', 'priority', 'description', 'budget', 'payment_amount', 'manager_id', 'manager_id', 'project_files'
    ];
}
