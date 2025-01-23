<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Google\Cloud\Firestore\FirestoreClient;

class FirebaseController extends Controller
{
    private function initializeFirestore()
    {
        $firebase = (new Factory)->withServiceAccount(env('FIREBASE_CREDENTIALS'));
        return $firebase->createFirestore()->database();
    }

    public function testFirebaseConnection()
    {
        try {
            $db = $this->initializeFirestore();
            
            // Now we can access collections
            $usersRef = $db->collection('users');
            $documents = $usersRef->documents();
            
            // Convert documents to array
            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = [
                        'id' => $document->id(),
                        'data' => $document->data()
                    ];
                }
            }

            return response()->json($data, 200);
            
        } catch (\Exception $e) {
            // If there is an error in the connection, catch the exception and return the error message
            return response()->json(['error' => 'Failed to connect to Firebase: ' . $e->getMessage()], 500);
        }
    }

    public function getAllData()
    {
        try {
            $db = $this->initializeFirestore();
            
            // Now we can access collections
            $usersRef = $db->collection('users');
            $documents = $usersRef->documents();
            
            // Convert documents to array
            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = [
                        'id' => $document->id(),
                        'data' => $document->data()
                    ];
                }
            }

            return response()->json($data, 200);
            
        } catch (\Exception $e) {
            \Log::error('Firestore Error: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Failed to fetch data from Firestore',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
