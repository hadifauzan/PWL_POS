public function export_pdf()
{
    $penjualan = PenjualanModel :: select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->get ();

// use Barryvdh\DomPDF\Facade\Pdf;
$pdf = Pdf :: loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
$pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
$pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
$pdf->render();

return $pdf->stream('Data penjualan '.date('Y-m-d H:i:s').'.pdf' );
}
