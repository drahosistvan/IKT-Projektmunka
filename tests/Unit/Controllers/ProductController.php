<?php
use App\Http\Controllers\ProductController;
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

it('returns product, category, and related products', function () {
    $mockCategory = (object)['id' => 1, 'name' => 'Notebooks'];
    $mockProduct = Mockery::mock(Product::class);
    $mockProduct->id = 10;
    $mockProduct->category_id = 1;
    $mockProduct->category = $mockCategory;

    $relatedProducts = collect([
        (object)['id' => 11, 'category_id' => 1],
        (object)['id' => 12, 'category_id' => 1],
        (object)['id' => 13, 'category_id' => 1],
    ]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('category_id', '=', 1)->andReturnSelf();
    $productMock->shouldReceive('take')->with(3)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($relatedProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockProduct, $mockCategory, $relatedProducts) {
            expect($component)->toBe('Product');
            expect($props['product'])->toBe($mockProduct);
            expect($props['category'])->toBe($mockCategory);
            expect($props['relatedProducts'])->toHaveCount(3);
            return true;
        })
        ->andReturn(new Response('Product', [
            'product' => $mockProduct,
            'category' => $mockCategory,
            'relatedProducts' => $relatedProducts,
        ]));

    $controller = new ProductController();
    $response = $controller->__invoke(new Request(), $mockProduct);

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns product with no related products', function () {
    $mockCategory = (object)['id' => 2, 'name' => 'Pens'];
    $mockProduct = Mockery::mock(Product::class);
    $mockProduct->id = 20;
    $mockProduct->category_id = 2;
    $mockProduct->category = $mockCategory;

    $relatedProducts = collect([]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('category_id', '=', 2)->andReturnSelf();
    $productMock->shouldReceive('take')->with(3)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($relatedProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockProduct, $mockCategory, $relatedProducts) {
            expect($component)->toBe('Product');
            expect($props['product'])->toBe($mockProduct);
            expect($props['category'])->toBe($mockCategory);
            expect($props['relatedProducts'])->toHaveCount(0);
            return true;
        })
        ->andReturn(new Response('Product', [
            'product' => $mockProduct,
            'category' => $mockCategory,
            'relatedProducts' => $relatedProducts,
        ]));

    $controller = new ProductController();
    $response = $controller->__invoke(new Request(), $mockProduct);

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns product with null category', function () {
    $mockProduct = Mockery::mock(Product::class);
    $mockProduct->id = 30;
    $mockProduct->category_id = null;
    $mockProduct->category = null;

    $relatedProducts = collect([]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('category_id', '=', null)->andReturnSelf();
    $productMock->shouldReceive('take')->with(3)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($relatedProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockProduct, $relatedProducts) {
            expect($component)->toBe('Product');
            expect($props['product'])->toBe($mockProduct);
            expect($props['category'])->toBeNull();
            expect($props['relatedProducts'])->toHaveCount(0);
            return true;
        })
        ->andReturn(new Response('Product', [
            'product' => $mockProduct,
            'category' => null,
            'relatedProducts' => $relatedProducts,
        ]));

    $controller = new ProductController();
    $response = $controller->__invoke(new Request(), $mockProduct);

    expect($response)->toBeInstanceOf(Response::class);
});
