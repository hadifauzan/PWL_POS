<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Schema\Blueprint;
use illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['level_id', 'profile_image', 'username', 'nama', 'password', 'created_at', 'updated_at'];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    // protected $fillable = ['level_id', 'username', 'nama'];

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function stoks() : HasMany {
        return $this->hasMany(StokModel::class, 'user_id', 'user_id');
    }

    public function penjualans() : HasMany {
        return $this->hasMany(PenjualanModel::class, 'penjualan_id', 'penjualan_id');
    }

    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    public function getRole()
    {
        return $this->level->level_kode;
    }

    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('profile_image')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('profile_image');
    });
}


}