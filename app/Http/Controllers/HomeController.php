<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $access_token = session('access_token');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://orassvas.bog.gov.gh:7002/v1/returns",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS =>"access_token=$access_token",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $access_token",
                "Content-Type: text/plain"
            ),
        ));

        $response = json_decode(curl_exec($curl), true);

        curl_close($curl);


        if(array_key_exists('Message', $response))
        {
            return redirect()->route('login')->with('error', $response['Message']);

        }else{

            $response_data = $response['data'];

            $file_types = collect();

            foreach ($response_data as $data)
            {
                $main_data = [

                    'main_id' => $data['id'],
                    'revisions_id' => $data['revisions'][0]['id']
                ];

                foreach ($data['returnTypes'] as $file_type)
                {
                    $file_type = array_merge($file_type, $main_data);

                    $file_types->push($file_type);
                }

            }

            return view('home', compact('file_types'));
        }
    }
}
