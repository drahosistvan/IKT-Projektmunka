<?php
use App\Http\Controllers\CartController;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Squire\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

beforeEach(function () {
    Mockery::close();
});

afterEach(function () {
    Mockery::close();
});

it('renders the cart page', function () {
    Inertia::shouldReceive('render')
        ->once()
        ->with('Cart', [])
        ->andReturn(new Response('Cart', []));

    $controller = new CartController();
    $response = $controller->index();

    expect($response)->toBeInstanceOf(Response::class);
});

it('renders the checkout page with countries and user', function () {
    $countries = collect([['code_2' => 'US', 'name' => 'United States']]);
    $user = (object)['id' => 1, 'email' => 'test@example.com'];

    // Mock static method Country::all()
    Mockery::mock('alias:' . Country::class)
        ->shouldReceive('all')
        ->with(['code_2', 'name'])
        ->andReturn($countries);

    Auth::shouldReceive('user')->andReturn($user);

    Inertia::shouldReceive('render')
        ->once()
        ->with('Checkout', [
            'countries' => $countries,
            'user' => $user,
        ])
        ->andReturn(new Response('Checkout', [
            'countries' => $countries,
            'user' => $user,
        ]));

    $controller = new CartController();
    $response = $controller->checkout();

    expect($response)->toBeInstanceOf(Response::class);
});

it('renders the order submitted page', function () {
    Inertia::shouldReceive('render')
        ->once()
        ->with('OrderSubmitted', [])
        ->andReturn(new Response('OrderSubmitted', []));

    $controller = new CartController();
    $response = $controller->orderSubmitted();

    expect($response)->toBeInstanceOf(Response::class);
});
