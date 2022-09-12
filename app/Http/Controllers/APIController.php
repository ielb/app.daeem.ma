<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Store;
use App\Models\Status;
use App\Models\Variant;
use App\Models\Client;
use App\Models\City;
use App\Models\Hour;
use App\Models\User;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderHasProduct;
use App\Models\OrderHasStatus;
use App\Models\Address;
use App\Models\DeliverySetting;
use App\Models\OrderRefund;
use App\Models\StoreType;

class APIController extends Controller
{

    /** CREAT DEFAULT USER */
    protected function create_user(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => 'admin',
            'status' => 1,
            'code' => 'ADM01',
            'cash' => '0',
            'gender' => 'male',
            'image' => 'user-avatar.png',
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(60),
        ]);

        //$user->assignRole('admin');
        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $response;
        //  return redirect()->route('auth.index')->withStatus(__('User successfully created.'));

    }

    /** API FUNCTIONS  */

    public function api_get_all_stores_nearby_by_type(Request $request)
    {

        $stores = array();
        $longitude_x = $request->lng;  // x-coordinate of the point to test
        $latitude_y = $request->lat;    // y-coordinate of the point to test
        $store_type_id = $request->store_type;
        $stores_arr = Store::where('status', 1)->where('store_type_id', $store_type_id)->get();
        // y-coordinate of the point to test
        foreach ($stores_arr as $store) {

            $vertices_x = array();    // x-coordinates of the vertices of the polygon
            $vertices_y = array(); // y-coordinates of the vertices of the polygon
            $radius = json_decode($store->radius, true);

            if ($radius != NULL) {
                foreach ($radius as $rd) {
                    $vertices_y[] = $rd['lat'];
                    $vertices_x[] = $rd['lng'];
                }
                $points_polygon = count($vertices_x) - 1;  // number vertices - zero-based array
                if ($this->is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)) {
                    $stores[] = $store;
                }
            }
        }

        return json_encode($stores);
    }
    public function api_get_all_stores_nearby(Request $request)
    {


        $stores_arr = Store::where('status', 1)->get();
        $stores = array();
        $longitude_x = $request->lng;  // x-coordinate of the point to test
        $latitude_y = $request->lat;    // y-coordinate of the point to test
        foreach ($stores_arr as $store) {

            $vertices_x = array();    // x-coordinates of the vertices of the polygon
            $vertices_y = array(); // y-coordinates of the vertices of the polygon
            $radius = json_decode($store->radius, true);

            if ($radius != NULL) {
                foreach ($radius as $rd) {
                    $vertices_y[] = $rd['lat'];
                    $vertices_x[] = $rd['lng'];
                }
                $points_polygon = count($vertices_x) - 1;  // number vertices - zero-based array
                if ($this->is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)) {
                    $stores[] = $store;
                }
            }
        }

        return $stores;
    }

    public function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)
    {
        $i = $j = $c = 0;
        for ($i = 0, $j = $points_polygon; $i < $points_polygon; $j = $i++) {
            if ((($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
                ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i])))
                $c = !$c;
        }
        return $c;
    }

    public function api_get_all_stores($offset, $limit)
    {

        $stores = Store::where('status', 1)->offset($offset)->limit($limit)->get();
        if (count($stores)) {
            return ['status' => 'success', 'data' => $stores];
        } else {
            return ['status' => 'error'];
        }
    }

    public static function changeEnvironmentVariable($key, $value)
    {
        $path = base_path('.env');
        $old = env($key);
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=" . $old,
                "$key=" . $value,
                file_get_contents($path)
            ));
        }
    }

    public function api_get_store($id)
    {

        $store = Store::find($id);
        if ($store) {
            return ['status' => 'success', 'data' => $store];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_search_stores($name)
    {
        $name = trim($name);
        $stores = Store::where('name', 'LIKE', "%{$name}%")->get();
        if (count($stores)) {
            return ['status' => 'success', 'data' => $stores];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_store_hours($id)
    {

        $store = Store::find($id);
        $hours = $store->hours;
        if ($hours) {
            return ['status' => 'success', 'data' => $hours];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_set_store_rating(Request $request)
    {

        $store_id = $request->store_id;
        $client_id = $request->client_id;
        $rating_value = intval($request->rating_value);

        $rating = Rating::where('client_id', $client_id)->where('store_id', $store_id)->first();

        if ($rating) {

            $result = $rating->update([
                'rating' => $rating_value
            ]);
        } else {
            $result = Rating::create([
                'client_id' => $client_id,
                'store_id' => $store_id,
                'rating' => $rating_value
            ]);
        }

        if ($result) {
            return ['status' => 'success'];
        }

        return ['status' => 'error'];
    }

    public function api_get_store_rating($id)
    {

        $store = Store::find($id);
        $rating = $store->ratings;
        if ($rating) {
            return ['status' => 'success', 'data' => $rating];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_store_categories($id)
    {

        $store = Store::find($id);
        $categories = $store->categories;
        if (count($categories)) {
            return ['status' => 'success', 'data' => $categories];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_store_subcategories($id)
    {

        $category = Category::find($id);
        $subcategories = $category->subcategories;

        if (count($subcategories)) {
            return ['status' => 'success', 'data' => $subcategories];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_store_products($id)
    {

        $subcategory = Subcategory::find($id);

        $products = $subcategory->products;
        foreach ($products as $product) {
            $variants = Variant::where('product_id', $product->id)->get();
            $product->variants = $variants;
        }

        if (count($products)) {
            return ['status' => 'success', 'data' => $products];
        } else {
            return ['status' => 'error'];
        }
    }


    public function api_get_city($id)
    {

        $city = City::find($id);
        if ($city) {
            return ['status' => 'success', 'data' => $city];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_product($id)
    {

        $product = Product::find($id);
        $variants = Variant::where('product_id', $product->id)->get();
        if ($product) {
            return ['status' => 'success', 'data' => ['product' => $product, 'variants' => $variants]];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_login(Request $request)
    {


        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = trim($request->email);
        $password = md5(trim($request->password));

        $client = Client::whereEmail($email)->wherePassword($password)->whereStatus(1)->first();
        $address = null;
        if ($client) {
            $address = Address::whereClientId($client->id)->first();
            return ['status' => 'success', 'data' => ['client' => $client, 'address' => $address]];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_register(Request $request)
    {


        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $email = trim($request->email);
        $name = trim($request->name);
        $password = md5(trim($request->password));

        $client_name = explode('@', $email);
        $client = Client::create([
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'status' => 1,
            'remember_token' => Str::random(60)
        ]);

        if ($client) {
            //     $mailData = [
            //         'title' => ' Hi, ' . $client->name . ' ',
            //         'url' => ' ' . env("APP_URL") . '/confirmation/' . $client->remember_token . ' '
            //     ];

            //     Mail::to($email)->send(new SendMail($mailData, 'confirmation'));


            //    Mail::send([], [], function ($message) use ($email, $html) {
            //        $message->to($email)
            //            ->subject('Confirmation Mail | ' . env('APP_NAME'))
            //            ->setBody($html, 'text/html'); // for HTML rich messages
            //    });


            //     if (Mail::failures()) {
            //         return ['status' => 'warning', 'message' => 'Send Mail failed '];
            //     } else {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_client_email_confirmation($token)
    {

        $client = Client::where('remember_token', $token)->first();


        if ($client) {

            if ($client->email_verified_at == "") {
                $client->update([
                    'email_verified_at' => date('Y-m-d H:i:s')
                ]);
                return view('clients.verified');
            } else {
                abort(432);
            }
        } else {
            abort(404);
        }
    }

    public function api_login_by_google(Request $request)
    {
        $email = trim($request->email);
        $go_id = trim($request->go_id);

        $client = Client::where([['email', $email], ['go_id', $go_id], ['status', 1]])->get();
        $address = $client->address;

        if (count($client)) {
            // login
            return ['status' => 'success', 'data' => ['client' => $client, 'address' =>  $address]];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_login_by_facebook(Request $request)
    {
        $email = trim($request->email);
        $fb_id = trim($request->fb_id);

        $client = Client::where([['email', $email], ['fb_id', $fb_id], ['status', 1]])->get();

        if (count($client)) {
            // login
            return ['status' => 'success', 'data' => $client];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_login_by_social(Request $request)
    {
        $email = trim($request->email);
        $provider = trim($request->provider);
        $uid = trim($request->uid);

        if ($provider == 'google') {
            //            $client = Client::where([['email', $email], ['go_id', $uid], ['status', 1]])->get();
            $client = Client::whereEmail($email)->whereGoId($uid)->whereStatus(1)->first();
        } else {
            $client = Client::whereEmail($email)->whereFbId($uid)->whereStatus(1)->first();

            //            $client = Client::where([['email', $email], ['fb_id', $uid], ['status', 1]])->get();
        }
        $address = null;
        if ($client) {
            $address = Address::whereClientId($client->id)->first();
            return ['status' => 'success', 'data' => ['client' => $client, 'address' => $address]];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_register_by_social(Request $request)
    {

        $name = trim($request->name);
        $email = trim($request->email);
        $provider = trim($request->provider);
        $uid = trim($request->uid);

        if ($provider == 'google') {
            $client = Client::where([['email', $email], ['go_id', $uid], ['status', 1]])->get();
        } else {
            $client = Client::where([['email', $email], ['fb_id', $uid], ['status', 1]])->get();
        }

        if (count($client)) {

            // login
            return ['status' => 'success', 'data' => $client];
        } else {

            if ($provider == 'google') {
                // register and login
                $client = Client::create([
                    'name' => $name,
                    'email' => $email,
                    'go_id' => $uid,
                    'status' => 1,
                    'remember_token' => Str::random(60)
                ]);
            } else {
                // register and login
                $client = Client::create([
                    'name' => $name,
                    'email' => $email,
                    'fb_id' => $uid,
                    'status' => 1,
                    'remember_token' => Str::random(60)
                ]);
            }


            if ($client) {
                return ['status' => 'success', 'data' => $client];
            } else {
                return ['status' => 'error'];
            }
        }
    }

    public function api_register_by_google(Request $request)
    {

        $name = trim($request->name);
        $email = trim($request->email);
        $go_id = trim($request->go_id);

        $client = Client::where([['email', $email], ['go_id', $go_id], ['status', 1]])->get();

        if (count($client)) {

            // login
            return ['status' => 'success', 'data' => $client];
        } else {

            // register and login
            $client = Client::create([
                'name' => $name,
                'email' => $email,
                'go_id' => $go_id,
                'status' => 1,
                'remember_token' => Str::random(60)
            ]);

            if ($client) {
                return ['status' => 'success', 'data' => $client];
            } else {
                return ['status' => 'error'];
            }
        }
    }

    public function api_register_by_facebook(Request $request)
    {

        $name = trim($request->name);
        $email = trim($request->email);
        $fb_id = trim($request->fb_id);

        $client = Client::where([['email', $email], ['fb_id', $fb_id], ['status', 1]])->get();

        if (count($client)) {

            // login
            return ['status' => 'success', 'data' => $client];
        } else {

            // register and login
            $client = Client::create([
                'name' => $name,
                'email' => $email,
                'fb_id' => $fb_id,
                'status' => 1,
                'remember_token' => Str::random(60)
            ]);

            if ($client) {
                return ['status' => 'success', 'data' => $client];
            } else {
                return ['status' => 'error', 'data' => null];
            }
        }
    }

    public function api_reset_client_password_request(Request $request)
    {

        $email = trim($request->email);

        $client = Client::where([['email', $email], ['status', 1]])->get();

        if (count($client)) {

            // send reset password request
            $digits = 5;
            $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

            //            $html = '<html>
            //                    <head>
            //                        <meta name="viewport" content="width=device-width" />
            //                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            //                        <title>' . env('APP_NAME') . '</title>
            //                    </head>
            //                    <body class="">
            //                          reset password code is <b>' . $code . '</b>
            //                    </body>
            //                    </html>';

            $mailData = [
                'title' => ' Confirmation Code ',
                'code' => ' ' . $code . ' '
            ];

            Mail::to($email)->send(new SendMail($mailData, 'reset'));


            //            Mail::send([], [], function ($message) use ($email, $html) {
            //                $message->to($email)
            //                    ->subject('Reset Password | ' . env('APP_NAME'))
            //                    ->setBody($html, 'text/html'); // for HTML rich messages
            //            });


            if (Mail::failures()) {
                return ['status' => 'warning', 'message' => 'Send Mail failed '];
            } else {
                return ['status' => 'success', 'data' => [
                    'client' => $client,
                    'confirmation_code' => $code
                ]];
            }
        } else {
            return ['status' => 'error', 'data' => null];
        }
    }

    public function api_reset_client_password(Request $request)
    {

        $client_id = trim($request->client_id);
        $password = trim($request->password);

        $client = Client::find($client_id);

        if ($client) {

            // reset password
            $result = $client->update([
                'password' => md5($password)
            ]);
            if ($result) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error'];
            }
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_edit_client_info(Request $request)
    {


        $client_id = trim($request->client_id);
        $client = Client::find($client_id);

        if ($client) {


            if ($client->email != trim($request->email)) {
                $cl = Client::where('email', $request->email)->get();
                if (count($cl)) {
                    return ['status' => 'error', 'message' => 'The email has already been taken'];
                }
            }

            $name = trim($request->name);
            $email = trim($request->email);
            $old_email = $client->email;

            if ($old_email != $email) {

                // reset password
                $result = $client->update([
                    'name' => $name,
                    'email' => $email,
                    'email_verified_at' => null
                ]);
            } else {
                // reset password
                $result = $client->update([
                    'name' => $name,
                    'email' => $email
                ]);
            }


            if ($result) {

                if ($old_email != $email) {

                    $mailData = [
                        'title' => ' Hi, ' . $client->name . ' ',
                        'url' => ' ' . env("APP_URL") . '/confirmation/' . $client->remember_token . ' '
                    ];

                    Mail::to($email)->send(new SendMail($mailData, 'confirmation'));


                    if (Mail::failures()) {
                        return ['status' => 'warning', 'message' => 'Send Mail failed '];
                    }
                }

                return ['status' => 'success'];
            } else {
                return ['status' => 'error'];
            }
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_client_by_id($id)
    {

        $client = Client::find($id);
        if ($client) {
            return ['status' => 'success', 'data' => ['client' => $client, 'address' => $client->address]];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_search_categories($category)
    {

        $categories = Category::where('name', 'LIKE', "%{$category}%")->get();
        if (count($categories)) {
            return ['status' => 'success', 'data' => $categories];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_search_subcategories($subcategory)
    {

        $subcategories = Subcategory::where('name', 'LIKE', "%{$subcategory}%")->get();
        if (count($subcategories)) {
            return ['status' => 'success', 'data' => $subcategories];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_search_product($product)
    {

        $products = Product::where('name', 'LIKE', "%{$product}%")->get();
        if (count($products)) {
            return ['status' => 'success', 'data' => $products];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_check_coupon($value)
    {

        $today = Date('Y-m-d H:s:i');

        $coupon = Coupon::where([['code', $value], ['status', 1]])->whereDate('active_from', '<=', $today)->whereDate('active_to', '>=', $today)->first();

        if ($coupon) {

            $used_count = $coupon->used_count;
            $coupon_limit = $coupon->limit_to_num_uses;

            if (intval($coupon_limit) >= intval($used_count)) {
                $used_count = $used_count + 1;
                $coupon->update([
                    'used_count' => $used_count
                ]);
            } else {
                return ['status' => 'error', 'data' => []];
            }
            return ['status' => 'success', 'data' => $coupon];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_insert_order(Request $request)
    {
        $data = json_decode($request->data, true);

        $code = Date('His');

        $order_code = $code;
        $client_id = $data['client_id'];
        $store_id = $data['store_id'];
        $address_id = $data['address_id'];
        $order_price = $data['order_price'];
        $delivery_price = $data['delivery_price'];
        $use_coupon = $data['use_coupon'];
        $price_after_coupon = $data['price_after_coupon'];
        $discount_price = $data['discount_price'];
        $use_delivery_time = $data['use_delivery_time'];
        $delivery_time = $data['delivery_time'] == "" ? NULL : $data['delivery_time'];
        $products = $data['products'];


        $order = Order::create([
            'code' => $order_code,
            'client_id' => $client_id,
            'store_id' => $store_id,
            'address_id' => $address_id,
            'order_price' => $order_price,
            'delivery_price' => $delivery_price,
            'use_coupon' => $use_coupon,
            'price_after_coupon' => $price_after_coupon,
            'discount_price' => $discount_price,
            'use_delivery_time' => $use_delivery_time,
            'delivery_time' => $delivery_time,
            'status_id' => 1,
            'user_id' => NULL,
            'collector_id' => NULL,
            'payment_method' => 'cash',
        ]);


        //        $products = array_filter(explode(',', $products_str));
        //        $qte = array_filter(explode(',', $qte_str));
        //        $variants = array_filter(explode(',', $request->variants));


        $data = [];
        foreach ($products as $key => $product) {

            $variant_id = $product['variant'];
            if ($variant_id != '-1') {
                $price = Variant::whereId($variant_id)->first()->price;
            } else {
                $price = Product::whereId($product)->first()->price;
            }


            $data[] = [
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'qty' => $product['quantity'],
                'price' => $price,
                'variant_id' => $variant_id,
                'created_at' => Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s')
            ];
        }


        $result = OrderHasProduct::insert($data);

        $result = OrderHasStatus::create([
            'client_id' => $client_id,
            'order_id' => $order->id,
            'status_id' => 1
        ]);

        if ($result) {
            return ['status' => 'success', 'data' => $order];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_client_address($client)
    {


        $client = Client::find($client);
        $address = $client->address;

        if ($address) {
            return ['status' => 'success', 'data' => $address];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_set_client_address(Request $request)
    {



        $client_id = $request->client_id;

        $client = Client::find($client_id);
        $address_client = $client->address;
        $address = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;
        $street_name = $request->street_name;
        $house_number = $request->house_number;
        $building_name = $request->building_name;
        $floor_door_number = $request->floor_door_number;
        $code_postal = $request->code_postal;
        $city = $request->city;

        if ($address_client) {
            $result = $address_client->update([
                'address' => $address,
                'lat' => $lat,
                'lng' => $lng,
                'street_name' => $street_name,
                'house_number' => $house_number,
                'building_name' => $building_name,
                'floor_door_number' => $floor_door_number,
                'code_postal' => $code_postal,
                'city' => $city
            ]);
            $address_ = Address::whereClientId($client->id)->first();
        } else {
            $address_ = Address::create([
                'client_id' => $client_id,
                'address' => $address,
                'lat' => $lat,
                'lng' => $lng,
                'street_name' => $street_name,
                'house_number' => $house_number,
                'building_name' => $building_name,
                'floor_door_number' => $floor_door_number,
                'code_postal' => $code_postal,
                'city' => $city
            ]);
        }

        if ($result) {
            return ['status' => 'success', 'data' => $address_];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_delivery_setting()
    {


        $settings = DeliverySetting::all();
        if ($settings) {
            return ['status' => 'success', 'data' => $settings];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_order_statuses($order)
    {


        $statuses = OrderHasStatus::where('order_id', $order)->get();
        if ($statuses) {
            return ['status' => 'success', 'data' => $statuses];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_set_client_phone(Request $request)
    {

        $client_id = $request->client_id;
        $phone = $request->phone;
        $client = Client::whereId($client_id)->first();

        $result = $client->update([
            'phone' => $phone,
            'phone_verified_at' => Date('Y-m-d H:i:s')
        ]);

        if ($result) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_set_client_token(Request $request)
    {

        $client_id = $request->client_id;
        $token = $request->token;
        $client = Client::whereId($client_id)->first();

        $result = $client->update([
            'client_token' => $token
        ]);

        if ($result) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_change_client_password(Request $request)
    {

        $old_password = trim($request->old_password);
        $new_password = trim($request->new_password);
        $client_id = trim($request->client_id);

        $client = Client::whereId($client_id)->first();

        if ($client->password != md5($old_password)) {
            return ['status' => 'error'];
        }

        $result = $client->update([
            'password' => md5($new_password)
        ]);


        if ($result) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_refund_order(Request $request)
    {

        $order_id = $request->order_id;
        $client_id = $request->client_id;
        $reason = $request->reason;

        $result = OrderRefund::create([
            'order_id' => $order_id,
            'client_id' => $client_id,
            'reason' => $reason,
        ]);
        $order = Order::whereId($order_id)->first();
        $order->update([
            'status_id' => 10
        ]);
        OrderHasStatus::create([
            'order_id' => $order_id,
            'status_id' => 10,
            'client_id' => $client_id,
            'user_id' => 1
        ]);

        if ($result) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }

    public function api_get_stores_types()
    {


        $stores_types = StoreType::all();
        if (count($stores_types)) {
            return ['status' => 'success', 'data' => [$stores_types]];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_get_product_variants($product_id)
    {


        $variants = Variant::where('product_id', $product_id)->get();
        if (count($variants)) {
            return ['status' => 'success', 'data' => [$variants]];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_get_client_orders($client_id)
    {


        $orders = Order::where('client_id', $client_id)->get();

        foreach ($orders as $order) {

            $current_status = Status::whereId($order->status_id)->first();
            $order->current_status = $current_status->name;
            $statuses_arr = OrderHasStatus::select('status_id', 'created_at')->where('order_id', $order->id)->get();
            $order->statuses = $statuses_arr;
            $order->store = Store::whereId($order->store_id)->first();
            $products_arr = $order->products;
            $products = array();
            foreach ($products_arr as $product) {
                $p = array();
                $res = OrderHasProduct::whereProductId($product->id)->whereOrderId($order->id)->first();
                $p['id'] = $product->id;
                $p['name'] = $product->name;
                $p['image'] = $product->image;
                if ($product->has_variants == 0) {
                    $p['price'] = $product->price;
                } else {
                    $variant_id = $res->variant_id;
                    $variant = Variant::whereId($variant_id)->first();
                    $p['price'] = $variant->price;
                    $p['variant'] = $variant->option;
                }
                $p['qty'] = $res->qty;

                $products[] = $p;
            }
            $order->products_ = $products;
        }
        if (count($orders)) {
            return ['status' => 'success', 'data' => [$orders]];
        } else {
            return ['status' => 'error', 'data' => []];
        }
    }

    public function api_check_client_email(Request $request)
    {


        $check = Client::whereEmail($request->email)->first();
        if ($check) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error'];
        }
    }
}