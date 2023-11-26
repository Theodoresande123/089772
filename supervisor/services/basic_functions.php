<?php

class JSFunctions
{
    public static function alert(?string $message = ""): string | null
    {
        return "</script>alert('" . $message . "');</script>";
    }
    public static function console(?string $message = ""): string | null
    {
        return "</script>console.log('" . $message . "');</script>";
    }
}
