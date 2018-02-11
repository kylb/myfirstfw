<?php
namespace Core;

class Validator{

    public static function make(array $data, array $rules){
        $errors = null;

        foreach ($rules as $ruleKey => $ruleValue) {

            foreach ($data as $dataKey => $dataValue) {

                if ($dataKey == $ruleKey) {
                    $itemsValue = [];
                    if(strpos($ruleValue, "|")) {
                        $itemsValue = explode("|", $ruleValue);

                        foreach ($itemsValue as $itemValue){
                            $subItems =[];
                            if (strpos($itemValue, ":")){
                                $subItems = explode(":", $itemValue);
                                switch ($subItems[0]) {
                                    case 'min':
                                        if (strlen($dataValue) < $subItems[1]) {
                                            $errors["{$ruleKey}"] = "O campo {$ruleKey} deve ter no mínimo {$subItems[1]} caracteres.";
                                        }
                                        break;
                                    case 'max':
                                        if (strlen($dataValue) > $subItems[1]) {
                                            $errors["{$ruleKey}"] = "O campo {$ruleKey} deve ter no máximo {$subItems[1]} caracteres.";
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            } else{
                                switch ($itemValue) {
                                    case 'required':
                                        if ($dataValue == ' ' || empty($dataValue)) {
                                            $errors["{$ruleKey}"] = "O campo {$ruleKey} deve ser PREENCHIDO.";
                                        }
                                        break;
                                    case 'email':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) {
                                            $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter um E-MAIL VALIDO.";
                                        }
                                        break;
                                    case 'float':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT)) {
                                            $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter numero DECIMAL.";
                                        }
                                        break;
                                    case 'int':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_INT)) {
                                            $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter numero INTEIRO.";
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }
                    } else if (strpos($ruleValue, ":")) {
                        $items = explode(":", $ruleValue);
                        switch ($items[0]) {
                            case 'min':
                                if (strlen($dataValue) < $items[1]) {
                                    $errors["{$ruleKey}"] = "O campo {$ruleKey} deve ter no mínimo {$items[1]} caracteres.";
                                }
                                break;
                            case 'max':
                                if (strlen($dataValue) > $items[1]) {
                                    $errors["{$ruleKey}"] = "O campo {$ruleKey} deve ter no máximo {$items[1]} caracteres.";
                                }
                                break;
                            default:
                                break;
                        }
                    } else {
                        switch ($ruleValue) {
                            case 'required':
                                if ($dataValue == ' ' || empty($dataValue)) {
                                    $errors["{$ruleKey}"] = "O campo {$ruleKey} deve ser PREENCHIDO.";
                                }
                                break;
                            case 'email':
                                if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) {
                                    $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter um E-MAIL VALIDO.";
                                }
                                break;
                            case 'float':
                                if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT)) {
                                    $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter numero DECIMAL.";
                                }
                                break;
                            case 'int':
                                if (!filter_var($dataValue, FILTER_VALIDATE_INT)) {
                                    $errors["{$ruleKey}"] = "O campo {$ruleKey} deve conter numero INTEIRO.";
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }
        if($errors){
            Session::set('errors',$errors);
            Session::set('inputs',$data);
            return true;
        } else{
            Session::destroy('errors');
            Session::destroy('inputs');
            return false;
        }


    }

}