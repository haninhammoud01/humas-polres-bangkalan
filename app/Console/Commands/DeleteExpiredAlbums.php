<?php

namespace App\Console\Commands;

use App\Models\Album;
use Illuminate\Console\Command;

class DeleteExpiredAlbums extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'albums:delete-expired';

    /**
     * The console command description.
     */
    protected $description = 'Delete albums that have reached their auto-delete date (3 days old)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired albums...');

        $expiredAlbums = Album::with('photos')
                              ->shouldDelete()
                              ->get();

        if ($expiredAlbums->isEmpty()) {
            $this->info('No expired albums found.');
            return 0;
        }

        $this->info("Found {$expiredAlbums->count()} expired albums.");

        $bar = $this->output->createProgressBar($expiredAlbums->count());
        $bar->start();

        $deletedCount = 0;
        $photosDeleted = 0;

        foreach ($expiredAlbums as $album) {
            $photoCount = $album->photos->count();

            // Delete all photos files
            foreach ($album->photos as $photo) {
                $filepath = public_path('foto_galeri/' . $photo->nama_file);
                if (file_exists($filepath)) {
                    unlink($filepath);
                    $photosDeleted++;
                }
            }

            // Delete album
            $albumName = $album->nama_album;
            $album->delete();

            $this->newLine();
            $this->line("Deleted: {$albumName} ({$photoCount} photos)");

            $deletedCount++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("✓ Successfully deleted {$deletedCount} albums and {$photosDeleted} photos.");

        return 0;
    }
}
