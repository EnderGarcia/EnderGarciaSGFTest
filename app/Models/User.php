<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DateTimeInterface;
use App\Models\DocumentType;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'document_type_id',
    ];

    public function document()
    {
      return $this->hasOne(DocumentType::class,'id','document_type_id');
    }

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date;
    }
}
