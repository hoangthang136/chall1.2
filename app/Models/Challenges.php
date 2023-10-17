<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{
    use HasFactory;
    protected $table = 'challenges';
    protected $fillable = ['chall_name', 'hint','chall_file'];
}
