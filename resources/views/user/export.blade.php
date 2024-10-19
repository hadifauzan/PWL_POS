public function export_pdf()
{
    $barang = usermodel :: select('level_id', 'username', 'password')
            ->get ();

// use Barryvdh\DomPDF\Facade\Pdf;
$pdf = Pdf :: loadView('barang.export_pdf', ['user' => $user]);
$pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
$pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
$pdf->render();

return $pdf->stream('Data user '.date('Y-m-d H:i:s').'.pdf' );
}
