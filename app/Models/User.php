<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory,Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    /**
     * @return BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_user')
            ->withPivot('role', 'contribution_hours', 'last_activity');
    }

    /**
     * @return HasManyThrough
     */
    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, ProjectUser::class, 'user_id', 'project_id', 'id', 'project_id');
    }

    /**
     * تحقق ما إذا كان المستخدم مديراً للمشروع
     *
     * @param int $projectId
     * @return bool
     */
    public function isManagerOfProject(int $projectId): bool
    {
        return $this->projects()->where('project_id', $projectId)->wherePivot('role', 'manager')->exists();
    }

    /**
     * تحقق ما إذا كان المستخدم مطوراً للمشروع
     *
     * @param int $projectId
     * @return bool
     */
    public function isDeveloperOfProject(int $projectId): bool
    {
        return $this->projects()->where('project_id', $projectId)->wherePivot('role', 'developer')->exists();
    }

    /**
     * تحقق ما إذا كان المستخدم مختبراً للمشروع
     *
     * @param int $projectId
     * @return bool
     */
    public function isTesterOfProject(int $projectId): bool
    {
        return $this->projects()->where('project_id', $projectId)->wherePivot('role', 'tester')->exists();
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}