<?php

namespace App\Providers;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\ServiceProvider;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FirestoreClient::class, function ($app) {
            return new FirestoreClient([
                'keyFilePath' => storage_path('app/firebase-credentials.json'),
                'projectId' => env('FIREBASE_PROJECT_ID'),
            ]);
        });
    }
}