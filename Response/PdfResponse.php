<?php

namespace Mkk\MpdfBundle\Response;

use Mpdf\Mpdf;
use Symfony\Component\HttpFoundation\Response;

class PdfResponse extends Response
{
    /**
     * @param mixed  $data     The response data
     * @param int    $status   The response status code
     * @param array  $headers  An array of response headers
     * @param string $fileName
     *
     * @throws \Mpdf\MpdfException
     */
    public function __construct($data = null, $status = 200, $headers = [], $fileName = '')
    {
        if ($data instanceof Mpdf) {
            $data = $data->Output('', 'S');
        }
        $headers['content-type'] = 'application/pdf';
        if ($fileName) {
            $headers['content-disposition'] = sprintf('inline; filename="%s"', $fileName);
        }
        parent::__construct($data, $status, $headers);
    }
}
