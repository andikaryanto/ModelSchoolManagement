<?php

class Migration_create_m_accesrole_view extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $sql = "CREATE OR REPLACE VIEW view_maccessroles
                as
                SELECT a.Id AS GroupId,
                    b.Id AS FormId, 
                    b.FormName AS FormName,
                    b.AliasName AS AliasName,
                    b.LocalName AS LocalName,
                    IFNULL(c.Read,0) AS Readd,
                    IFNULL(c.Write,0) AS Writee,
                    IFNULL(c.Delete,0) AS Deletee,
                    IFNULL(c.Print,0) AS Printt,
                    b.ClassName AS ClassName,
                    0 AS Header
                FROM ((mgroupusers a JOIN mforms b) 
                LEFT JOIN maccessroles c ON(((c.FormId = b.Id) 
                    AND (c.GroupId = a.Id)))) 
                UNION ALL 
                SELECT DISTINCT NULL,
                    NULL,
                    NULL,
                    ClassName AS ClassName,
                    NULL,
                    NULL,
                    NULL,
                    NULL,
                    NULL,
                    ClassName AS ClassName,
                    1 AS Header 
                FROM mforms ORDER BY 10,11";
        $query = $this->db->query($sql);
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_accesrole_view');
    }

}