<?php


namespace App\Helpers;


class ParseMessage
{
    public function parseValidationErrorMessage($messages = null)
    {
        if ($messages) {
            foreach ($messages as $key => $error) {
                return $error[0];
            }
        }
        return $messages;
    }
}
