<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamMemberModel extends Model
{
    protected $table = 'teammembers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'team_id',
        'user_id',
        'role'
    ];
}

