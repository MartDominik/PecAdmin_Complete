<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         \App\Models\User::factory()->create([
             'lastname' => 'Test',
             'firstname' => 'dummy',
             'email' => 'test@test.com',
             'password' =>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
         ]);

        \App\Models\User::factory(10)->create();



        \App\Models\helyszinek::factory()->create([
            'nev'=>'Csepp Tó',
            'befogadohelyek'=>'31',
            'helyszin'=>'Monorierdő',
            'kep'=>'csepptemplate.jpg'
        ]);
        \App\Models\helyszinek::factory()->create([
            'nev'=>'Moby Dick',
            'befogadohelyek'=>'60',
            'helyszin'=>'Bugyi',
            'kep'=>'mobytemplate.jpg'
        ]);
        \App\Models\helyszinek::factory()->create([
            'nev'=>'Sárkány Tó',
            'befogadohelyek'=>'36',
            'helyszin'=>'Tóalmás',
            'kep'=>'sarkanytemplate.jpg'
        ]);
        \App\Models\hirdetes::factory(1)->create([
            'userid' =>'1',
            'versenynev'=>'Tesztverseny',
            'tipus' => 'teszt',
            'helyszinid'=> '1',
            'idopont'=>'2025-01-01',
            'rovidleiras'=>'📌Helyszín: Monorierdő, Csepp-tó
📌Időpont: 2025.01.01. (Péntek-ÜNNEPNAP)
📌Nevezési díj: 10.000 Ft/fő
📌Fizetési határidő: 2023.04.03.',
            'szabalyzat' => '
➡️Nagy hal fogása esetén azt jelezni kell, és mi azonnal megyünk! Letárolni, illetve magára hagyni TILOS, miután odaértünk a halat átvesszük és lehet folytatni a pecát. Ezzel is az a cél, hogy kevesebb idő menjen el az értékes horgászidőből!
➡️Háttérsegítség engedélyezett, de a horgászatot csak is az erre befizetett illető oldhatja meg mindenféle külső segítség nélkül!(pl.: etetés, fárasztás, dobás, szákolás)
(A háttérsegítség nagy hal fogása esetén vigyázhat a halra míg oda nem érünk, így a versenyző azonnal folytathatja a horgászatot tovább. Az a fontos, hogy a hal épségben legyen és ne a horgászidő teljen várakozással!)
➡️Egyszerre 1 bot, azon 1 horog használható, ami lehet szakálnélküli vagy mikroszakállas 6-os méretig.
➡️Felszerelve a versenyző mellet bármennyi bot/topset lehet.
➡️Spomb/Etetőhajó/Halradar használata TILOS!!
➡️Etetni lehet kézzel, kosárral, csúzlival, illetve rakósbot esetén kupakolóval.
➡️Pontymatrac vagy bölcső használata kötelező !(A tónál találhatóak fix bölcsők is két állásonként)
➡️Minden versenyző köteles a halak élve tartásáról gondoskodni, a legkisebb sérelemmel és a lehető legrövidebb időn belül a haltartóba helyezni!
➡️Fonottzsinór használata TILOS! Kivétel a horogelőke. Etetőboton lehet fonottzsinór!
➡️Kötelező minimum 3m-es versenyszák, lehetőleg  2db,de nem kötelező (ajánlott)
➡️Száklimit: 20kg !!
➡️Amennyiben a szák tartalma meghaladja a 20kg limitet, az afeletti súly nem számít bele a mérlegelésbe.
➡️4kg feletti ponty (amurt,koi pontyot azonnal mérjük súlyától függetlenül) azonnal mérlegelésre kerül! A tokhalat nem mérlegeljük, hanem 3kg-nak számítanak!
➡️Etetőanyaglimit: 8L !!! Ebbe beletartozik az etetőanyag (áttört, laza, nedvesített állapotban, nem összetömörítve a vödör aljára), pellet, szemes takarmány (ami csak főzött állapotban engedélyezett), illetve az élő etetőanyag is.
➡️Versenylefújás előtt megakasztott hal beleszámít a versenybe, ha a versenyző a lefújást követő 10 percen belül megszákolja.
➡️Damilos merítőfej használata TILOS!
➡️Halakat a szemüregnél megfogni és úgy visszaengedni TILOS!
➡️Halak reptetése tilos!
➡️Minden egyes halfaj kerüljön megmerítésre a hal méretétől függetlenül!
➡️Külsős hal ér, a kantáras viszont nem!
➡️Ezeken a szabályokon felül a tó szabályrendszere van érvényben! A versenyen való részvételhez kötelező a 2023-as állami engedély!',
                'leiras'=> '
✅Fizetni a tónál lehet készpénzben vagy utalással a következő számlaszámra: Törőcsik Krisztián e.v. 50437179-15559373 (A közleménybe versenyző neve+verseny dátumát kérjük beírni!)
✅Nevezésnél szükséges adatok: név, cím, e-mail cím, telefonszám! (Aki korábbi versenynél megadta az adatokat, annak már nem kell!)
❗️Előnevezés van, de a nevezés csak a nevezési díj befizetése után válik véglegessé!
❗️Visszamondás vagy a versenyen való részvétel hiányában a nevezési díj NEM tolódik másik versenyre és NEM kerül visszafizetésre!
🔴A tó 3 szektorra lesz bontva.
31 fő nevezését tudjuk elfogadni, utána tartalékba tudjuk felírni a nevezőket!
A kihúzott horgászhelyre be lehet állni kocsival!
A tó területén büfé található, ami egésznap rendelkezésetekre áll! 🍺🧃☕️🥤
DÍJAZÁS:
🏆Szektor I-II-III. helyezettek: kupa
🏆Legnagyobb hal: kupa
🏆Mázlidíj: kupa (az első 4kg feletti hal megfogójának)
🏆Citromdíj: kupa (a halat fogók közül a legkevesebbet fogónak)
A VERSENY MENETE:
⏰7.00-7.15 gyülekező
⏰7.15-7.30 sorsolás (2 lépésben fog zajlani! Első körben érkezési sorrendben kihúzzátok a húzási sorrendet, majd ebben a sorrendben kihúzzátok az állásokat, ahova ülni fogtok.)
⏰7.30-8.30 helyek elfoglalása, előkészületek, limitellenőrzés
⏰8.30-14.30 verseny (dudaszó)
⏰14.30-tól mérlegelés, eredményhirdetés
A verseny végén mindenki vendégünk egy finom ebédre!🥘
Eredményhirdetés után sötétedésig lehet maradni horgászni.'
        ]);
        \App\Models\hirdetes::factory(1)->create([
            'userid' =>'1',
            'versenynev'=>'Tesztverseny2',
            'tipus' => 'teszt',
            'helyszinid'=> '2',
            'idopont'=>'2025-01-01',
            'rovidleiras'=>'📌Helyszín: Monorierdő, Csepp-tó
📌Időpont: 2025.01.01. (Péntek-ÜNNEPNAP)
📌Nevezési díj: 10.000 Ft/fő
📌Fizetési határidő: 2023.04.03.',
            'szabalyzat' => '
➡️Nagy hal fogása esetén azt jelezni kell, és mi azonnal megyünk! Letárolni, illetve magára hagyni TILOS, miután odaértünk a halat átvesszük és lehet folytatni a pecát. Ezzel is az a cél, hogy kevesebb idő menjen el az értékes horgászidőből!
➡️Háttérsegítség engedélyezett, de a horgászatot csak is az erre befizetett illető oldhatja meg mindenféle külső segítség nélkül!(pl.: etetés, fárasztás, dobás, szákolás)
(A háttérsegítség nagy hal fogása esetén vigyázhat a halra míg oda nem érünk, így a versenyző azonnal folytathatja a horgászatot tovább. Az a fontos, hogy a hal épségben legyen és ne a horgászidő teljen várakozással!)
➡️Egyszerre 1 bot, azon 1 horog használható, ami lehet szakálnélküli vagy mikroszakállas 6-os méretig.
➡️Felszerelve a versenyző mellet bármennyi bot/topset lehet.
➡️Spomb/Etetőhajó/Halradar használata TILOS!!
➡️Etetni lehet kézzel, kosárral, csúzlival, illetve rakósbot esetén kupakolóval.
➡️Pontymatrac vagy bölcső használata kötelező !(A tónál találhatóak fix bölcsők is két állásonként)
➡️Minden versenyző köteles a halak élve tartásáról gondoskodni, a legkisebb sérelemmel és a lehető legrövidebb időn belül a haltartóba helyezni!
➡️Fonottzsinór használata TILOS! Kivétel a horogelőke. Etetőboton lehet fonottzsinór!
➡️Kötelező minimum 3m-es versenyszák, lehetőleg  2db,de nem kötelező (ajánlott)
➡️Száklimit: 20kg !!
➡️Amennyiben a szák tartalma meghaladja a 20kg limitet, az afeletti súly nem számít bele a mérlegelésbe.
➡️4kg feletti ponty (amurt,koi pontyot azonnal mérjük súlyától függetlenül) azonnal mérlegelésre kerül! A tokhalat nem mérlegeljük, hanem 3kg-nak számítanak!
➡️Etetőanyaglimit: 8L !!! Ebbe beletartozik az etetőanyag (áttört, laza, nedvesített állapotban, nem összetömörítve a vödör aljára), pellet, szemes takarmány (ami csak főzött állapotban engedélyezett), illetve az élő etetőanyag is.
➡️Versenylefújás előtt megakasztott hal beleszámít a versenybe, ha a versenyző a lefújást követő 10 percen belül megszákolja.
➡️Damilos merítőfej használata TILOS!
➡️Halakat a szemüregnél megfogni és úgy visszaengedni TILOS!
➡️Halak reptetése tilos!
➡️Minden egyes halfaj kerüljön megmerítésre a hal méretétől függetlenül!
➡️Külsős hal ér, a kantáras viszont nem!
➡️Ezeken a szabályokon felül a tó szabályrendszere van érvényben! A versenyen való részvételhez kötelező a 2023-as állami engedély!',
            'leiras'=> '
✅Fizetni a tónál lehet készpénzben vagy utalással a következő számlaszámra: Törőcsik Krisztián e.v. 50437179-15559373 (A közleménybe versenyző neve+verseny dátumát kérjük beírni!)
✅Nevezésnél szükséges adatok: név, cím, e-mail cím, telefonszám! (Aki korábbi versenynél megadta az adatokat, annak már nem kell!)
❗️Előnevezés van, de a nevezés csak a nevezési díj befizetése után válik véglegessé!
❗️Visszamondás vagy a versenyen való részvétel hiányában a nevezési díj NEM tolódik másik versenyre és NEM kerül visszafizetésre!
🔴A tó 3 szektorra lesz bontva.
31 fő nevezését tudjuk elfogadni, utána tartalékba tudjuk felírni a nevezőket!
A kihúzott horgászhelyre be lehet állni kocsival!
A tó területén büfé található, ami egésznap rendelkezésetekre áll! 🍺🧃☕️🥤
DÍJAZÁS:
🏆Szektor I-II-III. helyezettek: kupa
🏆Legnagyobb hal: kupa
🏆Mázlidíj: kupa (az első 4kg feletti hal megfogójának)
🏆Citromdíj: kupa (a halat fogók közül a legkevesebbet fogónak)
A VERSENY MENETE:
⏰7.00-7.15 gyülekező
⏰7.15-7.30 sorsolás (2 lépésben fog zajlani! Első körben érkezési sorrendben kihúzzátok a húzási sorrendet, majd ebben a sorrendben kihúzzátok az állásokat, ahova ülni fogtok.)
⏰7.30-8.30 helyek elfoglalása, előkészületek, limitellenőrzés
⏰8.30-14.30 verseny (dudaszó)
⏰14.30-tól mérlegelés, eredményhirdetés
A verseny végén mindenki vendégünk egy finom ebédre!🥘
Eredményhirdetés után sötétedésig lehet maradni horgászni.'
        ]);
        \App\Models\hirdetes::factory(1)->create([
            'userid' =>'2',
            'versenynev'=>'Tesztverseny3',
            'tipus' => 'teszt',
            'helyszinid'=> '1',
            'idopont'=>'2025-01-01',
            'rovidleiras'=>'📌Helyszín: Monorierdő, Csepp-tó
📌Időpont: 2025.01.01. (Péntek-ÜNNEPNAP)
📌Nevezési díj: 10.000 Ft/fő
📌Fizetési határidő: 2023.04.03.',
            'szabalyzat' => '
➡️Nagy hal fogása esetén azt jelezni kell, és mi azonnal megyünk! Letárolni, illetve magára hagyni TILOS, miután odaértünk a halat átvesszük és lehet folytatni a pecát. Ezzel is az a cél, hogy kevesebb idő menjen el az értékes horgászidőből!
➡️Háttérsegítség engedélyezett, de a horgászatot csak is az erre befizetett illető oldhatja meg mindenféle külső segítség nélkül!(pl.: etetés, fárasztás, dobás, szákolás)
(A háttérsegítség nagy hal fogása esetén vigyázhat a halra míg oda nem érünk, így a versenyző azonnal folytathatja a horgászatot tovább. Az a fontos, hogy a hal épségben legyen és ne a horgászidő teljen várakozással!)
➡️Egyszerre 1 bot, azon 1 horog használható, ami lehet szakálnélküli vagy mikroszakállas 6-os méretig.
➡️Felszerelve a versenyző mellet bármennyi bot/topset lehet.
➡️Spomb/Etetőhajó/Halradar használata TILOS!!
➡️Etetni lehet kézzel, kosárral, csúzlival, illetve rakósbot esetén kupakolóval.
➡️Pontymatrac vagy bölcső használata kötelező !(A tónál találhatóak fix bölcsők is két állásonként)
➡️Minden versenyző köteles a halak élve tartásáról gondoskodni, a legkisebb sérelemmel és a lehető legrövidebb időn belül a haltartóba helyezni!
➡️Fonottzsinór használata TILOS! Kivétel a horogelőke. Etetőboton lehet fonottzsinór!
➡️Kötelező minimum 3m-es versenyszák, lehetőleg  2db,de nem kötelező (ajánlott)
➡️Száklimit: 20kg !!
➡️Amennyiben a szák tartalma meghaladja a 20kg limitet, az afeletti súly nem számít bele a mérlegelésbe.
➡️4kg feletti ponty (amurt,koi pontyot azonnal mérjük súlyától függetlenül) azonnal mérlegelésre kerül! A tokhalat nem mérlegeljük, hanem 3kg-nak számítanak!
➡️Etetőanyaglimit: 8L !!! Ebbe beletartozik az etetőanyag (áttört, laza, nedvesített állapotban, nem összetömörítve a vödör aljára), pellet, szemes takarmány (ami csak főzött állapotban engedélyezett), illetve az élő etetőanyag is.
➡️Versenylefújás előtt megakasztott hal beleszámít a versenybe, ha a versenyző a lefújást követő 10 percen belül megszákolja.
➡️Damilos merítőfej használata TILOS!
➡️Halakat a szemüregnél megfogni és úgy visszaengedni TILOS!
➡️Halak reptetése tilos!
➡️Minden egyes halfaj kerüljön megmerítésre a hal méretétől függetlenül!
➡️Külsős hal ér, a kantáras viszont nem!
➡️Ezeken a szabályokon felül a tó szabályrendszere van érvényben! A versenyen való részvételhez kötelező a 2023-as állami engedély!',
            'leiras'=> '
✅Fizetni a tónál lehet készpénzben vagy utalással a következő számlaszámra: Törőcsik Krisztián e.v. 50437179-15559373 (A közleménybe versenyző neve+verseny dátumát kérjük beírni!)
✅Nevezésnél szükséges adatok: név, cím, e-mail cím, telefonszám! (Aki korábbi versenynél megadta az adatokat, annak már nem kell!)
❗️Előnevezés van, de a nevezés csak a nevezési díj befizetése után válik véglegessé!
❗️Visszamondás vagy a versenyen való részvétel hiányában a nevezési díj NEM tolódik másik versenyre és NEM kerül visszafizetésre!
🔴A tó 3 szektorra lesz bontva.
31 fő nevezését tudjuk elfogadni, utána tartalékba tudjuk felírni a nevezőket!
A kihúzott horgászhelyre be lehet állni kocsival!
A tó területén büfé található, ami egésznap rendelkezésetekre áll! 🍺🧃☕️🥤
DÍJAZÁS:
🏆Szektor I-II-III. helyezettek: kupa
🏆Legnagyobb hal: kupa
🏆Mázlidíj: kupa (az első 4kg feletti hal megfogójának)
🏆Citromdíj: kupa (a halat fogók közül a legkevesebbet fogónak)
A VERSENY MENETE:
⏰7.00-7.15 gyülekező
⏰7.15-7.30 sorsolás (2 lépésben fog zajlani! Első körben érkezési sorrendben kihúzzátok a húzási sorrendet, majd ebben a sorrendben kihúzzátok az állásokat, ahova ülni fogtok.)
⏰7.30-8.30 helyek elfoglalása, előkészületek, limitellenőrzés
⏰8.30-14.30 verseny (dudaszó)
⏰14.30-tól mérlegelés, eredményhirdetés
A verseny végén mindenki vendégünk egy finom ebédre!🥘
Eredményhirdetés után sötétedésig lehet maradni horgászni.'
        ]);


        \App\Models\Jelentkez::factory(20)->create();


    }

}
