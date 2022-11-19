<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\SerialNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SerialNumberImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if ($row[0] == '' || $row[0] == 'ITEM NUMBER') {
            return null;
        }

        $item = Item::firstOrCreate([
            'item_number' => $row[0]
        ]);

        return SerialNumber::firstOrCreate(
            ['serial_number' => isset($row[1]) ? $row[1] : null],
            [
                'item_id' => isset($item['id']) ? $item['id'] : null,
                'in_date' => isset($row[2]) ? Date::excelToDateTimeObject($row[2]) : null,
                'out_date' => isset($row[3]) ? Date::excelToDateTimeObject($row[3]) : null,
                'mr_no' => isset($row[4]) ? $row[4] : null,
            ]
        );
    }


    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}