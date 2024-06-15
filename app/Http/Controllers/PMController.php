<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Response;

class PMController extends Controller
{
    public function officer($id){
        $wom = $this->WoM(date('Ymd'));
        $dataOfficer = DB::table('users')
        ->where('id',$id)
        ->first();

        $dataWeekly = DB::table('tb_weekly_progress')
        ->where('id_user', $id)
        ->orderBy('id', 'asc')
        ->get()->keyBy('weekNum');

        $weekPlan = DB::table('tb_weekly_progress')
            ->where('id_user', $id)
            ->where('weekNum', date('W'))
            ->first();

        $weekPlanNext = DB::table('tb_weekly_progress')
            ->where('id_user', $id)
            ->where('weekNum', date('W')+1)
            ->first();

        $dataDaily = [];
        foreach ($dataWeekly as $dW){
            $dataDaily[$dW->id] = DB::table('tb_daily_progress')
                    ->where('id_user', $id)
                    ->where('id_task', $dW->id)
                    ->orderBy('date', 'asc')
                    ->get();
        }
        return view('pages.user.pm.officer', compact('wom','dataOfficer','dataWeekly','dataDaily', 'weekPlan','weekPlanNext'));
    }

    public function rekapAll($id){
        $dataOfficer = DB::table('users')
            ->where('id', $id)
            ->first();

        $dataWeekly = DB::table('tb_weekly_progress')
            ->where('id_user', $id)
            ->orderBy('id', 'asc')
            ->get()->keyBy('weekNum');

        $dataDaily = [];
        foreach ($dataWeekly as $dW) {
            $dataDaily[$dW->id] = DB::table('tb_daily_progress')
                ->where('id_user', $id)
                ->where('id_task', $dW->id)
                ->orderBy('date', 'asc')
                ->get();
        }

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('B1', "Rekap Laporan Pegawai");
        $activeWorksheet->mergeCells('B1:H1');
        
        $activeWorksheet->setCellValue('B2', "Nama");
        $activeWorksheet->mergeCells('B2:D2');
        $activeWorksheet->setCellValue('E2', $dataOfficer->firstname);
        $activeWorksheet->mergeCells('E2:H2');
        $activeWorksheet->setCellValue('B3', "NIP");
        $activeWorksheet->mergeCells('B3:D3');
        $activeWorksheet->setCellValue('E3', $dataOfficer->user_role_id == 1 ? 'Non Organik' : "PM");
        $activeWorksheet->mergeCells('E3:H3');
        
        $activeWorksheet->setCellValue('B5', "Tahun");
        $activeWorksheet->setCellValue('C5', "Bulan");
        $activeWorksheet->setCellValue('D5', "Minggu Ke-");
        $activeWorksheet->setCellValue('E5', "Rencana Mingguan");
        $activeWorksheet->setCellValue('F5', "Tanggal");
        $activeWorksheet->setCellValue('G5', "Rencana");
        $activeWorksheet->setCellValue('H5', "Realisasi");
        
        $activeWorksheet->getStyle('A1:H99')
            ->getAlignment()->setWrapText(true);
        $activeWorksheet->getStyle('A1:H99')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        // $activeWorksheet->getStyle('A1:H99')
        //     ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        
        $posRow = 6;

        foreach ($dataWeekly as $k => $weekly){
            foreach ($dataDaily[$weekly->id] as $daily){
                $activeWorksheet->setCellValue('B'.$posRow, $weekly->year);
                $activeWorksheet->setCellValue('C'.$posRow, date('m', strtotime($daily->date)));
                $activeWorksheet->setCellValue('D'.$posRow, $weekly->weekNum);
                $activeWorksheet->setCellValue('E'.$posRow, strip_tags(@json_decode($weekly->json_data, true)['rencana']));
                $activeWorksheet->setCellValue('F'.$posRow, date('d F', strtotime($daily->date)));
                $activeWorksheet->setCellValue('G'.$posRow, strip_tags(@json_decode($daily->progress, true)['rencana']));
                $activeWorksheet->setCellValue('H'.$posRow, strip_tags(@json_decode($daily->progress, true)['realisasi']));
                $posRow += 1;
            }
        }

        $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('D')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('E')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('F')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('G')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('H')->setAutoSize(true);
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap Laporan '.$dataOfficer->firstname.'.xlsx';
        $writer->save($filename);
        return Response::download($filename)->deleteFileAfterSend(true);
    }

    public function rekap($id, $bulan, $tahun)
    {
        $dataOfficer = DB::table('users')
            ->where('id', $id)
            ->first();

        $dataWeekly = DB::table('tb_weekly_progress')
            ->where('id_user', $id)
            ->orderBy('id', 'asc')
            ->get()->keyBy('weekNum');

        $dataDaily = [];
        foreach ($dataWeekly as $dW) {
            $dataDaily[$dW->id] = DB::table('tb_daily_progress')
                ->where('id_user', $id)
                ->where('id_task', $dW->id)
                ->orderBy('date', 'asc')
                ->get();
        }

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('B1', "Rekap Laporan Pegawai");
        $activeWorksheet->mergeCells('B1:H1');

        $activeWorksheet->setCellValue('B2', "Nama");
        $activeWorksheet->mergeCells('B2:D2');
        $activeWorksheet->setCellValue('E2', $dataOfficer->firstname);
        $activeWorksheet->mergeCells('E2:H2');
        $activeWorksheet->setCellValue('B3', "NIP");
        $activeWorksheet->mergeCells('B3:D3');
        $activeWorksheet->setCellValue('E3', $dataOfficer->user_role_id == 1 ? 'Non Organik' : "PM");
        $activeWorksheet->mergeCells('E3:H3');

        $activeWorksheet->setCellValue('B5', "Tahun");
        $activeWorksheet->setCellValue('C5', "Bulan");
        $activeWorksheet->setCellValue('D5', "Minggu Ke-");
        $activeWorksheet->setCellValue('E5', "Rencana Mingguan");
        $activeWorksheet->setCellValue('F5', "Tanggal");
        $activeWorksheet->setCellValue('G5', "Rencana");
        $activeWorksheet->setCellValue('H5', "Realisasi");

        $activeWorksheet->getStyle('A1:H99')
            ->getAlignment()->setWrapText(true);
        $activeWorksheet->getStyle('A1:H99')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        // $activeWorksheet->getStyle('A1:H99')
        //     ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $posRow = 6;

        foreach ($dataWeekly as $k => $weekly) {
            foreach ($dataDaily[$weekly->id] as $daily) {
                $activeWorksheet->setCellValue('B' . $posRow, $weekly->year);
                $activeWorksheet->setCellValue('C' . $posRow, date('m', strtotime($daily->date)));
                $activeWorksheet->setCellValue('D' . $posRow, $weekly->weekNum);
                $activeWorksheet->setCellValue('E' . $posRow, strip_tags(@json_decode($weekly->json_data, true)['rencana']));
                $activeWorksheet->setCellValue('F' . $posRow, date('d F', strtotime($daily->date)));
                $activeWorksheet->setCellValue('G' . $posRow, strip_tags(@json_decode($daily->progress, true)['rencana']));
                $activeWorksheet->setCellValue('H' . $posRow, strip_tags(@json_decode($daily->progress, true)['realisasi']));
                $posRow += 1;
            }
        }

        $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('D')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('E')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('F')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('G')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('H')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap Laporan ' . $dataOfficer->firstname . '.xlsx';
        $writer->save($filename);
        return Response::download($filename)->deleteFileAfterSend(true);
    }

}
