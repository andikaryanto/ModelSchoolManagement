<?php

class Migration_create_m_enum_table20181201061354 extends CI_Migration {

    private $tabledetail = 'menumdetails';
    public function up() {
        $this->load->helper('db_helper');
        
        if (!$this->db->table_exists('menums')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'Name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100
                )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('menums');

            //insert data
            $data = array('data' =>
                
                array(
                    'Name' => 'Months'
                ),
                array(
                    'Name' => 'Gender'
                ),
                array(
                    'Name' => 'Religion'
                ));
            foreach ($data as $value){
                $this->db->insert('menums', $value);
            }
        }
        
        if (!$this->db->table_exists('menumdetails')){
        //table detail
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'EnumId' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'Value' => array(
                    'type' => 'INT',
                    'constraint' => 11
                ),
                'EnumName' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50
                ),
                'Ordering' => array(
                    'type' => 'TINYINT',
                    'constraint' => 11
                ),
                'Resource' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => true
                )
            ));

            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('menumdetails');
            $this->db->query(add_foreign_key('menumdetails', 'EnumId', 'menums(Id)', 'RESTRICT', 'CASCADE'));

            //insert data
            $data = array('data' =>
                
                array(
                    'EnumId' => 1,
                    'Value' => 1,
                    'EnumName' => 'January',
                    'Ordering' => 1,
                    'Resource' => 'res_january'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 2,
                    'EnumName' => 'February',
                    'Ordering' => 2,
                    'Resource' => 'res_february'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 3,
                    'EnumName' => 'March',
                    'Ordering' => 3,
                    'Resource' => 'res_march'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 4,
                    'EnumName' => 'April',
                    'Ordering' => 4,
                    'Resource' => 'res_april'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 5,
                    'EnumName' => 'May',
                    'Ordering' => 5,
                    'Resource' => 'res_may'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 6,
                    'EnumName' => 'June',
                    'Ordering' => 6,
                    'Resource' => 'res_june'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 7,
                    'EnumName' => 'July',
                    'Ordering' => 7,
                    'Resource' => 'res_july'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 8,
                    'EnumName' => 'August',
                    'Ordering' => 8,
                    'Resource' => 'res_august'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 9,
                    'EnumName' => 'September',
                    'Ordering' => 9,
                    'Resource' => 'res_september'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 10,
                    'EnumName' => 'October',
                    'Ordering' => 10,
                    'Resource' => 'res_october'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 11,
                    'EnumName' => 'November',
                    'Ordering' => 11,
                    'Resource' => 'res_november'
                ),
                array(
                    'EnumId' => 1,
                    'Value' => 12,
                    'EnumName' => 'December',
                    'Ordering' => 12,
                    'Resource' => 'res_december'
                ),
                array(
                    'EnumId' => 2,
                    'Value' => 1,
                    'EnumName' => 'Male',
                    'Ordering' => 1,
                    'Resource' => 'res_male'
                ),
                array(
                    'EnumId' => 2,
                    'Value' => 2,
                    'EnumName' => 'Female',
                    'Ordering' => 2,
                    'Resource' => 'res_female'
                ),
                array(
                    'EnumId' => 3,
                    'Value' => 1,
                    'EnumName' => 'Islam',
                    'Ordering' => 1
                ),
                array(
                    'EnumId' => 3,
                    'Value' => 2,
                    'EnumName' => 'Kristen',
                    'Ordering' => 2
                ),
                array(
                    'EnumId' => 3,
                    'Value' => 2,
                    'EnumName' => 'Katholik',
                    'Ordering' => 3
                ),
                array(
                    'EnumId' => 3,
                    'Value' => 4,
                    'EnumName' => 'Hindu',
                    'Ordering' => 4
                ),
                array(
                    'EnumId' => 3,
                    'Value' => 5,
                    'EnumName' => 'Budha',
                    'Ordering' => 5
                ),
                array(
                    'EnumId' => 3,
                    'Value' => 6,
                    'EnumName' => 'None',
                    'Ordering' => 6
                )
            );
            foreach ($data as $value){
                $this->db->insert('menumdetails', $value);
            }
        }
    }

    public function down() {
        // $this->dbforge->drop_table('menumdetails');
        // $this->dbforge->drop_table('menums');
    }

}