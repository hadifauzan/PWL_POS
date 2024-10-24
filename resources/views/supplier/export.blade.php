public function export_pdf()
{
    $supplier = suppliermodel :: select('supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->get ();

// use Barryvdh\DomPDF\Facade\Pdf;
$pdf = Pdf :: loadView('supplier.export_pdf', ['supplier' => $supplier]);
$pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
$pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
$pdf->render();

return $pdf->stream('Data supplier '.date('Y-m-d H:i:s').'.pdf' );
}
