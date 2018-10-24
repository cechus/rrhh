<?php

namespace App\Helpers;

use Carbon\Carbon;

class Util
{
    public static function formatMoney($value)
    {
        if ($value) {
            $value = number_format($value, 2, '.', ',');

            return $value;
        }
    }

    public static function removeSpaces($text)
    {
        $re = '/\s+/';
        $subst = ' ';
        $result = preg_replace($re, $subst, $text);

        return $result ? trim($result) : null;
    }

    public static function fullName($object, $style = 'uppercase')
    {
        $name = null;
        switch ($style) {
            case 'uppercase':
                $name = mb_strtoupper($object->first_name ?? '').' '.mb_strtoupper($object->second_name ?? '').' '.mb_strtoupper($object->last_name ?? '').' '.mb_strtoupper($object->mothers_last_name ?? '').' '.mb_strtoupper($object->surname_husband ?? '');
                break;
            case 'lowercase':
                $name = mb_strtolower($object->first_name ?? '').' '.mb_strtolower($object->second_name ?? '').' '.mb_strtolower($object->last_name ?? '').' '.mb_strtolower($object->mothers_last_name ?? '').' '.mb_strtolower($object->surname_husband ?? '');
                break;
            case 'capitalize':
                $name = ucfirst(mb_strtolower($object->first_name ?? '')).' '.ucfirst(mb_strtolower($object->second_name ?? '')).' '.ucfirst(mb_strtolower($object->last_name ?? '')).' '.ucfirst(mb_strtolower($object->mothers_last_name ?? '')).' '.ucfirst(mb_strtolower($object->surname_husband ?? ''));
                break;
        }
        $name = self::removeSpaces($name);

        return $name;
    }

    public static function ciExt($object)
    {
        $result = $object->identity_card.' '.($object->city_identity_card->shortened ?? '');

        return self::removeSpaces($result);
    }

    public static function fillZerosLeft($value)
    {
        if ($value) {
            return str_pad($value, 8, '0', STR_PAD_LEFT);
        }

        return str_pad(0, 8, '0', STR_PAD_LEFT);
    }

    public static function getCivilStatus($est, $gender)
    {
        switch ($est) {
            case 'S':
                return $gender ? ($gender == 'M' ? 'SOLTERO' : 'SOLTERA') : 'SOLTERO(A)';
                break;
            case 'D':
                return $gender ? ($gender == 'M' ? 'DIVORCIADO' : 'DIVORCIADA') : 'DIVORCIADO(A)';
                break;
            case 'C':
                return $gender ? ($gender == 'M' ? 'CASADO' : 'CASADA') : 'CASADO(A)';
                break;
            case 'V':
                return $gender ? ($gender == 'M' ? 'VIUDO' : 'VIUDA') : 'VIUDO(A)';
                break;
            case 'S':
                return $gender ? ($gender == 'M' ? 'SOLTERO' : 'SOLTERA') : 'SOLTERO(A)';
                break;
            default:
                return '';
                break;
        }
    }

    public static function geMonth($value)
    {
        switch ($value) {
            case 'Enero':
                return Carbon::parse('1 January');
            break;
            case 'Febrero':
                return Carbon::parse('1 February');
            break;
            case 'Marzo':
                return Carbon::parse('1 March');
            break;
            case 'Abril':
                return Carbon::parse('1 April');
            break;
            case 'Mayo':
                return Carbon::parse('1 May');
            break;
            case 'Junio':
                return Carbon::parse('1 June');
            break;
            case 'Julio':
                return Carbon::parse('1 July');
            break;
            case 'Agosto':
                return Carbon::parse('1 August');
            break;
            case 'Septiembre':
                return Carbon::parse('1 September');
            break;
            case 'Octubre':
                return Carbon::parse('1 October');
            break;
            case 'Noviembre':
                return Carbon::parse('1 November');
            break;
            case 'Diciembre':
                return Carbon::parse('1 December');
            break;
        }
    }
}
