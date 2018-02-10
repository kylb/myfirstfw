<?php
namespace Core;

class Validator{
    public static function make(array $data, array $rules){
        $errors = null;

        foreach ($rules as $ruleKey => $ruleValue){
            foreach ($data as $dataKey => $dataValue){
                if($ruleKey == $dataKey){
                    switch ($ruleValue){
                        case 'required':
                            if($dataValue == ' ' || empty($dataValue)){
                                $errors["{$ruleKey}"] = "O campo {$ruleKey} deve ser PREENCHIDO.";
                            }
                            break;
                        case 'email':
                            if(!filter_var($dataValue, FILTER_VALIDATE_EMAIL)){
                                $errors["{$ruleKey}"] = "{$ruleKey} invalido.";
                            }
                            break;
                        case 'float':
                            if(!filter_var($dataValue, FILTER_VALIDATE_FLOAT)){
                                $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter numero DECIMAL.";
                            }
                            break;
                        case 'int':
                            if(!filter_var($dataValue, FILTER_VALIDATE_INT)){
                                $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter numero INTEIRO.";
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        if($errors){
            Session::set('errors',$errors);
            return true;
        } else{
            Session::destroy('errors');
            return false;
        }


    }

}