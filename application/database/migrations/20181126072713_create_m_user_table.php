<?php

class Migration_create_m_user_table extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        
        if (!$this->db->table_exists('musers')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'GroupId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => true
                ),
                'Username' => array(
                    'type' => 'varchar',
                    'constraint' => 100
                ),
                'Password' => array(
                    'type' => 'varchar',
                    'constraint' => 50
                ),
                'IsLoggedIn' => array(
                    'type' => 'smallint',
                    'constraint' => 11,
                    'default' => 0
                ),
                'IsActive' => array(
                    'type' => 'smallint',
                    'constraint' => 11,
                    'default' => 1
                ),
                'Language' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'default' => 'indonesia'
                ),
                'IOn' => array(
                    'type' => 'datetime',
                    'null' => true
                ),
                'IBy' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'null' => true
                ),
                'UOn' => array(
                    'type' => 'datetime',
                    'null' => true
                ),
                'UBy' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'null' => true
                )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('musers');
            $this->db->query(add_foreign_key('musers', 'GroupId', 'mgroupusers(Id)', 'RESTRICT', 'CASCADE'));
        }
    }

    public function down() {
        // $this->dbforge->drop_table('m_user');
    }

}