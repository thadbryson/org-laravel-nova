<?php

namespace Spatie\BackupTool\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\Helpers\Format;
use Illuminate\Support\Facades\Cache;
use Spatie\BackupTool\Rules\PathToZip;
use Spatie\BackupTool\Rules\BackupDisk;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\BackupTool\Jobs\CreateBackupJob;
use Spatie\Backup\BackupDestination\BackupDestination;

class BackupsController extends ApiController
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'disk' => ['required', new BackupDisk()],
        ]);

        $backupDestination = BackupDestination::create($validated['disk'], config('backup.backup.name'));

        return Cache::remember("backups-{$validated['disk']}", now()->addSeconds(4), function () use ($backupDestination) {
            return $backupDestination
                ->backups()
                ->map(function (Backup $backup) {
                    return [
                        'path' => $backup->path(),
                        'date' => $backup->date()->format('Y-m-d H:i:s'),
                        'size' => Format::humanReadableSize($backup->size()),
                    ];
                })
                ->toArray();
        });
    }

    public function create()
    {
        dispatch(new CreateBackupJob());
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'disk' => new BackupDisk(),
            'path' => ['required', new PathToZip()],
        ]);

        $backupDestination = BackupDestination::create($validated['disk'], config('backup.backup.name'));

        $backupDestination
            ->backups()
            ->first(function (Backup $backup) use ($validated) {
                return $backup->path() === $validated['path'];
            })
            ->delete();

        $this->respondSuccess();
    }
}
