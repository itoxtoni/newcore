<?php

namespace App\Http\Controllers;

use App\Dao\Models\Core\User;
use App\Dao\Models\Event;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LukePOLO\LaraCart\Facades\LaraCart;
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
        $user = User::whereNull('role')->where('is_paid', 'Yes')->get();
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

    public function profile()
    {
        return view('public.profile')->with([
            'user' => auth()->user(),
        ]);
    }

    public function register()
    {
        // dump(LaraCart::getItems());
        $data_event = Event::all();

        return view('public.register')->with([
            'user' => auth()->user(),
            'id' => request()->get('event_id'),
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

        $data['payment_status'] = 'PENDING';
        $data['reference_id'] = $id;
        $data['id_event'] = $event_id;
        $data['jersey'] = $event->field_primary;
        $data['amount'] = $event->event_price;

        $user = User::find(auth()->user()->id)
        ->update($data);

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

    public function webhook(Request $request)
    {
        Log::info($request->all());
        $status = $request->get('status');
        $external_id = $request->get('external_id');
        $method = $request->get('payment_method');

        $response = User::where('reference_id', $external_id)->first();

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
