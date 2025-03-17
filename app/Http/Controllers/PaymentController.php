<?php

namespace App\Http\Controllers;

use App\Models\PaymentGatway;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function getAccountInfo()
    {

        return view('dashboard.vendors.manage.payment');

    }

    public function HandleUpdateInfo(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
          'site_id' => 'required',
          'api_key' => 'required',
          'secret_key' => 'required',
        ],
        [
          'site_id.required' => 'L\'id du site est requis',
          'api_key.required' => 'La clé API est requis',
          'secret_key.required' => 'La clé secrète est requis'
        ]);

        try{

            $vendorId = auth('Vendor')->user()->id();

        $existingAccount = PaymentGatway::where('vendor_id', $vendorId)->first();

        if($existingAccount)
        {

        }else{
            PaymentGatway::create([
                'vendor_id' => $vendorId,
                'site_id' => $request->site_id,
                'api_key' => $request->api_key,
                'secret_key' => $request->secret_key,
            ]);
        }
        DB::commit();
        return redirect()->back()->with('success', 'Donnée enregistrée');

        }catch(Exception $e){
        dd($e);
        DB::rollback();
        }


    }
}
