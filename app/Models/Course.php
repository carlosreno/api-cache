<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * @var mixed|\Ramsey\Uuid\UuidInterface
     */

    protected $fillable = ['name','description'];
}
