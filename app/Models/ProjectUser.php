<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'project_user'; // اسم الجدول إذا كان مختلفاً عن الاسم الافتراضي

    protected $fillable = [
        'project_id',
        'user_id',
        'role',
        'contribution_hours',
        'last_activity'
    ];
    public $timestamps = true;
    // علاقة مع نموذج Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // علاقة مع نموذج User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
