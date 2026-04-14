<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use ALajusticia\Logins\Traits\HasLogins;
use App\Enums\UserStatusesEnum;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, HasLogins, HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password',
        'type',
        'status',
    ];

    protected $appends = ['role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function makeActive()
    {
        $this->update([
            'status' => UserStatusesEnum::ACTIVE->value,
        ]);
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn () => $this->type
        );
    }

    public function bookPurchases(): HasMany
    {
        return $this->hasMany(TenderBookPurchase::class);
    }

    // public function hasPurchasedTender(Tender $tender): bool
    // {
    //     return $this->bookPurchases()
    //         ->where('tender_id', $tender->id)
    //         ->paid()
    //         ->exists();
    // }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function agencies(): BelongsToMany
    {
        return $this->belongsToMany(Agency::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(TenderInquiry::class);
    }

    public function company(): ?Company
    {
        return $this->companies()->first();
    }

    public function isInactive(): bool
    {
        return false;
    }
}
