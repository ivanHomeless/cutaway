<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

/**
 * Class Contact
 * @property  integer $id
 * @property  string $title
 * @property  string $main_link
 * @property  string $main_text
 * @property  string $example
 * @property  string $logo
 * @property  string $color
 * @property  string $background_color
 *
 * @property Profile[] $profiles
 * @package App\Models
 * @mixin Eloquent
 *
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'main_link',
        'main_text',
        'example',
        'logo',
        'background_color',
        'color',
    ];

    public function profiles() {
        return $this->belongsToMany(Profile::class)->withPivot('link', 'text', 'order_button', 'slug');;
    }
}
