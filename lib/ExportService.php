<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
require_once __DIR__ . '/../vendor/autoload.php';

class ExportService
{

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportExcel($postResult)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('excelsheet');
        $spreadsheet->setActiveSheetIndex(0);

        $spreadsheet->getActiveSheet()->SetCellValue('A1', 'ID');
        $spreadsheet->getActiveSheet()->SetCellValue('B1', 'NAME');
        $spreadsheet->getActiveSheet()->SetCellValue('C1', 'KUNDENNUMMER');
        $spreadsheet->getActiveSheet()->SetCellValue('D1', 'URLCC');
        $spreadsheet->getActiveSheet()->SetCellValue('E1', 'RUFNUMMER');
        $spreadsheet->getActiveSheet()->SetCellValue('F1', 'URLSC');
        $spreadsheet->getActiveSheet()->SetCellValue('G1', 'RUFNUMMER');
        $spreadsheet->getActiveSheet()->SetCellValue('H1','AUFTRAGSART');
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(50, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(200, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(90, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(300, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(120, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(320, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(120, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(120, 'pt');
        $spreadsheet->getActiveSheet()
            ->getStyle('A1:H1')
            ->getFont()
            ->setBold(true)
        ->getColor()->getRGB();
        $rowCount = 2;
        if (!empty($postResult)) {
            foreach ($postResult as $element) {
                $spreadsheet->getActiveSheet()->setCellValue('A' . $rowCount, $element['id']);
                $spreadsheet->getActiveSheet()->setCellValue('B' . $rowCount, $element['name']);
                $spreadsheet->getActiveSheet()->setCellValue('C' . $rowCount, $element['kundennummer']);
                $spreadsheet->getActiveSheet()->setCellValue('D' . $rowCount, $element['urlSc']);
                $spreadsheet->getActiveSheet()->setCellValue('E' . $rowCount, $element['rufnummerSc']);
                $spreadsheet->getActiveSheet()->setCellValue('F' . $rowCount, $element['urlCc']);
                $spreadsheet->getActiveSheet()->setCellValue('G' . $rowCount, $element['rufnummerCc']);
                $spreadsheet->getActiveSheet()->setCellValue('H' . $rowCount, $element['auftraggsart']);
                $rowCount++;
            }
            $spreadsheet->getActiveSheet()
                ->getStyle('A:H')
                ->getFont();
                //->getAlignment();
                //->setWrapText(true);

            $spreadsheet->getActiveSheet()
                ->getRowDimension($rowCount);
                //->setRowHeight(4);
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        header("Content-type: application/vnd-ms-excel");
        $fileName = 'exported_excel_' . time() . '.xls';
        $headerContent = 'Content-Disposition: attachment; filename="' . $fileName . '"';
        header("Content-Disposition: attachment; filename=exported_excel.xls");
        $writer->save('php://output');
    }
}

