<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'destination',
        'education_level',
        'english_test',
        'message',
        'source',
        'is_seen',
        'seen_at',
        'seen_by',
        'status',
        'notes',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'is_seen' => 'boolean',
            'seen_at' => 'datetime',
        ];
    }

    public function seenByUser()
    {
        return $this->belongsTo(User::class, 'seen_by');
    }

    public function scopeUnseen($query)
    {
        return $query->where('is_seen', false);
    }

    public function scopeSeen($query)
    {
        return $query->where('is_seen', true);
    }

    /**
     * Mark message as seen.
     */
    public function markAsSeen(?User $user = null): void
    {
        $viewer = $user ?? Auth::user();
        $this->update([
            'is_seen' => true,
            'seen_at' => now(),
            'seen_by' => $viewer?->id,
        ]);
    }

    /**
     * Mark message as unseen.
     */
    public function markAsUnseen(): void
    {
        $this->update([
            'is_seen' => false,
            'seen_at' => null,
            'seen_by' => null,
        ]);
    }

    /**
     * Generate direct Gmail web/app compose link with student email and template.
     */
    public function getGmailComposeUrlAttribute(): string
    {
        $subject = 'Regarding Your Free Consultation Request - Springway Education';
        $dest = $this->destination ?: 'Abroad';
        $body = "Dear {$this->name},\n\nThank you for reaching out to Springway Education regarding your study plans in {$dest}.\n\nOur counseling team has received your consultation request and would like to invite you for a 1-on-1 profile assessment and roadmap discussion.\n\nPlease let us know what day and time would be most convenient for you (in-person at our Sylhet office or online via WhatsApp/Meet).\n\nBest regards,\nSpringway Education Advisory Team\nKaniz Plaza (3rd Floor), Zindabazar, Sylhet\nPhone/WhatsApp: +880 1341 55 88 22\nWebsite: https://springwaybd.com";

        return 'https://mail.google.com/mail/?view=cm&fs=1'
            . '&to=' . urlencode($this->email)
            . '&su=' . urlencode($subject)
            . '&body=' . urlencode($body);
    }

    /**
     * Generate mailto link as native email client fallback.
     */
    public function getMailtoUrlAttribute(): string
    {
        $subject = 'Regarding Your Consultation Request - Springway Education';
        return 'mailto:' . rawurlencode($this->email) . '?subject=' . rawurlencode($subject);
    }

    /**
     * Clean phone number for WhatsApp link.
     */
    public function getCleanPhoneAttribute(): string
    {
        return preg_replace('/[^0-9]/', '', $this->phone);
    }

    public function getWhatsAppUrlAttribute(): string
    {
        $phone = $this->clean_phone;
        // Prefix with 880 if started with 01
        if (str_starts_with($phone, '01')) {
            $phone = '88' . $phone;
        }
        $msg = "Hello {$this->name}, this is Springway Education following up on your consultation request for {$this->destination}.";
        return 'https://wa.me/' . $phone . '?text=' . urlencode($msg);
    }
}

