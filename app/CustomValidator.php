<?php
namespace App;
use Illuminate\Validation\Validator;
use Session;

class CustomValidator extends Validator {
    public function validateReinclusion($attribute, $value, $parameters)
    {
        if(!session($attribute)){
            session([$attribute => $value]);
            return true;
        } else {
            if($value != session($attribute)){
                session([$attribute => $value]);
                return true;
            } else {
                return false;
            }
        }
    }
}
