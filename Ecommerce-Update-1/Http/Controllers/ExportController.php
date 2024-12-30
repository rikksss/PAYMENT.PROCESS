<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    
    public function exportToExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    
    public function exportToPdf()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('exports.products_pdf', compact('products'));
        return $pdf->download('products.pdf');
    }
}
