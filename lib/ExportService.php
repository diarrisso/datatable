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
        $spreadsheet->getActiveSheet()->SetCellValue('A1', 'id');
        $spreadsheet->getActiveSheet()->SetCellValue('B1', 'name');
        $spreadsheet->getActiveSheet()->SetCellValue('C1', 'kundennumer');
        $spreadsheet->getActiveSheet()->SetCellValue('D1', 'urtlsc');
        $spreadsheet->getActiveSheet()->SetCellValue('E1', 'rufnummersc');
        $spreadsheet->getActiveSheet()->SetCellValue('F1', 'urlsc');
        $spreadsheet->getActiveSheet()->SetCellValue('G1', 'rufnummerCc');
        $spreadsheet->getActiveSheet()->SetCellValue('H1','auftraggsart');
        $spreadsheet->getActiveSheet()
            ->getStyle('A1:H1')
            ->getFont()
            ->setBold(true);
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
                ->getAlignment()
                ->setWrapText(true);

            $spreadsheet->getActiveSheet()
                ->getRowDimension($rowCount)
                ->setRowHeight(-1);
        }
        /*$writer = IOFactory::createWriter($spreadsheet, 'Xls');
        header("Content-type: application/vnd-ms-excel");
        $fileName = 'exported_excel_' . time() . '.xls';
        $headerContent = 'Content-Disposition: attachment; filename="' . $fileName . '"';
        header("Content-Disposition: attachment; filename=exported_excel.xls");
        $writer->save('php://output');*/


            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
            $fileName = 'exported_excel_' . time() . '.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Cache-Control: max-age=0');
            $writer->save('php://output'. $fileName);
        /*redirect(HTTP_UPLOAD_PATH.$fileName); */
        $filepath = file_get_contents('php://output' . $fileName);
    }


}

