<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
  
    // Candidate status constants
    public const STATUS_INITIAL_REVIEW = 'initial_review';
    public const STATUS_FIRST_CONTACT = 'first_contact';
    public const STATUS_TECHNICAL_REVIEW = 'technical_review';
    public const STATUS_TECHNICAL_TEST = 'technical_test';
    public const STATUS_SPECIFIC_MAINTENANCE = 'specific_maintainace';
    public const STATUS_REJECTED = 'rejected';
    

    protected $fillable = [
        'fullname', 'email', 'phone', 'github_profile',
        'linkedin_profile', 'year_of_experiance', 'status'
    ];
}
