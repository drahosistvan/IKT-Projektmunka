<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terms = '
    <h2>1. Bevezetés</h2>
    <p>Jelen Általános Szerződési Feltételek (a továbbiakban: "ÁSZF") a [Webáruház Neve] (a továbbiakban: "Webáruház") és az ügyfelei (a továbbiakban: "Vásárló") között jönnek létre. A Webáruház üzemeltetője [Cégnév, Székhely, Cégjegyzékszám, Adószám].</p>

    <h2>2. Termékek</h2>
    <p>A Webáruház néhány kiválasztott terméket kínál, amelyek részletes leírása, ára és elérhetősége a weboldalon található. Az árak forintban (HUF) értendők, és tartalmazzák az ÁFÁ-t.</p>

    <h2>3. Megrendelés folyamata</h2>
    <ol>
        <li><strong>Termék kiválasztása</strong>: A Vásárló kiválasztja a megvásárolni kívánt terméket.</li>
        <li><strong>Kosárba helyezés</strong>: A terméket a "Kosárba" gombra kattintva helyezi a kosarába.</li>
        <li><strong>Adatok megadása</strong>: A Vásárló megadja a szükséges szállítási és számlázási adatokat.</li>
        <li><strong>Fizetési mód kiválasztása</strong>: A Vásárló kiválasztja a kívánt fizetési módot:
            <ul>
                <li>Utánvét</li>
                <li>Banki előreutalás</li>
            </ul>
        </li>
        <li><strong>Megrendelés véglegesítése</strong>: A "Megrendelés elküldése" gombra kattintva a Vásárló véglegesíti a megrendelést.</li>
    </ol>

    <h2>4. Fizetési módok</h2>
    <ul>
        <li><strong>Utánvét</strong>: A termék átvételekor a futárnak történik a fizetés.</li>
        <li><strong>Banki előreutalás</strong>: A Vásárló előre utalja az összeget a Webáruház bankszámlájára. A rendelés feldolgozása a fizetés beérkezése után történik.</li>
    </ul>

    <h2>5. Szállítás</h2>
    <p>A szállítást futárszolgálat végzi. A szállítási díjak és a várható szállítási idő a rendelés során kerülnek feltüntetésre. A szállítás kizárólag Magyarország területére történik.</p>

    <h2>6. Elállási jog</h2>
    <p>A Vásárlónak jogában áll a termék átvételétől számított 14 napon belül indoklás nélkül elállni a vásárlástól. Az elállási szándékot írásban kell jelezni a Webáruház felé. A termék visszaküldésének költsége a Vásárlót terheli.</p>

    <h2>7. Adatvédelem</h2>
    <p>A Webáruház a Vásárlók személyes adatait bizalmasan kezeli, és kizárólag a megrendelések teljesítéséhez használja fel. Az adatkezelés részleteiről az Adatvédelmi Tájékoztatóban található információ.</p>

    <h2>8. Kapcsolat</h2>
    <p>Bármilyen kérdés vagy probléma esetén a Vásárló az alábbi elérhetőségeken veheti fel a kapcsolatot a Webáruházzal:</p>
    <ul>
        <li>E-mail: [email@example.com]</li>
        <li>Telefon: [+36 1 234 5678]</li>
    </ul>

    <h2>9. Záró rendelkezések</h2>
    <p>Jelen ÁSZF-re a magyar jog az irányadó. A Webáruház fenntartja a jogot az ÁSZF egyoldalú módosítására. A módosítások a weboldalon történő közzététellel lépnek hatályba.</p>';

        \App\Models\Page::factory()->create([
            'title' => 'Általános Szerződési Feltételek',
            'slug' => 'altalanos-szerzodesi-feltetelek',
            'content' => $terms,
            'seo_title' => 'Általános Szerződési Feltételek',
            'seo_description' => 'Általános Szerződési Feltételek',
            'is_visible' => true,
        ]);

        $privacy = "
    <h2>1. Bevezetés</h2>
    <p>Jelen Adatkezelési Tájékoztató célja, hogy tájékoztatást nyújtson a [Webáruház Neve] által kezelt személyes adatok köréről, azok felhasználásának módjáról és az érintettek jogairól.</p>

    <h2>2. Adatkezelő</h2>
    <p>Az adatkezelő: [Cégnév, Székhely, Cégjegyzékszám, Adószám].</p>

    <h2>3. Kezelt adatok köre</h2>
    <p>A Webáruház az alábbi személyes adatokat kezeli:</p>
    <ul>
        <li>Név</li>
        <li>Cím</li>
        <li>E-mail cím</li>
        <li>Telefonszám</li>
        <li>Számlázási adatok</li>
    </ul>

    <h2>4. Az adatkezelés célja</h2>
    <p>Az adatkezelés célja a megrendelések teljesítése, a vásárlói kapcsolattartás, valamint a számlázás és a szállítás lebonyolítása.</p>

    <h2>5. Az adatkezelés jogalapja</h2>
    <p>Az adatkezelés a Vásárló hozzájárulásán, valamint a szerződés teljesítéséhez szükséges jogalapon történik.</p>

    <h2>6. Adatfeldolgozók</h2>
    <p>A Webáruház az alábbi adatfeldolgozókat veszi igénybe:</p>
    <ul>
        <li>Futárszolgálat: [Futárszolgálat neve]</li>
        <li>Számlázási rendszer: [Számlázási rendszer neve]</li>
    </ul>

    <h2>7. Adattovábbítás</h2>
    <p>A személyes adatok továbbításra kerülhetnek a futárszolgálat, valamint a számlázási rendszer üzemeltetője részére a szerződés teljesítése érdekében.</p>

    <h2>8. Az érintettek jogai</h2>
    <p>Az érintettek jogosultak:</p>
    <ul>
        <li>Tájékoztatást kérni személyes adataik kezeléséről</li>
        <li>A személyes adataik helyesbítését kérni</li>
        <li>A személyes adataik törlését vagy kezelésének korlátozását kérni</li>
        <li>Adathordozhatósághoz való jogukat gyakorolni</li>
        <li>Hozzájárulásukat bármikor visszavonni</li>
    </ul>

    <h2>9. Kapcsolat</h2>
    <p>Bármilyen kérdés vagy probléma esetén az érintettek az alábbi elérhetőségeken vehetik fel a kapcsolatot az adatkezelővel:</p>
    <ul>
        <li>E-mail: [email@example.com]</li>
        <li>Telefon: [+36 1 234 5678]</li>
    </ul>

    <h2>10. Záró rendelkezések</h2>
    <p>Jelen Adatkezelési Tájékoztatóra a magyar jog az irányadó. Az adatkezelő fenntartja a jogot a tájékoztató egyoldalú módosítására. A módosítások a weboldalon történő közzététellel lépnek hatályba.</p>";

        \App\Models\Page::factory()->create([
            'title' => 'Adatkezelési Tájékoztató',
            'slug' => 'adatkezelesi-tajekoztato',
            'content' => $privacy,
            'seo_title' => 'Adatkezelési Tájékoztató',
            'seo_description' => 'Adatkezelési Tájékoztató',
            'is_visible' => true,
        ]);

        $shipping = '<h2>1. Bevezetés</h2>
    <p>Jelen Adatkezelési Tájékoztató célja, hogy tájékoztatást nyújtson a [Webáruház Neve] által kezelt személyes adatok köréről, azok felhasználásának módjáról és az érintettek jogairól.</p>

    <h2>2. Adatkezelő</h2>
    <p>Az adatkezelő: [Cégnév, Székhely, Cégjegyzékszám, Adószám].</p>

    <h2>3. Kezelt adatok köre</h2>
    <p>A Webáruház az alábbi személyes adatokat kezeli:</p>
    <ul>
        <li>Név</li>
        <li>Cím</li>
        <li>E-mail cím</li>
        <li>Telefonszám</li>
        <li>Számlázási adatok</li>
    </ul>

    <h2>4. Az adatkezelés célja</h2>
    <p>Az adatkezelés célja a megrendelések teljesítése, a vásárlói kapcsolattartás, valamint a számlázás és a szállítás lebonyolítása.</p>

    <h2>5. Az adatkezelés jogalapja</h2>
    <p>Az adatkezelés a Vásárló hozzájárulásán, valamint a szerződés teljesítéséhez szükséges jogalapon történik.</p>

    <h2>6. Adatfeldolgozók</h2>
    <p>A Webáruház az alábbi adatfeldolgozókat veszi igénybe:</p>
    <ul>
        <li>Futárszolgálat: [Futárszolgálat neve]</li>
        <li>Számlázási rendszer: [Számlázási rendszer neve]</li>
    </ul>

    <h2>7. Adattovábbítás</h2>
    <p>A személyes adatok továbbításra kerülhetnek a futárszolgálat, valamint a számlázási rendszer üzemeltetője részére a szerződés teljesítése érdekében.</p>

    <h2>8. Az érintettek jogai</h2>
    <p>Az érintettek jogosultak:</p>
    <ul>
        <li>Tájékoztatást kérni személyes adataik kezeléséről</li>
        <li>A személyes adataik helyesbítését kérni</li>
        <li>A személyes adataik törlését vagy kezelésének korlátozását kérni</li>
        <li>Adathordozhatósághoz való jogukat gyakorolni</li>
        <li>Hozzájárulásukat bármikor visszavonni</li>
    </ul>

    <h2>9. Kapcsolat</h2>
    <p>Bármilyen kérdés vagy probléma esetén az érintettek az alábbi elérhetőségeken vehetik fel a kapcsolatot az adatkezelővel:</p>
    <ul>
        <li>E-mail: [email@example.com]</li>
        <li>Telefon: [+36 1 234 5678]</li>
    </ul>

    <h2>10. Záró rendelkezések</h2>
    <p>Jelen Adatkezelési Tájékoztatóra a magyar jog az irányadó. Az adatkezelő fenntartja a jogot a tájékoztató egyoldalú módosítására. A módosítások a weboldalon történő közzététellel lépnek hatályba.</p>';

        \App\Models\Page::factory()->create([
            'title' => 'Szállítás',
            'slug' => 'szallitas',
            'content' => $shipping,
            'seo_title' => 'Szállítás',
            'seo_description' => 'Szállítási feltételek',
            'is_visible' => true,
        ]);

        $returns = '<h2>Elállási jog</h2>
    <p>Ön jogosult a termék átvételétől számított 14 napon belül indoklás nélkül elállni a vásárlástól. Az elállási jog gyakorlása esetén a terméket saját költségén kell visszajuttatnia hozzánk.</p>

    <h2>Visszaküldési folyamat</h2>
    <ol>
        <li><strong>Kapcsolatfelvétel</strong>: Kérjük, vegye fel velünk a kapcsolatot e-mailben vagy telefonon, hogy jelezze visszaküldési szándékát.</li>
        <li><strong>Csomagolás</strong>: Kérjük, gondosan csomagolja be a terméket, lehetőleg az eredeti csomagolásban.</li>
        <li><strong>Visszaküldés</strong>: Küldje vissza a terméket az alábbi címre: [Cég neve, Cím]</li>
    </ol>

    <h2>Visszatérítés</h2>
    <p>A visszaküldött termék megérkezését és ellenőrzését követően a visszatérítést az eredeti fizetési módon keresztül teljesítjük. A visszatérítés általában 14 napon belül történik meg.</p>

    <h2>Nem visszaküldhető termékek</h2>
    <p>Bizonyos termékek, mint például a higiéniai vagy testápolási termékek, nem visszaküldhetők, amennyiben a csomagolásuk felbontásra került.</p>

    <h2>Kapcsolat</h2>
    <p>Amennyiben bármilyen kérdése lenne a visszaküldéssel kapcsolatban, kérjük, vegye fel velünk a kapcsolatot az alábbi elérhetőségeken:</p>
    <ul>
        <li>E-mail: [email@example.com]</li>
        <li>Telefon: [+36 1 234 5678]</li>
    </ul>';
        \App\Models\Page::factory()->create([
            'title' => 'Visszaküldés',
            'slug' => 'visszakuldes',
            'content' => $returns,
            'seo_title' => 'Visszaküldési és elállási feltételek',
            'seo_description' => 'Visszaküldési és elállási feltételek',
            'is_visible' => true,
        ]);

        $payments = '<h2>Fizetési mód</h2>
    <p>A Webáruházunkban a vásárlás utánvéttel történik. Ez azt jelenti, hogy Ön a termék átvételekor fizet a futárnak készpénzben vagy, ahol elérhető, bankkártyával.</p>

    <h2>Utánvét díja</h2>
    <p>Az utánvét díja a szállítási költségen felül kerül felszámításra, és a rendelés során kerül feltüntetésre. Kérjük, ellenőrizze a végösszeget a rendelés leadása előtt.</p>

    <h2>Fizetési folyamat</h2>
    <ol>
        <li><strong>Rendelés leadása</strong>: Válassza ki a megvásárolni kívánt termékeket, és helyezze őket a kosarába.</li>
        <li><strong>Szállítási adatok megadása</strong>: Adja meg a szükséges szállítási adatokat.</li>
        <li><strong>Fizetés</strong>: A termék átvételekor fizessen a futárnak készpénzben vagy, ahol elérhető, bankkártyával.</li>
    </ol>

    <h2>Kapcsolat</h2>
    <p>Amennyiben bármilyen kérdése lenne a fizetéssel kapcsolatban, kérjük, vegye fel velünk a kapcsolatot az alábbi elérhetőségeken:</p>
    <ul>
        <li>E-mail: [email@example.com]</li>
        <li>Telefon: [+36 1 234 5678]</li>
    </ul>';
        \App\Models\Page::factory()->create([
            'title' => 'Fizetési módok',
            'slug' => 'fizetes',
            'content' => $payments,
            'seo_title' => 'Fizetési módok',
            'seo_description' => 'Fizetési módok',
            'is_visible' => true,
        ]);

        $sustainablility = '
    <h2>Küldetésünk</h2>
    <p>Célunk, hogy hozzájáruljunk egy fenntarthatóbb jövőhöz azáltal, hogy csökkentjük környezeti lábnyomunkat, és támogatjuk a tudatos vásárlói döntéseket. Hiszünk abban, hogy közös felelősségünk megvédeni bolygónkat a jövő generációi számára.</p>

    <h2>Környezetbarát csomagolás</h2>
    <p>Termékeink csomagolásakor környezetbarát anyagokat használunk, amelyek újrahasznosíthatók vagy lebomlanak. Arra törekszünk, hogy minimalizáljuk a műanyag felhasználását, és előnyben részesítjük az újrahasznosított papírt és kartont.</p>

    <h2>Helyi beszállítók</h2>
    <p>Támogatjuk a helyi gazdaságot azáltal, hogy helyi beszállítókkal dolgozunk együtt. Ez nemcsak a közösségeket erősíti, hanem csökkenti a szállítási távolságokat is, ezáltal mérsékelve a szén-dioxid-kibocsátást.</p>

    <h2>Energiahatekonyság</h2>
    <p>Üzleteink és raktáraink energiahatékony megoldásokat alkalmaznak, beleértve a LED világítást és a megújuló energiaforrások használatát. Célunk, hogy folyamatosan csökkentsük energiafogyasztásunkat és növeljük energiahatékonyságunkat.</p>

    <h2>Közösségi programok</h2>
    <p>Aktívan részt veszünk különböző közösségi programokban, amelyek célja a környezeti tudatosság növelése és a fenntartható életmód népszerűsítése. Támogatjuk az oktatási kezdeményezéseket és a környezetvédelmi projekteket.</p>

    <h2>Kapcsolat</h2>
    <p>Ha többet szeretne megtudni fenntarthatósági törekvéseinkről, vagy javaslatai vannak, kérjük, vegye fel velünk a kapcsolatot az alábbi elérhetőségeken:</p>
    <ul>
        <li>E-mail: [email@example.com]</li>
        <li>Telefon: [+36 1 234 5678]</li>
    </ul>';
        \App\Models\Page::factory()->create([
            'title' => 'Fenntarthatóság',
            'slug' => 'fenntarthatosag',
            'content' => $sustainablility,
            'seo_title' => 'Fenntarthatóság',
            'seo_description' => 'Fenntarthatóság',
            'is_visible' => true,
        ]);
    }
}
