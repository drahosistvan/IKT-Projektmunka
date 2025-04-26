<?php

use App\Http\Controllers\HomePageController;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

beforeEach(function () {
    Mockery::close();
});

afterEach(function () {
    Mockery::close();
});

it('returns 3 favorites in HomePageController', function () {
    $mockProducts = collect([
        (object)['id' => 1, 'featured' => true],
        (object)['id' => 2, 'featured' => true],
        (object)['id' => 3, 'featured' => true],
    ]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('featured', true)->andReturnSelf();
    $productMock->shouldReceive('take')->with(3)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($mockProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockProducts) {
            expect($component)->toBe('Homepage');
            expect($props)->toHaveKey('favorites');
            expect($props['favorites'])->toHaveCount(3);
            return true;
        })
        ->andReturn(new Response('Homepage', ['favorites' => $mockProducts]));

    $controller = new HomePageController();
    $response = $controller->__invoke(new Request());

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns no favorites if none are featured', function () {
    $mockProducts = collect([]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('featured', true)->andReturnSelf();
    $productMock->shouldReceive('take')->with(3)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($mockProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockProducts) {
            expect($component)->toBe('Homepage');
            expect($props)->toHaveKey('favorites');
            expect($props['favorites'])->toHaveCount(0);
            return true;
        })
        ->andReturn(new Response('Homepage', ['favorites' => $mockProducts]));

    $controller = new HomePageController();
    $response = $controller->__invoke(new Request());

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns fewer favorites if less than 3 are featured', function () {
    $mockProducts = collect([
        (object)['id' => 1, 'featured' => true],
        (object)['id' => 2, 'featured' => true],
    ]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('featured', true)->andReturnSelf();
    $productMock->shouldReceive('take')->with(3)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($mockProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockProducts) {
            expect($component)->toBe('Homepage');
            expect($props)->toHaveKey('favorites');
            expect($props['favorites'])->toHaveCount(2);
            return true;
        })
        ->andReturn(new Response('Homepage', ['favorites' => $mockProducts]));

    $controller = new HomePageController();
    $response = $controller->__invoke(new Request());

    expect($response)->toBeInstanceOf(Response::class);
});
