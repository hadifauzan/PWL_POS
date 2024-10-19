public function export_pdf()
{
    $barang = Kategorimodel :: select('kode_kategori', 'nama_kategori')
            ->get ();

// use Barryvdh\DomPDF\Facade\Pdf;
$pdf = Pdf :: loadView('barang.export_pdf', ['kategori' => $kategori]);
$pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
$pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
$pdf->render();

return $pdf->stream('Data Kategori '.date('Y-m-d H:i:s').'.pdf' );
}
