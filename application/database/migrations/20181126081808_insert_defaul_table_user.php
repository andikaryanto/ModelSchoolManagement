<?php

class Migration_insert_defaul_table_user extends CI_Migration {

    private $table = 'musers';
    public function up() {
        $data = [
            'Username' => 'superadmin',
            'Password' => '0d403ffb03c72dff96ee1d0de8c75ee8'
        ];
        $this->db->insert($this->table, $data);

    }

    public function down() {
        //$this->dbforge->drop_table('insert_defaul_table_user');
    }

}