<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    public function getFileList()
    {
        dd('i am here');


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

        $response = json_decode(curl_exec($curl),true);
        curl_close($curl);

        //return view('returns');

      return $response['data'];



//        $headers =  array(
//            "Authorization: Bearer $access_token",
//            "Content-Type: text/plain"
//        );
//
//        $client = new Client(['headers' => $headers]);
//
//        $response = $client->request('GET', 'https://orassvas.bog.gov.gh:7002/v1/returns',[
//            'query' => ['access_token' => $access_token]
//        ]);
//
//       return $response_body = json_decode((string) $response->getBody());



    }


    public function submitFile(Request $request)
    {
       $request->validate([
            'file' => 'required|file',
            'file_type_id' => 'required',
            'revisions_id' => 'required',
            'main_id' => 'required'
        ]);

        $access_token = session('access_token');

        $filename = $request->file('file')->getClientOriginalName();

        $path = storage_path('app/public/files/');

        $request->file('file')->move($path, $filename);

        $full_path = $path.$filename;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://orassvas.bog.gov.gh:7002/v1/returns/$request->revisions_id/submit/$request->file_type_id/upload/true",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('file-data'=> new \CURLFILE($full_path)),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $access_token"
            ),
        ));

        $response = json_decode(curl_exec($curl), true);

        curl_close($curl);

        Storage::disk('local')->delete($full_path);

        if(is_array($response))
        {
            if(array_key_exists('Message', $response) && $response['Message'] == 'Authorization has been denied for this request. ')
            {
                return redirect()->route('login')->with('error', $response['Message']);

            }else {

                return back()->with('error', 'Failed to upload file');
            }
        }else{

            return back()->with('success', 'File uploaded successfully');
        }

    }
}
