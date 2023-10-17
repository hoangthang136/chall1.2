<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;
    protected $table = 'assignments';
    protected $fillable = ['title', 'upload_file_baitap'];
}
