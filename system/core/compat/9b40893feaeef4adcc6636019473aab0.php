<?php

class AUTHORITY
{
    public static function validateTimestamp($token)
    { 
        $token = self::validateKey($token);

        if ($token != false && (now() - $token->timestamp < (KEY_TIMEOUT * 60))) {
            return $token;
        }
        return false;
    }

    public static function validateTimestamp1($token)
    {
        $res = self::validateKey($token);
        if($res["status"]==1){
            return false;
        }else{
            $payload=$res["data"];
            if ($token != false && (now() - $token->timestamp < (KEY_TIMEOUT * 60))) {
            return $token;
        }
        }
        
        return false;
    }

    public static function validateKey($token)
    {
        return JWT::decode($token, KEY_APP);
    }

    public static function generateKey($data)
    {
        return JWT::encode($data, KEY_APP);
    }

}

function now(){
        return strtotime(date('Y-m-d H:i:s'));
}