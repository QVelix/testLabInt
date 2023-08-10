<?php
namespace Models;

class User{
    public function getUser($id){
        $users = $this->getUsers();
        $user = NULL;
        foreach($users as $u){
            if($u["id"] == $id) $user = $u;
            continue;
        }
        return $user;
    }

    public function pushUser($user){
        $users = $this->getUsers();
        $users[] = $user;
        $this->write();
    }

    public function deleteUser($id){
        $users = $this->getUsers();
        $pos = NULL;
        for($i=0;$i<count($users);$i++){
            if($users[$i]["id"]==$id) $pos = $i;
            continue;
        }
        return $pos;
    }

    private function getUsers(){
        return json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/users.json"), JSON_OBJECT_AS_ARRAY);
    }

    private function write($arUsers){
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/users.json", json_encode($arUsers, JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE));
    }
}
?>