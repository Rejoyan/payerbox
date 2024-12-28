<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PaymentBoxSender;
use App\Models\PaymentBoxReceiver;
use App\Traits;

class HomeController extends Controller {

    use Traits\WorldwidesvcApi,
        Traits\CybussolutionsApi,
        Traits\ZeePayApi,
        Traits\FastpayGME;

    public function testApi() {

//        $this->zeePayCreateTrx();
    }

    public function payboxpushToPayout(Request $request) {


        if ($request->payout_api == 2) {
            list($success, $message) = $this->fastpayGMECreateTrx($request);
        }

        if ($request->payout_api == 1) {
            list($success, $message) = $this->zeePayCreateTrx($request);
        }

        if ($success == 0) {
            return redirect()->back()->with('error', $message);
        }
        if ($success == 1) {
            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->with('error', 'Please select payout api with country');
    }

    public function import(Request $request) {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        Excel::import(new UsersImport, $request->file('file')->store('files'));
        return redirect()->route('dashboard')->with('success', 'All good!');
    }

    public function paybox() {

        $paybox = PaymentBoxSender::where('api_status', 0)->paginate(50);
        return view('paybox', ['paybox' => $paybox]);
    }

    public function payboxSearch(Request $request) {

        $paybox = PaymentBoxSender::where('api_status', 0)->where('beneficiary_country', 'like', '%' . $request->beneficiary_country . '%');
        if ($request->beneficiary_country) {
            $paybox->where('beneficiary_country', 'like', '%' . $request->beneficiary_country . '%');
        }
        if ($request->payment_type) {
            $paybox->where('payment_method', $request->payment_type);
        }
        if ($request->pin_no) {
            $paybox->where('pin_no', $request->pin_no);
        }

//             if($request->start_date){
////                 dd(date('d/m/Y' ,strtotime($request->start_date)));
//                 $paybox->where('trx_date','>=' ,date('d/m/Y' ,strtotime($request->start_date)));
//             }
//             if($request->end_date){
//                 $paybox->where('trx_date','<=',date('d/m/Y' ,strtotime($request->end_date)));
//             }
        $paybox = $paybox->paginate(50);
        $paybox->appends(['beneficiary_country' => $request->beneficiary_country, 'payment_type' => $request->payment_type]);

        return view('paybox-search', ['paybox' => $paybox]);
    }

    public function payboxPush(Request $request) {



//        dd($request->all());
        list($sucess, $data) = $this->ConfirmTransactions();
        if ($sucess == false) {
            return redirect()->back()->with('error', $data);
        }
        $s = PaymentBoxSender::where('beneficiary_country', 'like', '%' . $request->beneficiary_country . '%')
                ->where('payment_method', 'like', '%' . $request->payment_type . '%');
        $s->update(['api_status' => 1]);
        $url = route('bank-count', ['beneficiary_country' => $request->beneficiary_country]);
        $title = 'View Bank';
        $message = 'TRX. successfully push to Virtual Banks';
        return view('success', ['url' => $url, 'title' => $title, 'message' => $message]);
        $data = $s->pluck('id', 'id')->toArray();
        $bankCounts = \DB::table('payment_box_senders')
                ->selectRaw('count(id) as id, agent_name_pay')
                ->whereIn('id', $data)
                ->groupBy('agent_name_pay')
                ->get();

        return view('bank-count', ['bankCounts' => $bankCounts]);
    }

    public function bankCount(Request $request) {

        $s = PaymentBoxSender::where('beneficiary_country', 'like', '%' . $request->beneficiary_country . '%');


        $data = $s->pluck('id', 'id')->toArray();
        $bankCounts = \DB::table('payment_box_senders')
                ->selectRaw('count(id) as id, agent_name_pay')
                ->whereIn('id', $data)
                ->groupBy('agent_name_pay')
                ->get();

        return view('bank-count', ['bankCounts' => $bankCounts]);
    }

    public function bankCountView(Request $request) {
        $bankCounts = PaymentBoxSender::where('agent_name_pay', 'like', '%' . $request->agent_name_pay . '%');
        $get = $bankCounts->take(10);
        $get->update(['api_status' => 0]);
        if ($request->status == '0' || $request->status == '1') {
            // dd($request->status);
            $bankCounts->where('api_status', $request->status);
        }
        if ($request->pin_no) {
            $bankCounts->where('pin_no', $request->pin_no);
        }
        if ($request->start_date) {
//                 dd(date('d/m/Y' ,strtotime($request->start_date)));
            $bankCounts->where('trx_date', '>=', date('d/m/Y', strtotime($request->start_date)));
        }
        if ($request->end_date) {
            $bankCounts->where('trx_date', '<=', date('d/m/Y', strtotime($request->end_date)));
        }
        return view('bank-count-view', ['paybox' => $bankCounts->inRandomOrder('id')->paginate(50)]);
    }

    public function trxRandView() {
        $paybox = $this->GetTransactions();
//         PaymentBoxSender::query()->update(['api_status'=>0]);
//        $paybox=  PaymentBoxSender::
//                inRandomOrder('id')
//        ->paginate(rand(10, 100));

        return view('paybox-search-api', ['paybox' => $paybox, 'payoutApis' => config('common.payout_apis')]);
    }

    public function trxRandViewSingle($ref) {
        $paybox = $this->GetSinglTransaction($ref);

        return view('paybox-search-api-single', ['paybox' => $paybox]);
    }

    public function trxStatusView(Request $request) {
        $url = $request->fullUrlWithQuery($request->all());
        $bankCounts = PaymentBoxSender::where('api_status', $request->status);
        if ($request->beneficiary_country) {
            $bankCounts->where('beneficiary_country', 'like', '%' . $request->beneficiary_country . '%');
        }
        if ($request->pin_no) {
            $bankCounts->where('pin_no', $request->pin_no);
        }
        if ($request->start_date) {
//                 dd(date('d/m/Y' ,strtotime($request->start_date)));
            $bankCounts->where('trx_date', '>=', date('d/m/Y', strtotime($request->start_date)));
        }
        if ($request->end_date) {
            $bankCounts->where('trx_date', '<=', date('d/m/Y', strtotime($request->end_date)));
        }


        return view('trx-status-view', ['paybox' => $bankCounts->inRandomOrder('id')->paginate(50), 'url' => $url]);
    }

    public function success(Request $request) {

        $url = route('dashboard');
        $title = 'Back Dashbaord';
        $message = 'TRX. successfully push to Customers ';
        return view('success', ['url' => $url, 'title' => $title, 'message' => $message]);
    }

}
