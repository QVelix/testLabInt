<?php
namespace Models;

class User{
    public function getUser($id){
        $users = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."users.json"), JSON_OBJECT_AS_ARRAY);
        $user = NULL;
        foreach($users as $u){
            if($u["id"] == $id) $user = $u;
            continue;
        }
        return $user;
    }
}
?>