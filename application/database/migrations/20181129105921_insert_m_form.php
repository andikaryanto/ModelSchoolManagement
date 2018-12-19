<?php

class Migration_insert_m_form extends CI_Migration {

    private $table = 'mforms';
    public function up() {
        $this->load->helper('db_helper');
        //$data = array();
        $data = array('data' =>
            array(
                'FormName' => 'mgroupusers',
                'AliasName' => 'master group user',
                'LocalName' => 'master grup pengguna',
                'ClassName' => 'Master',
                'Resource' => 'res_groupuser',
                'IndexRoute' => 'mgroupuser'
            ),
            array(
                'FormName' => 'musers',
                'AliasName' => 'master user',
                'LocalName' => 'master pengguna',
                'ClassName' => 'Master',
                'Resource' => 'res_user',
                'IndexRoute' => 'muser'
            ),
            array(
                'FormName' => 'mschools',
                'AliasName' => 'master school',
                'LocalName' => 'master sekolah',
                'ClassName' => 'Master',
                'Resource' => 'res_school',
                'IndexRoute' => 'mschool'
            ),
            array(
                'FormName' => 'mclases',
                'AliasName' => 'master class',
                'LocalName' => 'master kelas',
                'ClassName' => 'Master',
                'Resource' => 'res_class',
                'IndexRoute' => 'mclass'
            ),
            array(
                'FormName' => 'mschoolyears',
                'AliasName' => 'master school year',
                'LocalName' => 'master tahun ajaran',
                'ClassName' => 'Master',
                'Resource' => 'res_schoolyear',
                'IndexRoute' => 'mschoolyear'
            ),
            array(
                'FormName' => 'mworkers',
                'AliasName' => 'master worker',
                'LocalName' => 'master pekerja',
                'ClassName' => 'Master',
                'Resource' => 'res_worker',
                'IndexRoute' => 'mworker'
            ),
            array(
                'FormName' => 'msubjects',
                'AliasName' => 'master subject',
                'LocalName' => 'master mata pelajaran',
                'ClassName' => 'Master',
                'Resource' => 'res_subject',
                'IndexRoute' => 'msubject'
            )
        );
        foreach ($data as $value){
            $this->db->insert($this->table, $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_form');
    }

}