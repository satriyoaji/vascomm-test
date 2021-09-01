<?php

namespace App\Console\Commands;

use App\Jurnal;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateMasterJurnals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:jurnals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Master Jurnals';

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
        $prefix = DB::table('applications')->first()->prefix;
        $client = new Client(['base_uri' => "http://api.crossref.org/"]);
        $response = $client->request('GET', "/prefixes/10.18196/works?facet=container-title:*&rows=0");
//        if ($response->failed()){ //$response->getStatusCode()
//            return "Failed to retrieve Jurnal's data with this prefix!";
//        }

        $result = json_decode($response->getBody()->getContents());
        $getTitle = 'container-title';
        $data = $result->message->facets->$getTitle->values;

        DB::beginTransaction();
        if($data == null){
            $message = 'API with the prefix doesn\'t found!';
        } else {
            if(gettype($data) == "object"){
                $keys = array_keys(get_object_vars($data));
                $obj_data = get_object_vars($data);
                $new_data = [];

                for($i = 0; $i < count($keys); $i++){
                    $new_data[$i]["id"] = "-";
                    $new_data[$i]["jumlah_artikel"] = $obj_data[$keys[$i]];
                    $new_data[$i]["judul_jurnal"] = $keys[$i];
                    $new_data[$i]["issn"] = "-";

                    $uoc = Jurnal::updateOrCreate([
                        'judul_jurnal' => $new_data[$i]["judul_jurnal"],
                    ], [
                            'issn' => $new_data[$i]["issn"],
                            'jumlah_artikel' => $new_data[$i]["jumlah_artikel"]
                        ]
                    );
                }
            }else{
                //$keys = array_keys($data);
                $new_data = [];

                for($i = 0; $i < count($data); $i++){
                    $new_data[$i]["id"] = $data[$i]->id;
                    $new_data[$i]["jumlah_artikel"] = $data[$i]->jumlah_artikel;
                    $new_data[$i]["judul_jurnal"] = $data[$i]->judul_jurnal;
                    $new_data[$i]["issn"] = $data[$i]->issn;

                    $uoc = Jurnal::updateOrCreate([
                        'judul_jurnal' => $new_data[$i]["judul_jurnal"],
                    ], [
                            'issn' => $new_data[$i]["issn"],
                            'jumlah_artikel' => $new_data[$i]["jumlah_artikel"]
                        ]
                    );
                }
            }
            $message = 'Update or Create successfully';
        }

        DB::commit();

        $this->info($message);
    }
}
