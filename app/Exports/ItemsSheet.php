<?php
namespace App\Exports;

use App\Models\Barangs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Barangs::all()->map(function($item, $index) {
            return [
                'no' => $index + 1,
                'nama_barang' => $item->nama_barang,
                'kategori' => $item->kategori,
                'manufacturer' => $item->manufacturer ?? '-',
                'model' => $item->model ?? '-',
                'serial_number' => $item->serial_number ?? '-',
                'asset_tag' => $item->asset_tag ?? '-',
                'stok' => $item->stok,
                'qr_code' => $item->qr_code,
                'created_at' => $item->created_at->format('d/m/Y H:i'),
                'updated_at' => $item->updated_at->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Item Name',
            'Category',
            'Manufacturer',
            'Model',
            'Asset Tag',
            'Serial Number',
            'Stock',
            'QR Code',
            'Created At',
            'Updated At',
        ];
    }

    public function title(): string
    {
        return 'Items Data';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 20,
            'D' => 20,
            'E' => 30,
            'F' => 25,
            'G' => 25,
            'H' => 5,
            'I' => 25,
            'J' => 20,
            'K' => 20,
        ];
    }
}