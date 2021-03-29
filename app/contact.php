<?php

include_once 'db.php';

class contact extends db{
    protected $tbl='contact_tbl';


    public function add_contact($data){
        $this->set_tbl($this->tbl);//method of db 
        $filds=array_keys($data);
        //var_dump($filds);die;
       $this->insertData($filds,$data);//method of db 
       
    }


    public function list_contact(){
        $this->set_tbl($this->tbl);//method of db 
        $res=$this->select_data('*');//method of db 
        return $res;
    }


    public function delete_contact($id){
        $this->set_tbl($this->tbl);//method of db 
        $this->delete_data($id);//method of db 
        //header("location:dashbord.php?contact=list");
    }


}