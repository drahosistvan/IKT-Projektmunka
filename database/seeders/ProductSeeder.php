<?php

namespace Database\Seeders;

use App\Models\Shop\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'BAG-BROWN' => [
                'name' => 'Barna tároló táska',
                'category' => 'taskak',
                'price' => 10000,
                'description' => 'Íme végre egy módja annak, hogy úgy hordozd az ebédedet, hogy közben ne érezd úgy, mintha a gyereked uzsonnás dobozát loptad volna el. Ezek a Hightide minimalista hűtőtáskái tiszta, visszafogott dizájnnal rendelkeznek, és minden megfelelő helyen funkcionális részletekkel vannak ellátva. A gumírozott cipzárhúzóktól a szigetelt belső részen át a masszív szövött fogantyúkig egyetlen részlet sem maradt figyelmen kívül. A táskák laposra is hajthatók, ami hasznos utazáskor és tároláskor.',
                'slug' => 'barna-taska',
                'featured' => true,
            ],
            'CARGO-BAG' => [
                'name' => 'Cargo tároló táska',
                'category' => 'taskak',
                'price' => 15000,
                'description' => 'Ezek a Japánból származó, túlméretezett Hightide Rakomány Táskák tökéletesek nagy terhek szállítására – legyen szó akár kempingfelszerelésről, bevásárlásról vagy babaholmikról (a gyerekekhez annyi minden kell!). A bevonatos poliészter anyag tartós és ellenáll a kopásnak. A táska rendkívül kompakt méretre tekerhető össze, ami kényelmessé teszi őket autóban vagy szekrényben való tárolásra.',
                'slug' => 'bevasarlo-taska',
            ],
            'YELLOW-BAG' => [
                'name' => 'Sárga bevásárló táska',
                'category' => 'taskak',
                'price' => 15000,
                'description' => 'Ezek a Japánból származó, túlméretezett Hightide Rakomány Táskák tökéletesek nagy terhek szállítására – legyen szó akár kempingfelszerelésről, bevásárlásról vagy babaholmikról (a gyerekekhez annyi minden kell!). A bevonatos poliészter anyag tartós és ellenáll a kopásnak. A táska rendkívül kompakt méretre tekerhető össze, ami kényelmessé teszi őket autóban vagy szekrényben való tárolásra.',
                'slug' => 'sarga-bevasarlo-taska',
            ],
            'LAPTOP-BAG' => [
                'name' => 'Laptop táska',
                'category' => 'taskak',
                'price' => 20000,
                'description' => 'Különleges együttműködés a J. Stark barátainkkal, kézzel készítve Charlestonban, Dél-Karolinában.
                    A Prospect a klasszikus aktatáska modern változata, minden megfelelő részlettel a megfelelő helyeken. Olyan masszív, mint egy tank, és lehet, hogy ez lesz az utolsó táska, amit valaha is megvásárolsz.
                    Kompakt mérete és párnázott bőr vállpántja miatt tökéletes a munkába járáshoz vagy a világ körüli utazáshoz. A belső rész három kis zsebet, egy nagyobb zsebet egy táblagép számára és a fő rekeszt egy legfeljebb 15 hüvelykes laptop számára tartalmaz.
                    Minden egyes Prospect aktatáska szeretettel készül, a legmagasabb minőségű anyagokból – nehézsúlyú twill, teljes szemcsés Wickett & Craig bőr és réz szerelvények.',
                'slug' => 'laptop-bevasarlo-taska',
                'featured' => true,
            ],
            'WEEKLY-NOTE' => [
                'name' => 'Heti jegyzetfüzet',
                'category' => 'jegyzetfuzetek',
                'price' => 5000,
                'description' => 'Egy egyszerű módja annak, hogy megtervezd a heted, és mindent egy pillantással áttekints. Minden csomag 52 kártyát tartalmaz, ami elegendő egy teljes évre.',
                'slug' => 'heti-jegyzetfuzet',
            ],
            'NOTE-DOTTED' => [
                'name' => 'Pöttyös jegyzetfüzet',
                'category' => 'jegyzetfuzetek',
                'price' => 4000,
                'description' => 'Egy csomag 50 analóg pontozott rácsos kártya. Tökéletes ötletek vázlatolásához és jegyzeteléshez.',
                'slug' => 'pottyos-jegyzetfuzet',
            ],
            'NOTE-LINED' => [
                'name' => 'Vonalas jegyzetfüzet',
                'category' => 'jegyzetfuzetek',
                'price' => 4000,
                'description' => 'Egy csomag 50 analóg vonalas kártya. Tökéletes listák készítéséhez és jegyzeteléshez.',
                'slug' => 'vonalas-jegyzetfuzet',
            ],
            'NOTE' => [
                'name' => 'Napló utántöltő',
                'category' => 'jegyzetfuzetek',
                'price' => 8000,
                'description' => 'Frissítsd fel a Discbound naplódat ezzel az utántöltő papírcsomaggal. A 70# sima fehér papír finom pontozott rácsmintával tökéletes vázlatoláshoz, jegyzeteléshez és naplóíráshoz.',
                'slug' => 'naplo-utantolto',
                'featured' => true,
            ],
            'BROWN-MUG' => [
                'name' => 'Barna porcelán bögre',
                'category' => 'bogrek',
                'price' => 6000,
                'description' => 'A tiszta, minimalista forma és a természetes texturált felület teszi ezt a bögrét igazán széppé. A Hasami bögrék egyenletes átmérője miatt könnyen egymásra rakhatók a praktikus tárolás érdekében. A bögre a japán Nagasaki tartománybeli Hasami történelmi falujából származó agyag és zúzott kő egyedi keverékéből készül. A Hasami porcelánt több mint 400 éves módszerekkel készítik. Ellentétben a tömegtermelésű porcelánnal, minden darab egyedi karaktert nyer a kézi formázás, mázolás és égetés során.',
                'slug' => 'barna-porcelan-bogre',
            ],
            'KULACS' => [
                'name' => 'Kids Kinto Play Tumbler',
                'category' => 'bogrek',
                'price' => 6000,
                'description' => 'A Kids Kinto Play Tumbler egy duplafalú palack forró vagy hideg italok számára. A vákuumszigetelés 6 órán át hidegen tartja a gyerek italát. Az ívelt fogantyú kényelmessé teszi a hordozást vagy a táskához való rögzítést. A két részből álló fedél lehetővé teszi a könnyű töltést, tisztítást és ivást (bármilyen szögből), ugyanakkor teljesen cseppmentes és tökéletes útközben is.',
                'slug' => 'palack',
            ],
            'FEHER-KERAMIA-POHAR' => [
                'name' => 'Fehér kerámia pohár',
                'category' => 'bogrek',
                'price' => 6000,
                'description' => 'Egy nyugodt tájkép, ahol a föld találkozik a fával. A HMM Mugr tajvani kézművesek által, 11 különálló folyamat során készül. A bögre teste kiváló minőségű japán kerámiából készül, és sima mázzal van bevonva. A tömör bükkfa fogantyú ergonomikus formát hoz létre, amely kellemes fogást biztosít.
                    Megjegyzés: Nem mikrózható. Csak kézzel mosható (hideg vagy langyos vízben). A legjobb eredmény érdekében a fa fogantyút szükség szerint konyhai olajjal polírozd, és kerüld az áztatást.',
                'slug' => 'feher-keramia-pohar',
                'featured' => true,
            ],

        ];

        foreach ($products as $sku => $product) {
            \App\Models\Product::factory()->create([
                'name' => $product['name'],
                'slug' => $product['slug'],
                'sku' => $sku,
                'description' => $product['description'],
                'category_id' => \App\Models\ProductCategory::where('slug', $product['category'])->first()->id,
                'qty' => 10,
                'featured' => isset($product['featured']) ? $product['featured'] : false,
                'is_visible' => true,
                'old_price' => $product['price'] + 5000,
                'price' => $product['price'],
                'cost' => $product['price'] - 5000,
            ]);
        }
    }
}
