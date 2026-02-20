<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'team_id',
        'title',
        'type',
        'status',
        'description'
    ];
}

