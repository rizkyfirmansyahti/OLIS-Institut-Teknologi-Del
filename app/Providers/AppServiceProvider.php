<?php

namespace App\Providers;

use Exception;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadGoogleStorageDriver();
        $this->getAllAnnouncements();
    }

    private function loadGoogleStorageDriver(string $driverName = 'google')
    {
        try {
            Storage::extend($driverName, function ($app, $config) {
                $options = [];

                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                if (!empty($config['sharedFolderId'] ?? null)) {
                    $options['sharedFolderId'] = $config['sharedFolderId'];
                }

                $client = new \Google\Client();
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);

                $service = new \Google\Service\Drive($client);
                $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver = new \League\Flysystem\Filesystem($adapter);

                return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
            });
        } catch (Exception $e) {
            // Handle the exception
        }
    }

    // get all announcements
    private function getAllAnnouncements()
    {
        // get all announcements
        $announcements = Announcement::where('status', 'pin')->latest()->take(5)->get();
        if ($announcements->count() < 5) {
            // add more announcements
            $announcements = $announcements->concat(Announcement::where('status', 'unpin')->latest()->take(5 - $announcements->count())->get());
        }

        View::share('announcements', $announcements);
    }
}
