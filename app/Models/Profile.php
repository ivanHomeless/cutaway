<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

/**
 * Class Profile
 *
 * @property  string $name
 * @property  integer $user_id
 * @property  string $description
 * @property  string $user_img
 * @property  integer $created_at
 * @property  integer $updated_at
 * @property  integer $deleted_at
 *
 * @property  User $user
 * @property  Contact[] $contacts
 * @mixin Eloquent
 * @package App\Models
 */
class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'user_img',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contacts() {
        return $this->belongsToMany(Contact::class)->withPivot('link', 'text', 'order_button', 'slug');
    }
}
