<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'age',
        'disease_code',
        'disease_name',
        'symptoms_selected',
        'answers',
        'recommendation',
        'confidence_level', 
    ];


    protected $casts = [
        'answers' => 'array',
        'confidence_level' => 'float',
        'age' => 'integer',
        'created_at' => 'datetime'
    ];

    // Accessor untuk answers
    public function getAnswersAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return $decoded ?: [];
        }
        
        return [];
    }

    // Mutator untuk answers
    public function setAnswersAttribute($value)
    {
        $this->attributes['answers'] = is_array($value) ? json_encode($value) : $value;
    }
}