<?php

namespace App\Zhenggg\Auth\Database;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('front.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('front.database.roles_table'));

        parent::__construct($attributes);
    }

    /**
     * A role belongs to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function administrators()
    {
        return $this->hasMany(Administrator::class, 'role_id');
    }

    /**
     * A role belongs to many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        $pivotTable = config('front.database.role_permissions_table');

        $relatedModel = config('front.database.permissions_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'permission_id');
    }

    /**
     * Check user has permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function can($permission)
    {
        return $this->permissions()->where('slug', $permission)->exists();
    }

    /**
     * Check user has no permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function cannot($permission)
    {
        return !$this->can($permission);
    }
}
