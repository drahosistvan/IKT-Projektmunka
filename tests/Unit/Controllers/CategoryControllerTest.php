<?php
use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

beforeEach(function () {
    Mockery::close();
});

afterEach(function () {
    Mockery::close();
});

it('returns products for a category', function () {
    $mockCategory = new ProductCategory(['id' => 1, 'name' => 'Notebooks']);
    $mockProducts = collect([
        (object)['id' => 1, 'category_id' => 1],
        (object)['id' => 2, 'category_id' => 1],
    ]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('category_id', $mockCategory->id)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($mockProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockCategory, $mockProducts) {
            expect($component)->toBe('Category');
            expect($props)->toHaveKey('category');
            expect($props['category'])->toBe($mockCategory);
            expect($props)->toHaveKey('products');
            expect($props['products'])->toHaveCount(2);
            return true;
        })
        ->andReturn(new Response('Category', [
            'category' => $mockCategory,
            'products' => $mockProducts,
        ]));

    $controller = new CategoryController();
    $response = $controller->__invoke(new Request(), $mockCategory);

    expect($response)->toBeInstanceOf(Response::class);
});

it('returns empty products for a category with no products', function () {
    $mockCategory = new ProductCategory(['id' => 2, 'name' => 'Pens']);
    $mockProducts = collect([]);

    $productMock = Mockery::mock('alias:' . Product::class);
    $productMock->shouldReceive('where')->with('category_id', $mockCategory->id)->andReturnSelf();
    $productMock->shouldReceive('get')->andReturn($mockProducts);

    Inertia::shouldReceive('render')
        ->once()
        ->withArgs(function ($component, $props) use ($mockCategory, $mockProducts) {
            expect($component)->toBe('Category');
            expect($props)->toHaveKey('category');
            expect($props['category'])->toBe($mockCategory);
            expect($props)->toHaveKey('products');
            expect($props['products'])->toHaveCount(0);
            return true;
        })
        ->andReturn(new Response('Category', [
            'category' => $mockCategory,
            'products' => $mockProducts,
        ]));

    $controller = new CategoryController();
    $response = $controller->__invoke(new Request(), $mockCategory);

    expect($response)->toBeInstanceOf(Response::class);
});
