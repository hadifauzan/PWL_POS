public function export_pdf()
{
    $level = levelmodel :: select('level_kode', 'level_nama')
            ->get ();

// use Barryvdh\DomPDF\Facade\Pdf;
$pdf = Pdf :: loadView('level.export_pdf', ['level' => $level]);
$pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
$pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
$pdf->render();

return $pdf->stream('Data level '.date('Y-m-d H:i:s').'.pdf' );
}
