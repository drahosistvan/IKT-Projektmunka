<?php
use App\Http\Controllers\PageController;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

beforeEach(function () {
    Mockery::close();
});

afterEach(function () {
    Mockery::close();
});

it('returns a page', function () {
    $mockPage = new Page(['id' => 1, 'title' => 'About', 'content' => 'About us content']);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockPage) {
            expect($component)->toBe('Page');
            expect($props)->toHaveKey('page');
            expect($props['page'])->toBe($mockPage);
            return true;
        })
        ->andReturn(new Response('Page', ['page' => $mockPage]));

    $controller = new PageController();
    $response = $controller->__invoke(new Request(), $mockPage);

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns a page with null content', function () {
    $mockPage = new Page(['id' => 2, 'title' => 'Contact', 'content' => null]);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockPage) {
            expect($props['page']->content)->toBeNull();
            return true;
        })
        ->andReturn(new Response('Page', ['page' => $mockPage]));

    $controller = new PageController();
    $response = $controller->__invoke(new Request(), $mockPage);

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns a page with special characters in title', function () {
    $mockPage = new Page(['id' => 3, 'title' => '<b>Terms & Conditions</b>', 'content' => '...']);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockPage) {
            expect($props['page']->title)->toBe('<b>Terms & Conditions</b>');
            return true;
        })
        ->andReturn(new Response('Page', ['page' => $mockPage]));

    $controller = new PageController();
    $response = $controller->__invoke(new Request(), $mockPage);

    expect($response)->toBeInstanceOf(Response::class);
});
