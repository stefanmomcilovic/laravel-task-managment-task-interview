<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    public $incrementing = true;

    protected $guarded = [];

    public $timestamps = true;
    const CREATED_AT = 'task_created_at';
    const UPDATED_AT = 'task_updated_at';
}
