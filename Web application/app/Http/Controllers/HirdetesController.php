<?php

namespace App\Http\Controllers;

use App\Models\hirdetes;
use App\Models\Jelentkez;
use App\Models\Jelentkezs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Support\Facades\Auth;

class HirdetesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $hirdetesek = DB::select("SELECT hirdetes.id AS 'hirdetesId', userid, helyszineks.nev, versenynev, tipus, leiras, rovidleiras, kep
                                                FROM `hirdetes` inner join helyszineks on helyszineks.id = helyszinid;");

        return view('Hirdetes.index')->with('hirdetes', $hirdetesek);


      /*  $hirdetesek = hirdetes::all();*/

      /* $hirdetesek =  Hirdetes::Select('*')
            ->join('helyszineks', 'helyszineks.id', '=', 'hirdetes.helyszinid')
            ->get();*/




    }
    public function indexPrivate()
    {
        $hirdetesek = DB::select("SELECT hirdetes.id AS 'hirdetesId', userid,  helyszineks.nev, versenynev, tipus, leiras, rovidleiras, kep
                                                FROM `hirdetes` inner join helyszineks on helyszineks.id = helyszinid;");
        return view('Hirdetes.indexPrivate')->with('hirdetes', $hirdetesek);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $helyszinek = DB::select("SELECT * FROM `helyszineks`");

        return view('Hirdetes.create')->with('helyszinek', $helyszinek);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(

            [
                'versenynev'=>'required|string|min:3|unique:hirdetes,versenynev',
                'tipus'=>'required',
                'helyszinid'=>'required',
                'idopont'=>'required',
                'rovidleiras'=> 'required|string|min:20|max:200',
                'leiras'=> 'required|string|min:100|max:4000',
                'szabalyzat'=> 'required|string|min:100|max:4500',

            ],[
                'versenynev.required' => 'A cím megadása kötelező!',
                'versenynev.string' => 'Csak szöveg fogadhato el.',
                'versenynev.min' => 'Legalább két karakter szükséges.',
                'versenynev.unique' => 'Ez a versenynév már foglalt!',
                'tipus.required' => 'A típus megadása kötelező!',
                'helyszinid.required' => 'Helyszín megadása kötelező!',
                'idopont.required' => 'Időpont megadása kötelező!',
                'rovidleiras.required' => 'Rövid leírás megadása kötelező!',
                'rovidleiras.string' => 'Kérem szöveget írjon be!',
                'rovidleiras.min' => 'Legalább 20 karakter szükséges!',
                'rovidleiras.max' => 'Maximum 150 karakter lehet!',
                'leiras.required' => 'Hosszú leírás megadása kötelező!',
                'leiras.string' => 'Kérem szöveget írjon be!',
                'leiras.min' => 'Legalább 100 karakter szükséges!',
                'leiras.max' => 'Maximum 4000 karakter lehet!',
                'szabalyzat.required' => 'Szabályzat megadása kötelező!',
                'szabalyzat.string' => 'Kérem szöveget írjon be!',
                'szabalyzat.min' => 'Legalább 100 karakter szükséges!',
                'szabalyzat.max' => 'Maximum 4500 karakter lehet!',
            ]

        );
        $hirdetes = new Hirdetes($validated);
        $hirdetes->userid = Auth::id();
        $hirdetes->helyszinid = $request->helyszinid;
        $hirdetes->tipus = $request->tipus;
        $hirdetes->save();

        return back()->with('success','Sikeres Feltöltés!');




    }
//    public function jelentkez()
//    {
//
//        return view('Hirdetes.jelentkez');
//    }
    public function jelentkezesStore(Request $request)
    {

        $validated = $request->validate(
            [
                'nev'=>'required|string|min:3',
                'telefonszam'=>'required|string|min:11|max:12',
                'email' => 'required|string|email|max:255',
                'hirdetId' => 'required'
            ],[
                'nev.required' => 'A cím megadása kötelező!',
                'nev.string' => 'Csak szöveg fogadhato el.',
                'nev.min' => 'Legalább két karakter szükséges.',
                'nev.required' => 'A típus megadása kötelező!',

                'telefonszam.required' => 'Helyszín megadása kötelező!',
                'telefonszam.required' => 'Minimum 11 karakter megadasa szükséges!',
                'telefonszam.required' => 'Maximum 12 karaktert lehet megadni!',

                'email.required' => 'Email megadása kötelező!',
                'email.string' => 'Email helytelen formátuma!',

            ]
        );
        $jelentkez = new Jelentkez($validated);
        $jelentkez->hirdetId = $request->hirdetId;
        $jelentkez->save();
        return back()->with('success','Sikeres Jelentkezés!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hirdetes  $hirdete
     * @return \Illuminate\Http\Response
     */
    public function show($IdHirdetes)
    {
        $id = $IdHirdetes;
        $adat = DB::select("SELECT hirdetes.id AS 'hirdetesId', helyszineks.nev, helyszineks.helyszin, versenynev, tipus, leiras, szabalyzat, idopont, rovidleiras, kep, users.lastname, users.firstname FROM `hirdetes`
    inner join helyszineks on helyszineks.id = helyszinid inner join users on hirdetes.userid = users.id Where hirdetes.id = $id ;");


        return view('Hirdetes.show', ['hirdet' => $adat]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hirdetes  $hirdetes
     * @return \Illuminate\Http\Response
     */
    public function edit($IdHirdetes)
    {

        $id = $IdHirdetes;
        $adat = DB::select("
        SELECT hirdetes.id AS 'hirdetesId', helyszineks.nev, helyszineks.helyszin, versenynev,
        tipus, leiras, szabalyzat, idopont, rovidleiras, kep, users.lastname, users.firstname
        FROM `hirdetes`
        inner join helyszineks on helyszineks.id = helyszinid inner join users on hirdetes.userid = users.id Where hirdetes.id =  $id;");

        $helyszinek = DB::select("SELECT * FROM `helyszineks`");


        return view('Hirdetes.edit', ['hirdet' => $adat], ['helyszinek'=> $helyszinek] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hirdetes  $hirdetes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hirdetes $IdHirdetes)
    {
//ha átadta az osszes adatot az idhirdetessel nemtudom hogyan meg miert de mukodik :)

        $validated = $request->validate(
            [
                'versenynev'=>'required|string|min:3|unique:hirdetes,versenynev',
                'tipus'=>'required',
                'helyszinid'=>'required',
                'idopont'=>'required',
                'rovidleiras'=> 'required|string|min:20|max:150',
                'leiras'=> 'required|string|min:100|max:4000',
                'szabalyzat'=> 'required|string|min:100|max:4500',

            ],[
                'versenynev.required' => 'A cím megadása kötelező!',
                'versenynev.string' => 'Csak szöveg fogadhato el.',
                'versenynev.min' => 'Legalább két karakter szükséges.',
                'versenynev.unique' => 'Ez a versenynév már foglalt!',
                'tipus.required' => 'A típus megadása kötelező!',
                'helyszinid.required' => 'Helyszín megadása kötelező!',
                'idopont.required' => 'Időpont megadása kötelező!',
                'rovidleiras.required' => 'Rövid leírás megadása kötelező!',
                'rovidleiras.string' => 'Kérem szöveget írjon be!',
                'rovidleiras.min' => 'Legalább 20 karakter szükséges!',
                'rovidleiras.max' => 'Maximum 150 karakter lehet!',
                'leiras.required' => 'Hosszú leírás megadása kötelező!',
                'leiras.string' => 'Kérem szöveget írjon be!',
                'leiras.min' => 'Legalább 100 karakter szükséges!',
                'leiras.max' => 'Maximum 4000 karakter lehet!',
                'szabalyzat.required' => 'Szabályzat megadása kötelező!',
                'szabalyzat.string' => 'Kérem szöveget írjon be!',
                'szabalyzat.min' => 'Legalább 100 karakter szükséges!',
                'szabalyzat.max' => 'Maximum 4500 karakter lehet!',
            ]
        );
        $IdHirdetes->userid = Auth::id();
        $IdHirdetes->helyszinid = $request->helyszinid;
        $IdHirdetes->tipus = $request->tipus;

        $IdHirdetes->update($validated);

        return back()->with('success',  ' Sikeres frissítés');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hirdetes  $hirdetes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hirdetes $hirdetes, $IdHirdetes)
    {
        DB::table('hirdetes')->where('id',$IdHirdetes)->delete();
        return back()->with('success', 'Sikeres Törlés!');

    }
    public function listing($IdHirdetes){

        $id = $IdHirdetes;
        $adat = DB::select("SELECT jelentkezs.id, hirdetes.versenynev as versenynev, hirdetes.idopont as datum, helyszineks.nev as lokacio, tipus, jelentkezs.nev as jelentkezoneve, telefonszam, email FROM `jelentkezs`
INNER join hirdetes on hirdetes.id = jelentkezs.hirdetId
INNER JOIN helyszineks on helyszineks.id = hirdetes.helyszinid
where hirdetId = $id");


        return view('Hirdetes.listing', ['adatok' => $adat]);
    }
    public function destroylist($Id)
    {
        DB::table('jelentkezs')->where('id',$Id)->delete();
        return back()->with('success', 'Sikeres Törlés!');
    }
}
