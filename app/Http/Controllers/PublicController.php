<?php

namespace App\Http\Controllers;

use App\Dao\Models\Core\User;
use App\Dao\Models\Event;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LukePOLO\LaraCart\Facades\LaraCart;
use Wink\WinkPage;
use Wink\WinkPost;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.homepage');
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function participants()
    {
        $user = User::where('is_paid', 'Yes')->get();
        return view('public.participant', ['user' => $user]);
    }

    public function events()
    {
        $events = Event::all();

        return view('public.events')->with([
            'events' => $events,
        ]);
    }

    public function eventsDetails($code)
    {
        $events = Event::findOrFail($code);

        return view('public.events')->with([
            'events' => $events,
        ]);
    }

    public function page($slug)
    {
        $page = WinkPage::where('slug', $slug)->first();

        return view('public.page')->with([
            'page' => $page,
        ]);
    }

    public function profile()
    {
        return view('public.profile')->with([
            'user' => auth()->user(),
        ]);
    }

    private function check($id){

        if($id != 6){
            return auth()->user();
        }
    }

    public function register()
    {
        $data_event = Event::all();
        $event_id = request()->get('event_id');

        $user = $this->check($event_id);
        $blood = [
            'A',
            'B',
            'AB',
            'O',
        ];

        $jersey = [
            'S',
            'M',
            'L',
            'XL',
            'XXL',
            'XXXL',
        ];

        return view('public.register')->with([
            'user' => $user,
            'blood' => $blood,
            'jersey' => $jersey,
            'id' => $event_id,
            'data_event' => $data_event
        ]);
    }

    public function add(CheckoutRequest $request)
    {
        $event = Event::findOrFail($request->id_event);

        LaraCart::add(
            $request->id_event,
            $name = $event->field_name,
            $qty = 1,
            $price = $event->field_price,
            $options = $event->toArray(),
            $taxable = false,
            $lineItem = false
        );

        return redirect()->back();
    }

    public function checkout(CheckoutRequest $request)
    {
        $event_id = $request->get('id_event');
        $event = Event::findOrFail($event_id);
        $data = $request->all();
        $id = strtoupper(uniqid());

        $data['reference_id'] = $id;
        $data['id_event'] = $event_id;
        $data['amount'] = $event->event_price;

        if($request->has('relationship'))
        {
            $user = User::create($request->all());
        }
        else
        {
            $user = User::find(auth()->user()->id);
            if(empty($user->payment_status))
            {
                $data['payment_status'] = 'PENDING';
            }

            $user->update($data);
        }

        if($user->payment_status == 'PENDING')
        {
            Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

            $apiInstance = new InvoiceApi;

            $create_invoice_request = new CreateInvoiceRequest([
                'external_id' => $id,
                'description' => $event->field_name,
                'amount' => $event->event_price,
                'invoice_duration' => 172800,
                'currency' => 'IDR',
                'reminder_time' => 1,
                'customer' => [
                    'email' => auth()->user()->email,
                    'given_name' => auth()->user()->name,
                ],
                'success_redirect_url' => config('app.url'),
                'failure_redirect_url' => config('app.url'),
            ]);

            try {
                $result = $apiInstance->createInvoice($create_invoice_request);

                return redirect()->to($result->getInvoiceUrl());
            } catch (\Xendit\XenditSdkException $e) {
                echo 'Exception when calling InvoiceApi->createInvoice: ', $e->getMessage(), PHP_EOL;
                echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
            }
        }

        return redirect()->back();

    }

    public function webhook(Request $request)
    {
        Log::info($request->all());
        $status = $request->get('status');
        $external_id = $request->get('external_id');
        $method = $request->get('payment_method');

        if($status == 'PAID')
        {
            User::where('reference_id', $external_id)->update([
                'is_paid' => 'Yes',
                'payment_status' => $status,
                'payment_method' => $method
            ]);
        }

        return response()->json($request->all());
    }
}
