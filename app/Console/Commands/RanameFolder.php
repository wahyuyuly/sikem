<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RanameFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rename:mahasiswa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rename folder mahasiswa';

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
        $data = \App\Model\Mahasiswa\Mahasiswa::all();

        foreach ($data as $value) {
            //$npm = str_replace('.', '', $value->npm);
            $npm = $value->npm;
            $path = storage_path('app/attachments/mahasiswa/'.$npm.'/');
            $new = storage_path('app/attachments/mahasiswa/'.$value->id.'/');

            if(\File::isDirectory($path)) {
                // try {
                //     //$exec = rename($path, $new);
                //     if(rename($path, $new)) {
                //         echo $value->npm.' rename to '.$value->id;
                //     } else {
                //         echo 'Failed to rename '.$value->npm;
                //     }
                // } catch (\Throwable $th) {
                //     throw $th;
                // }

                try {                    
                    //$exec = system($com);
                    $com = 'mv '.'"'.$path.'"'.' '.'"'.$new.'"';
                    if(system($com)) {
                        echo("Rename ".$value->npm." to ".$value->id."\n");
                    } else {
                        echo("Failed ".$value->npm." to ".$value->id."\n");
                    }
                } catch (\Throwable $th) {
                    echo("Fail throw ".$com."\n");
                    throw $th;
                }
            }
        }
    }
}
