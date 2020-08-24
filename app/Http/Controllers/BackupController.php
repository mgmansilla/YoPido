<?php
namespace App\Http\Controllers;

use Alert;
use Artisan;
use Carbon\Carbon;
use Exception;
use Illuminate\Routing\Controller;
use Log;
use Spatie\Backup\Helpers\Format;
use Request;
use Response;


use Storage;

class BackupController extends Controller
{
    

    public function index()
    {
        // $disk = Storage::disk(config('storage.backups.http---localhost')[0]);
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        // $disk = Storage::disk(config('backups.http---localhost')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => Format::humanReadableSize($disk->size($f)),
                    'last_modified' => Carbon::createFromTimestamp($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);


        // foreach (\File::allFiles(storage_path('backups')) as $backups)
        //     {
        //         var_dump($backups);      
        //     }



        return view("yopido.backup.index")->with(compact('backups'));

        
    }
    public function create()
        {
            
            // Artisan::call('backup:run', ['--only-db' => 'true']);
            // $output = Artisan::output();
            // dd($output);
            try {
                    // start the backup process
                    Artisan::call('backup:run', ['--only-db' => 'true']);
                    $output = Artisan::output();
                     // log the results
                     $notification= 'Backup realizado con exito dirigete a';
        
                    ini_set('max_execution_time', 600);
        
                
                    // return redirect()->back()->with('notification');
                    return back()->with(compact('notification'));
                } catch (Exception $e) {
                    // Flash::error($e->getMessage());
                    Log::error($e);
                    return Response::make($e->getMessage(), 500);
                    return redirect()->back();
                }
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
