<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Producto extends Model
{
    use HasFactory;

    public static function generarQuery($incluir_q_arr, $excluir_q_arr, $filters_by, $query_by) {

        $arrResult = [];

        $incluirQ = '';
        $excluirQ = '';

        foreach ($incluir_q_arr as $termino) {
            $incluirQ .= !empty($incluirQ) ? " " : "";

            if (str_starts_with($termino, '"')) {
                $incluirQ .= $termino;
            } else {
                $sinonimos = Palabra::where('palabra', 'ilike', $termino)->first()?->getSinonimosYPlurales();
                
                $sinonimos = empty($sinonimos) ? Sinonimo::where('sinonimo', 'ilike', $termino)->first()?->palabra->getSinonimosYPlurales() : $sinonimos;
                
                $sinonimos = empty($sinonimos) ? [
                    $termino, 
                    Str::plural($termino)
                    ] : $sinonimos;

                $incluirQ .= implode(" ", $sinonimos);
            }
            
        }

        foreach ($excluir_q_arr as $termino) {
            $excluirQ .= !empty($excluirQ) ? " " : "";

            if (str_starts_with($termino, '"')) {
                $excluirQ .= $termino;
            } else {
                $sinonimos = Palabra::where('palabra', 'ilike', $termino)->first()?->getSinonimosYPlurales();
                
                $sinonimos = empty($sinonimos) ? Sinonimo::where('sinonimo', 'ilike', $termino)->first()?->palabra->getSinonimosYPlurales() : $sinonimos;
                
                $sinonimos = empty($sinonimos) ? [
                    $termino, 
                    Str::plural($termino)
                    ] : $sinonimos;

                $excluirQ .= !empty($sinonimos) ? "-" . implode(" -", $sinonimos) : '';
            }
            
        }

        $result_filter_by = '';

        foreach ($filters_by as $index => $filter_by) {
            $arrValues = !empty($filter_by) ? array_map('trim', explode(',', $filter_by)) : [];

            foreach ($arrValues as $value) {
                $sinonimos = Palabra::where('palabra', 'ilike', $value)->first()?->getSinonimosYPlurales();
                
                $sinonimos = empty($sinonimos) ? Sinonimo::where('sinonimo', 'ilike', $value)->first()?->palabra->getSinonimosYPlurales() : $sinonimos;
                
                $sinonimos = empty($sinonimos) ? [
                    $value, 
                    Str::plural($value)
                    ] : $sinonimos;

                    $result_filter_by .= !empty($result_filter_by) ? " && " : "";
                    $result_filter_by .= $index . ": [" . implode(",", $sinonimos) . "]";
            }
        }

        $arrResult['q']                     = trim($incluirQ . " " . $excluirQ);
        $arrResult['page']                  = "1";
        $arrResult['group_by']              = "nog";
        $arrResult['filter_by']             = trim($result_filter_by);
        $arrResult['per_page']              = "250";
        $arrResult['query_by']              = trim($query_by);
        $arrResult['drop_tokens_threshold'] = "0";
        $arrResult['num_typos']             = "0";
        $arrResult['prefix']                = "false";

        return $arrResult;
    }
}
