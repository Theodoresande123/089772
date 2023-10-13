<?php

class JSFunctions
{
    public static function alert(?string $message = ""): void
    {
        echo "</script>alert('" . $message . "');</script>";
    }
}
