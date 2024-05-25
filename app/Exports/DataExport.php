<?php

namespace App\Exports;

use App\Models\LogPerbaikan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class DataExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithColumnWidths, WithEvents
{
    protected $log;
    protected $rowNumber = 1; // For keeping track of row numbers for images

    public function __construct($log)
    {
        $this->log = $log;
    }

    public function collection()
    {
        return $this->log;
    }

    public function headings(): array
    {
        return [
            'No',
            'Teknisi',
            'Server',
            'Klien',
            'Device',
            'Tanggal',
            'Judul',
            'Keterangan',
            'Foto',
            'Status Admin'
        ];
    }

    public function map($logperbaikan): array
    {
        return [
            $this->rowNumber++,  // Untuk menghasilkan nomor urut
            $logperbaikan->teknisi,
            $logperbaikan->serverlog->nama_server,
            $logperbaikan->userlog->name,
            $logperbaikan->devicelog->nama_perangkat,
            $logperbaikan->tanggal,
            $logperbaikan->judul,
            $logperbaikan->keterangan,
            $logperbaikan->foto ? ' ' : 'Tidak Ada Foto',
            $logperbaikan->statusadmin
        ];
    }

    public function drawings()
    {
        $drawings = [];
        foreach ($this->log as $index => $logperbaikan) {
            if ($logperbaikan->foto) {
                $drawing = new Drawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto');
                $drawing->setPath(public_path('storage/' . $logperbaikan->foto)); // Menggunakan jalur storage
                $drawing->setWidth(300);  // Set the width of the image
                $drawing->setHeight(200); // Set the height of the image
                $drawing->setCoordinates('I' . ($index + 2)); // Starting from the second row
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }

    public function columnWidths(): array
    {
        return [
            'I' => 50, // Set the width of column I to fit the image
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                foreach ($this->log as $index => $logperbaikan) {
                    $row = $index + 2; // Row number starting from the second row
                    if ($logperbaikan->foto) {
                        $sheet->getRowDimension($row)->setRowHeight(150); // Adjust the row height
                    }
                }
            },
        ];
    }
}
