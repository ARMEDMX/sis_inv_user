<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportProductsController extends Controller
{
    public function export()
    {
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        
        $titleStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2196F3'], // Color azul
            ],
        ];

        
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // Color verde
            ],
        ];

        
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        
        $sheet->setCellValue('A1', 'PRODUCTOS'); 
        $sheet->mergeCells('A1:F1'); 
        $sheet->getStyle('A1:F1')->applyFromArray($titleStyle);
        $sheet->getRowDimension(1)->setRowHeight(40); 

        
        $headers = ['ID', 'Nombre', 'Descripción', 'Precio', 'Registrado por', 'Fecha de creación'];
        $columnIndex = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '2', $header); // Colocar encabezados en la fila 2
            $sheet->getStyle($columnIndex . '2')->applyFromArray($headerStyle);
            $sheet->getColumnDimension($columnIndex)->setAutoSize(true); // Ajustar ancho automático
            $columnIndex++;
        }

        
        $sheet->getRowDimension(2)->setRowHeight(30);

        
        $user = Auth::user();

        
        if ($user->is_admin) { 
            $productos = Producto::all();
        } else {
            $productos = Producto::where('user_id', $user->id)->get();
        }

        $row = 3;

        foreach ($productos as $producto) {
            $sheet->setCellValue('A' . $row, $producto->id);
            $sheet->setCellValue('B' . $row, $producto->nombre);
            $sheet->setCellValue('C' . $row, $producto->descripcion);
            $sheet->setCellValue('D' . $row, '$' . number_format($producto->precio, 2));
            $sheet->setCellValue('E' . $row, $producto->user->name); 
            $sheet->setCellValue('F' . $row, $producto->created_at->format('Y-m-d H:i:s'));

            
            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($borderStyle);
            $sheet->getRowDimension($row)->setRowHeight(25);
            $row++;
        }

        
        $sheet->getStyle('A3:F' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Productos_' . date('Y-m-d_His') . '.xlsx';

        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $writer->save('php://output');
        exit;
    }
}
