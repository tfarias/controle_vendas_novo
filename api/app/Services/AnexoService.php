<?php

namespace App\Services;

use Illuminate\Support\Str;

class AnexoService
{
    /**
     * @param $content
     * @return string
     * @throws \Mpdf\MpdfException
     * @SuppressWarnings(PHPMD)
     */
    public function anexo($content){
        $mpdf = new \Mpdf\Mpdf([
            '',
            'A4',
            '',
            '',
            15,
            15,
            30,
            15,
        ]);
        $mpdf->simpleTables = true;
        $mpdf->useSubstitutions = true;
        $mpdf->use_kwt = true;
        $mpdf->WriteHTML($content);

        return $mpdf->Output($this->gerarNomeArquivo(), \Mpdf\Output\Destination::STRING_RETURN);
    }

    /**
     * Gera o nome do arquivo a ser feito download pelo usuário.
     *
     * @return string
     */
    public function gerarNomeArquivo()
    {
        $titulo = Str::ascii("venlatorio_venda");
        $titulo = Str::slug($titulo) . '-' . date('d-m-Y');
        return "{$titulo}.pdf";
    }

}
