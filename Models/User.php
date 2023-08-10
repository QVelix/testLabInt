<?php
namespace Models;

class User{
    public function getUser($id){
        $users = $this->getUsers();
        $user = NULL;
        foreach($users as $u){
            if($u["id"] == $id) return $u;
        }
        return $user;
    }

    public function pushUser($user){
        $users = $this->getUsers();
        $users[] = $user;
        $this->write($users);
    }

    public function deleteUser($id){
        $users = $this->getUsers();
        for($i=0;$i<count($users);$i++){
            if($users[$i]["id"]==$id) unset($users[$i]);
        }
        $this->write($users);
    }

    public function changeUser($id, $user){
        $users = $this->getUsers();
        for($i=0;$i<count($users);$i++){
            if($users[$i]["id"]==$id) $users[$i] = $user;
        }
        $this->write($users);
    }

    public function auth($login, $password){
        $users = $this->getUsers();
        $user = NULL;
        foreach($users as $u){
            if($u["login"] == $login && $u["password"] == $password) return $u;
        }
        return $user;
    }

    private function getUsers(){
        return json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/users.json"), JSON_OBJECT_AS_ARRAY);
    }

    private function write($arUsers){
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/users.json", json_encode($arUsers, JSON_UNESCAPED_SLASHES |  JSON_UNESCAPED_UNICODE));
    }
}
?>