<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Applicant;

class ImportApplicants extends Command
{
    protected $signature = 'import:applicants {file}';
    protected $description = 'Import applicants from a CSV file';

    public function handle()
    {
        $file = $this->argument('file');
        $data = array_map('str_getcsv', file($file));
        $header = array_shift($data);

        foreach ($data as $row) {
            $rowData = array_combine($header, $row);
            Applicant::create([
                'name' => $rowData['Name'],
                'email' => $rowData['Email'],
                'phone' => $rowData['Phone'],
                'company' => $rowData['Company'],
                'address1' => $rowData['Address1'],
                'county' => $rowData['County'],
                'country' => $rowData['Country'],
                'post_code' => $rowData['Post Code'],
                'require_dbs_check' => $rowData['Require DBS Check'] === 'true',
                'applied_for' => $rowData['Applied For'],
                'cv' => $rowData['CV'],
            ]);
        }

        $this->info('Applicants imported successfully.');
    }
}