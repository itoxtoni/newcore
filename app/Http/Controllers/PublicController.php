<?php

namespace App\Http\Controllers;

use App\Dao\Enums\GenderType;
use App\Dao\Models\Benefit;
use App\Dao\Models\Core\User;
use App\Dao\Models\Discount;
use App\Dao\Models\Event;
use App\Dao\Models\Slider;
use App\Dao\Models\Sponsor;
use App\Facades\Model\PageModel;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\RelationshipRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Plugins\Helper;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

class PublicController extends Controller
{
    public function __construct()
    {
        $pages = PageModel::all();

        $events = Event::all();

        view()->share([
            'events' => $events,
            'pages' => $pages
        ]);
    }

    public function index()
    {
        $sliders = Slider::get();
        $sponsors = Sponsor::get();
        $benefits = Benefit::get();

        return view('public.homepage', [
            'sliders' => $sliders,
            'benefits' => $benefits,
            'sponsors' => $sponsors
        ]);
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
        $user = User::leftJoinRelationship('has_event')
            ->where('is_paid', 'Yes')
            ->get();

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
        $event = Event::where('event_slug', $code)->firstOrFail();

        return view('public.event-detail')->with([
            'event' => $event,
        ]);
    }

    public function page($slug)
    {
        $page = PageModel::where('page_slug', $slug)->first();

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

    private function check($id)
    {
        return auth()->user();
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

        $relationship = [
            'Suami',
            'Istri',
            'Anak',
            'Nenek',
            'Kakek',
            'Saudara',
        ];

        $gender = GenderType::getOptions([
            GenderType::Male,
            GenderType::Female
        ]);

        $family = User::with('has_relationship')
            ->where('reference_id', auth()->user()->id)
            ->get();

        return view('public.register')->with([
            'user' => $user,
            'gender' => $gender,
            'family' => $family,
            'relationship' => $relationship,
            'blood' => $blood,
            'jersey' => $jersey,
            'id' => $event_id,
            'data_event' => $data_event
        ]);
    }

    public function remove($id)
    {
        $reference = auth()->user()->id;

        $user = User::where('reference_id', $reference)
            ->where('id', $id)
            ->first();


        if(!empty($user) && $user->is_paid != 'Yes')
        {
            $user->delete();
            $this->calculateDiscount();
        }

        throw ValidationException::withMessages(['field_name' => 'This value is incorrect']);
    }

    public function add(CheckoutRequest $request)
    {
        $id = auth()->user()->id;

        $event_id = request()->get('id_event');
        $event = Event::findOrFail($event_id);

        $data = $request->all();
        $year = Carbon::parse($request->date_birth)->age;

        $data['year'] = $year;
        $data['id_event'] = $event_id;
        $data['amount'] = $event->event_price;

        $user = User::with('has_relationship')->find($id);

        if($event_id != 6 && $user->has_relationship)
        {
            $user->has_relationship()->delete();
        }

        $user->update($data);

        $this->calculateDiscount();


        // $cart = LaraCart::find(['id' => $id]);

        // if(!empty($cart))
        // {
        //     $hash = $cart->getHash();
        //     LaraCart::updateItem($hash, 'options', $data);
        //     LaraCart::updateItem($hash, 'name', $event->event_name);
        //     LaraCart::updateItem($hash, 'price', $event->event_price);
        //     LaraCart::updateItem($hash, 'qty', 1);
        //     LaraCart::updateItem($hash, 'id', $id);
        //     LaraCart::updateItem($hash, 'tax', null);
        //     LaraCart::updateItem($hash, 'taxable', false);
        // }
        // else
        // {
        //     LaraCart::add(
        //         $id,
        //         $event->field_name,
        //         1,
        //         $event->event_price,
        //         $data,
        //         false,
        //         true
        //     );
        // }

        return redirect()->back();
    }

    public function relationship(RelationshipRequest $request)
    {
        $reference = auth()->user()->id;
        $event_id = request()->get('event_id');
        $event = Event::findOrFail($event_id);

        $data = $request->all();

        $year = Carbon::parse($request->date_birth)->age;

        $data['year'] = $year;
        $data['name'] = $request->first_name1.' '.$request->last_name;
        $data['first_name'] = $request->first_name1;
        $data['relationship'] = $request->relationship1;
        $data['gender'] = $request->gender1;
        $data['date_birth'] = $request->date_birth1;

        $data['reference_id'] = $reference;
        $data['id_event'] = $event_id;
        $data['amount'] = $event->event_price;

        $user = User::create($data);


        // $cart = LaraCart::find(['id' => $user->id]);

        // if(!empty($cart))
        // {
        //     foreach(LaraCart::getItems() as $item){

        //         $hash = $item->getHash();
        //         LaraCart::updateItem($hash, 'options', $data);
        //         LaraCart::updateItem($hash, 'name', $event->event_name);
        //         LaraCart::updateItem($hash, 'price', $event->event_price);
        //         LaraCart::updateItem($hash, 'qty', 1);
        //         LaraCart::updateItem($hash, 'id', $id);
        //         LaraCart::updateItem($hash, 'tax', null);
        //         LaraCart::updateItem($hash, 'taxable', false);
        //     }
        // }
        // else
        // {
        //     LaraCart::add(
        //         $id,
        //         $event->field_name,
        //         1,
        //         $event->event_price,
        //         $data,
        //         false,
        //         true
        //     );
        // }

        return redirect()->back();
    }

    private function saveUser($data)
    {
        $event_id = request()->get('id_event');
        $event = Event::findOrFail($event_id);

        $reference = auth()->user()->id;

        $data['reference_id'] = $reference;
        $data['id_event'] = $event_id;
        $data['amount'] = $event->event_price;

        $user = User::where('reference_id', $reference)
                ->where('key', $data['key'])
                ->where('first_name', $data['first_name'])
                ->first();

        if(empty($user))
        {
            $user = User::create($data);
        }
        else
        {
            $user = User::where('reference', $reference)
                ->where('first_name', $data['first_name'])
                ->update($data);
        }

        return $user;
    }

    private function calculateDiscount()
    {
        $user = User::with(['has_event','has_relationship'])->find(auth()->user()->id);

        $code = $user->discount_code;

        $event = $user->has_event;

        $sub = $event->event_price;

        $sub = $sub + $user->has_relationship->sum('amount');

        $discount = Discount::find($code);
        $disc = 0;

        if(!empty($discount)){
            $formula = $discount->discount_formula;

            $string = str_replace('@value', $sub, $formula);
            $disc = Helper::calculate($string) ?? 0;

            $discount->discount_max = $discount->discount_max - 1;
            $discount->save();
        }

        $user->discount_value = $disc;
        $user->total = $sub - $disc;
        $user->save();
    }

    public function discount(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if(!empty($request->coupon) && !empty($user->id_event))
        {
            $user = User::with(['has_event','has_relationship'])->find(auth()->user()->id);

            $event = $user->has_event;

            if(!empty($event)){

                $coupon = $request->coupon;

                $discount = Discount::find($coupon);

                if(empty($discount))
                {
                    return throw ValidationException::withMessages(['coupon' => 'No discount available!']);
                }

                $user->discount_code = $discount->discount_code;
                $user->save();

                $this->calculateDiscount();

                return redirect()->back();
            }
        }
        else
        {
            return throw ValidationException::withMessages(['coupon' => 'No discount available!']);
        }
    }

    public function checkout(Request $request)
    {
        $user = User::with(['has_event','has_relationship'])->find(auth()->user()->id);
        $data = $request->all();

        if(empty($user->payment_status))
        {
            $data['payment_status'] = 'PENDING';
        }

        if($user->payment_status == 'PENDING')
        {
            Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

            $apiInstance = new InvoiceApi;

            $id = strtoupper(uniqid());

            $event = $user->has_event;

            $total = $user->total;

            $create_invoice_request = new CreateInvoiceRequest([
                'external_id' => $id,
                'description' => $event->field_name,
                'amount' => $total,
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
                $user->payment_url = $result->getInvoiceUrl();
                $user->payment_status = $result->getStatus();
                $user->save();

                return redirect()->to($result->getInvoiceUrl());
            } catch (\Xendit\XenditSdkException $e) {
                echo 'Exception when calling InvoiceApi->createInvoice: ', $e->getMessage(), PHP_EOL;
                echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
            }
        }

        $user->update($data);

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
