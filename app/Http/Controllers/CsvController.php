<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserData;

class CsvController extends Controller
{
    public function import(Request $request)
    {

        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));
        foreach ($csvData as $row) {
            UserData::create([

                'name' => $row[0],
                'email' => $row[1],
                'city' => $row[2],
                'address' => $row[3],
                'salary' => $row[4],

            ]);
        }

        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }

    public function export()
    {
        $fileName = 'data.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
        $data = UserData::all();

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['name', 'email', 'city', 'address', 'salary']);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->name,
                    $row->email,
                    $row->city,
                    $row->address,
                    $row->salary,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
