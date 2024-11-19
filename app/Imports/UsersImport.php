<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow,WithChunkReading,WithBatchInserts,ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
         ]);
    }


    // Chunk reading https://docs.laravel-excel.com/3.1/imports/chunk-reading.html

    public function chunkSize(): int
    {
        return 300;
    }

    // Batch inserts https://docs.laravel-excel.com/3.1/imports/batch-inserts.html

    public function batchSize(): int
    {
        return 6000;
    }
}
