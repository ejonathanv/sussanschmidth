<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'icon',
        'order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope to get only active social links ordered by order field
     */
    public function scopeActiveAndOrdered($query)
    {
        return $query->where('active', true)->orderBy('order');
    }

    /**
     * Get available social media icons
     */
    public static function getAvailableIcons()
    {
        return [
            'ion-social-instagram' => 'Instagram',
            'ion-social-facebook' => 'Facebook',
            'ion-social-twitter' => 'Twitter',
            'ion-social-linkedin' => 'LinkedIn',
            'ion-social-pinterest' => 'Pinterest',
            'ion-social-youtube' => 'YouTube',
            'ion-social-github' => 'GitHub',
            'ion-social-whatsapp' => 'WhatsApp',
            'ion-social-tumblr' => 'Tumblr',
            'ion-social-reddit' => 'Reddit',
            'ion-social-skype' => 'Skype',
            'ion-social-googleplus' => 'Google+',
        ];
    }
}
