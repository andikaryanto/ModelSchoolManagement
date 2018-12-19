<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function encryptMd5($string){
    $hash = md5($string);
    $lastestString = substr($hash, strlen($hash) - 1,1);
    $asci = ord($lastestString);
    $asci++;
    $newChar = chr($asci++);
    $newString = substr($hash, 0,strlen($hash) - 1).$newChar;
    echo $lastestString;
    return $newString;
}

function formatDateString($date){
    return (string)date("d-m-Y",strtotime($date));
}

function getEnumName($enumName, $enumDetailId){
    $CI =& get_instance();
    //$CI->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $CI->config->item('language'));

    $CI->db->select('b.*');
    $CI->db->from('m_enums a');
    $CI->db->join('m_enumdetails b','a.Id = b.EnumId','inner');
    $CI->db->where('a.Name', $enumName);
    $CI->db->where('b.Value', $enumValue);
    $data = $CI->db->get()->row();

    //return $data->Resource;
    if(isset($data)){
        if(isset($data->Resource)){
            //$newStr = str_replace("res","ui",$data->Resource);
            return lang($newStr);
        } else {
            return $data->EnumName;
        }
    }
    return "";

}

function replaceSession($name, $data){
    $CI =& get_instance();
    $CI->session->set_userdata($name, $data);
}

function load_view($viewName, $data = null)
{
    $CI =& get_instance();
    $CI->paging->load_header();
    $CI->load->view($viewName, $data);
    $CI->paging->load_footer();
}

// function getLang($res){

//     $CI =& get_instance();
//     $CI->lang->load(array('form_ui','err_msg','info_msg'), !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $CI->config->item('language'));
//     return $CI->lang->line($res);
// }

// function decryptMd5($hash){
//     $lastestString = substr($string, strlen($string) - 2,1);
//     $asci = ord($lastestString);
//     $asci--;
//     $newChar = chr($asci++);
//     $newString = substr($string, 0,strlen($string) - 1).$newChar;
//     return $newString;
// }