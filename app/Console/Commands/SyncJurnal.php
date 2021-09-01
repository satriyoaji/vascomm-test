<?php

namespace App\Console\Commands;

use App\Jurnal;
use Illuminate\Console\Command;

class SyncJurnal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:jurnal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync jurnal from DOI RJI';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://doi.relawanjurnal.id/api/v1/json/getdatajurnal',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'doi_api_key=5600bedf81f999df72a1db9346d0fc34683406e8',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $decResponse = json_decode($response, true);
        $journals = $decResponse['result']['data'];


        foreach ($journals as $journal) {

            if ($journal['issnrjd'] != null) {
                $journalCount = Jurnal::where('issn', $journal['issnrjd'])->count();

                if ($journalCount == 0) {
                    Jurnal::Create([
                        'prefix' => $journal['prefixDOI'],
                        'issn' => $journal['issnrjd'],
                        'title' => $journal['title'],
                        'university_name' => $journal['institution'],
                    ]);
                } else {
                    Jurnal::where('issn', $journal['issnrjd'])->update([
                        'prefix' => $journal['prefixDOI'],
                        'issn' => $journal['issnrjd'],
                        'title' => $journal['title'],
                        'university_name' => $journal['institution'],
                    ]);
                }
            }
        }
    }
}
