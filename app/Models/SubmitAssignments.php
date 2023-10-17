<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitAssignments extends Model
{
    use HasFactory;
    protected $table = 'submit_assignments';
    protected $fillable = ['tensv', 'upload_file_nopbai', 'sv_id', 'baitap_id'];
}
