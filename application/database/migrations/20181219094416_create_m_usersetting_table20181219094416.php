<?php

class Migration_create_m_usersetting_table20181219094416 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('musersettings')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'UserId' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'LanguageId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 1
                ),
                'ColorId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 1
                ),
                'RowPerpage' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 5
                )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('musersettings');
            $this->db->query(add_foreign_key('musersettings', 'UserId', 'musers(Id)', 'CASCADE', 'CASCADE'));
        
            
            $dataSetting = [
                'UserId' => '1'
            ];
            
            $this->db->insert('musersettings', $dataSetting);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_usersetting_table20181219094416');
    }

}