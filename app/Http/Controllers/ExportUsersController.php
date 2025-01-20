<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportUsersController extends Controller
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
                'startColor' => ['rgb' => '2196F3'], 
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
                'startColor' => ['rgb' => '4CAF50'], 
            ],
        ];

        // Estilo para bordes
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

       
        $sheet->setCellValue('A1', 'USUARIOS'); 
        $sheet->mergeCells('A1:E1'); 
        $sheet->getStyle('A1:E1')->applyFromArray($titleStyle);
        $sheet->getRowDimension(1)->setRowHeight(40); 

        
        $headers = ['ID', 'Nombre', 'Correo Electrónico', 'Rol', 'Fecha de Creación'];
        $columnIndex = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '2', $header); 
            $sheet->getStyle($columnIndex . '2')->applyFromArray($headerStyle);
            $sheet->getColumnDimension($columnIndex)->setAutoSize(true); 
            $columnIndex++;
        }

        
        $sheet->getRowDimension(2)->setRowHeight(30);

       
        $usuarios = User::all();

        $row = 3;

        foreach ($usuarios as $usuario) {
            $sheet->setCellValue('A' . $row, $usuario->id);
            $sheet->setCellValue('B' . $row, $usuario->name);
            $sheet->setCellValue('C' . $row, $usuario->email);
            $sheet->setCellValue('D' . $row, $usuario->is_admin ? 'Admin' : 'Usuario'); 
            $sheet->setCellValue('E' . $row, $usuario->created_at->format('Y-m-d H:i:s'));

            // Aplicar bordes y ajustar altura de la fila
            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray($borderStyle);
            $sheet->getRowDimension($row)->setRowHeight(25);
            $row++;
        }

        // Ajustar alineación para todas las celdas de datos
        $sheet->getStyle('A3:E' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Exportar el archivo
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Usuarios_' . date('Y-m-d_His') . '.xlsx';

        // Enviar como descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $writer->save('php://output');
        exit;
    }
}
