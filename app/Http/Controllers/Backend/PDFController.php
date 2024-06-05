<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MailExample;
use PDF;

use App\Models\Facture;


class PDFController extends Controller
{

    public function generatePDF()
    {
        $factures = Facture::get();

        $data = [
            'title' => ' DigiSyndic.com',
            'date' => date('m/d/Y'),
            'factures' => $factures
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    // public function index()
    // {
    //     $data["email"] = "gsyndic23@gmail.com";
    //     $data["title"] = "From Gsyndic.com";
    //     $data["body"] = "This is Demo";

    //     $pdf = PDF::loadView('emails.myTestMail', $data);
    //     $data["pdf"] = $pdf;

    //     Mail::to($data["email"])->send(new MailExample($data));

    //     dd('Mail sent successfully');
    // }



}
