<?php
 namespace App\Http\Controllers;
// use App\Library\FirebaseService;
// use App\Library\ProductFGLibraries;

// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Routing\Controller;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use Exception;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;
use App\Models\Student;
use Kreait\Firebase\Exception\Auth\EmailExists as FirebaseEmailExists;
 class BaseController extends Controller
{
  
    protected $userRepository;
    protected $database;
    protected $firebase;
    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/database-project-second-firebase-adminsdk-ipm8y-920a6f1e76.json'); // đường dẫn của file json ta vừa tải phía trên
        $this->firebase           = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://database-project-second.firebaseio.com') //bạn có thẻ lấy project id ở mục project setting > general
            ->create();
        $this->database = $this->firebase->getDatabase();
        // $this->database = $database;

        $this->userRepository = $this->database->getReference('user'); //lấy model user.
    }

    public function index()
    {

        $data = $this->database->getReference('MSSV')->getSnapshot()->getValue();

        
        $snapShot = $this->database->getReference('UID')->getSnapshot();
        // dd($snapShot->hasChildren());
        // dd($snapShot->getValue());

        $this->userRepository = $this->database->getReference('user'); //lấy model user.

        return view('home.home1');
    }
    public function getData()
    {
        $link = "UID";
        $data = $this->database->getReference($link)->getSnapshot()->getValue();

        return response(['data' => $data]);
    }

    public function getInfo(Request $request)
    {
        // dd($request);
        $arrInfo = [] ; 
        foreach($request->arrUID as $value)
        {
            // dd($value);
            $std = Student::where('UID',$value)->first();
            array_push($arrInfo,$std);
        }
        // dd($arrInfo);
        return response(['data' => $arrInfo]);
    }

    public function getInfoStudent(Request $request)
    {
        $data = Student::where('mssv',$request->mssv)->first();
        
        return response(['data' => $data]);

    }
}