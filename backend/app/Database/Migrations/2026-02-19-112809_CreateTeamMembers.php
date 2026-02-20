<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeamMembers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'team_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['owner', 'admin', 'member'],
                'default' => 'member',
            ],
        ]);

        $this->forge->addForeignKey('team_id', 'teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('team_members');
    }

    public function down()
    {
        $this->forge->dropTable('team_members');
    }

}
