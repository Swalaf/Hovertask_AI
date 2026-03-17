<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'action',
        'description',
        'ip_address',
        'user_agent',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log an activity
     */
    public static function log($data)
    {
        return static::create([
            'user_id' => $data['user_id'] ?? null,
            'type' => $data['type'] ?? 'system',
            'action' => $data['action'] ?? 'unknown',
            'description' => $data['description'] ?? '',
            'ip_address' => $data['ip_address'] ?? request()->ip(),
            'user_agent' => $data['user_agent'] ?? request()->userAgent(),
            'metadata' => $data['metadata'] ?? null,
        ]);
    }

    /**
     * Log user activity
     */
    public static function logUserActivity($user, $action, $description, $type = 'user', $metadata = null)
    {
        return static::log([
            'user_id' => $user->id ?? null,
            'type' => $type,
            'action' => $action,
            'description' => $description,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Log admin activity
     */
    public static function logAdminActivity($admin, $action, $description, $metadata = null)
    {
        return static::log([
            'user_id' => $admin->id ?? null,
            'type' => 'admin',
            'action' => $action,
            'description' => $description,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Log system activity
     */
    public static function logSystemActivity($action, $description, $metadata = null)
    {
        return static::log([
            'user_id' => null,
            'type' => 'system',
            'action' => $action,
            'description' => $description,
            'metadata' => $metadata,
        ]);
    }

    /**
     * Log authentication activity
     */
    public static function logAuthActivity($user, $action, $metadata = null)
    {
        return static::log([
            'user_id' => $user->id ?? null,
            'type' => 'auth',
            'action' => $action,
            'description' => "User {$action}",
            'metadata' => $metadata,
        ]);
    }

    /**
     * Log transaction activity
     */
    public static function logTransactionActivity($user, $action, $description, $metadata = null)
    {
        return static::log([
            'user_id' => $user->id ?? null,
            'type' => 'transaction',
            'action' => $action,
            'description' => $description,
            'metadata' => $metadata,
        ]);
    }
}
