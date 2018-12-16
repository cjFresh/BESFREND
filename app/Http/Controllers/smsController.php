<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Person;

class smsController extends Controller
{

    public function customsms(Request $request){

        $validate = $request->validate([
            'number' => 'required',
            'message' => 'required',
        ]);


    $num = $request->number;
    $message = $request->message;
    // echo $num.$message;
    $apicode = 'TR-CLEMJ768204_AL8LY' ;
    $url = 'https://www.itexmo.com/php_api/api.php'; 
    
    $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    $err = file_get_contents($url, false, $context);
    
    if($err == 0){
        $message = "Message Sent to ".$num;                
        return redirect('/writesms/')->with('success', $message);
    }elseif($err == 4){
        $message = "Maximum Message per day reached.";
        return redirect('/writesms/')->with('error', $message);
    }elseif($err == 2){
        $message = "Invalid Contact Number. Message not sent.";
        return redirect('/writesms/')->with('error', $message);
    }else{
        $message = "Message not sent";
        return redirect('/writesms/')->with('error', $message);

    }
    }

    function itexmo(){
        $numbers = Person::select('mobile_num')->where('mobile_num','!=','NULL')->get();
        // var_dump($numbers); 
        $apicode = 'TR-CLEMJ768204_AL8LY' ;
        $url = 'https://www.itexmo.com/php_api/api.php';
        $message = "BESFREND Test Message.";
        foreach($numbers as $n){
        $num = $n->mobile_num;
        // echo $num.'</br>';
        // }
        $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        $err = file_get_contents($url, false, $context);
        }
        if($err == 0){
            $message = "Message Sent to ".$num;                
            return redirect('/writesms/')->with('success', $message);
        }elseif($err == 4){
            $message = "Maximum Message per day reached.";
            return redirect('/writesms/')->with('error', $message);
        }elseif($err == 2){
            $message = "Invalid Contact Number. Message not sent.";
            return redirect('/writesms/')->with('error', $message);
        }elseif($err == 3){
            $message = "Invalid Api Code";
            return redirect('/writesms/')->with('error', $message);
        }else{
            $message = 'Message Not Sent';
            return redirect('/writesms/')->with('error', $message);
        }    
    }

}


?>