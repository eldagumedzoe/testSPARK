<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Converter;
use Illuminate\Support\Facades\Auth;
use \Exception;
use Carbon\Carbon;
use Validator;

class ConverterController extends Controller
{   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $converter = Converter::where('isreset' ,'= ','0')->get();
        return view('converter.index',['converter'=>$converter]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'height'    => 'required|string|max:255',
            'weight'      => 'required|string|max:255'
        ]);
        //Create converter
        $converter = new Converter();
        $converter->height = $request->height;
        $converter->weight = $request->weight;
        $converter->total_bmi = $converter->weight /  ($converter->height * $converter->height);
        try{
            $converter->save();
        }catch(Exception $e) {
            return redirect()->back()->withInput()->with('message','a echoue. <br> message d\'erreur: '.$ex->getMessage().'');
        }
        //redirect
        //redirect
        return redirect()->route('converter.index')->with('message', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validatations(Request $request)
    {
        //Create converter
        $converter = new Converter();
        $converter->isreset = 1;
        try{
            $converter->save();
        }catch(Exception $e) {
            return redirect()->back()->withInput()->with('message','a echoue. <br> message d\'erreur: '.$ex->getMessage().'');
        }
        //redirect
        //redirect
        return redirect()->route('converter.index')->with('message', '');
    }
}
