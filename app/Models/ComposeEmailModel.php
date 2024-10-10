<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposeEmailModel extends Model
{
    use HasFactory;

    // Specify the table if it's not the default pluralized form of the model name
    protected $table = 'compose_email'; // Optional: only if your table is not named 'compose_email'

    // // Define fillable fields (fields that can be mass-assigned)
    // protected $fillable = ['to_email', 'from_email', 'subject', 'body', 'attachments'];

    // // Disable timestamps if not required
    // public $timestamps = false;
}