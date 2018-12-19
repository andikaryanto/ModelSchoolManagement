<?php

class Migration_create_m_accessrole_table extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        
        if (!$this->db->table_exists('maccessroles')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'FormId' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'GroupId' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'Read' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
                'Write' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
                'Delete' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
                'Print' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1
                ),
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('maccessroles');
            $this->db->query(add_foreign_key('maccessroles', 'GroupId', 'mgroupusers(Id)', 'RESTRICT', 'CASCADE'));
            $this->db->query(add_foreign_key('maccessroles', 'FormId', 'mforms(Id)', 'RESTRICT', 'CASCADE'));
        }   
    }

    public function down() {
        // $this->dbforge->drop_table('m_accessrole');
    }

}