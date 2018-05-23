<?php
class Utils
{
    public static function decode_base64($img)
    {
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        return base64_decode($img);
    }
}
