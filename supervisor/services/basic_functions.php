<?php

class JSFunctions
{
    public static function alert(?string $message = ""): void
    {
        echo "</script>alert('" . $message . "');</script>";
    }
    public static function console(?string $message = ""): void
    {
        echo "</script>console.log('" . $message . "');</script>";
    }
}
