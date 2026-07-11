<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'subject',
        'content',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    protected $appends = ['name', 'email', 'body', 'unread', 'time', 'tags'];

    public function getNameAttribute()
    {
        return $this->sender_name;
    }

    public function getEmailAttribute()
    {
        return $this->sender_email;
    }

    public function getBodyAttribute()
    {
        return $this->content;
    }

    public function getUnreadAttribute()
    {
        return !$this->is_read;
    }

    public function getTimeAttribute()
    {
        if ($this->created_at) {
            return $this->created_at->format('H:i A');
        }
        return 'Baru saja';
    }

    public function getTagsAttribute()
    {
        // Auto-generate tags from subject
        $tags = ['PESAN'];
        $subjectLower = strtolower($this->subject ?? '');
        if (str_contains($subjectLower, 'kerjasama') || str_contains($subjectLower, 'kolaborasi')) {
            $tags[] = 'KOLABORASI';
        }
        if (str_contains($subjectLower, 'bantuan') || str_contains($subjectLower, 'masalah')) {
            $tags[] = 'BANTUAN';
        }
        if (str_contains($subjectLower, 'saran') || str_contains($subjectLower, 'masukan')) {
            $tags[] = 'MASUKAN';
        }
        if (str_contains($subjectLower, 'pembayaran') || str_contains($subjectLower, 'konfirmasi')) {
            $tags[] = 'KEUANGAN';
        }
        if (str_contains($subjectLower, 'informasi') || str_contains($subjectLower, 'tanya')) {
            $tags[] = 'INFORMASI';
        }
        return $tags;
    }
}
