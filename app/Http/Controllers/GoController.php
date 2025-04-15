<?php

namespace App\Http\Controllers;
use App\Models\Negozio;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class GoController extends Controller
{
    // Homepage
    public function home()
    {
        return view('home');
    }

    // Authentication
    public function login()
    {
        return view('auth.login');
    }

    public function registraUtente(Request $request) {

        // si potrebbe aggiungere la validazione con validator
        try {
            $user = User::create([
                'name' => $request->input('nome'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'ruolo' => $request->input('ruolo'),    //il ruolo non viene salvato
            ]);
            return redirect()->back()->with('success', 'Registrazione completata con successo!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Si è verificato un errore durante la registrazione. Riprova più tardi.');
        }
    }

    public function controllaLogin(Request $request) {
        try {
            $credentials = $request->validate([
                'nome' => ['required'],
                'password' => ['required'],
            ]);

            // dd($credentials);
            $result = Auth::attempt(['name' => $credentials['nome'], 'password' => $credentials['password']]);
            if($result ) {
                $request->session()->regenerate();
                return redirect()->intended('/')->with('success', 'Accesso effettuato con successo!');
            }
            else {
                return redirect()->back()->with('error', 'Si è verificato un errore durante la registrazione. Riprova più tardi.');
            }
            //forse bisognerebbe gestire meglio
                        

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Si è verificato un errore durante la registrazione. Riprova più tardi.');
        }
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function logout()
    {
        return redirect()->route('home');
    }

    // Pages
    public function faq()
    {
        return view('faq');
    }

    public function catalogo()
    {
        $negozio = new Negozio();
        $articoli = $negozio->getArticoli();
    
        return view('catalogo', ['articoli' => $articoli]);
    }
    // Orders
    public function mieiOrdini()
    {
        return view('miei-ordini');
    }

    // Admin Area
    public function riservato()
    {
        return view('admin.riservato');
    }

    // Shopping Cart
    public function carrello()
    {
        return view('carrello', ['ordini']);
    }

    public function aggiungiAlCarrello(Request $request)
    {
        // dd($request);
        $id = $request->input('id');
        
        // Retrieve existing cart from session or start a new one
        $carrello = session()->get('carrello', []);

        // If item already in cart, increase quantity
        if (isset($carrello[$id])) {
            $carrello[$id]['quantita'] += 1;
        } else {
            // Otherwise add new item with quantity 1
            $carrello[$id] = [
                'id' => $id,
                'nome' => $request->input('nome'),
                'prezzo' => $request->input('prezzo'),
                'foto' => $request->input('foto'),
                'quantita' => 1
            ];
        }

        // Save the cart back into the session
        session(['carrello' => $carrello]);

        return redirect()->back()->with('success', 'Articolo aggiunto al carrello!');
    }
    
    public function svuotaCarrello(){
        session()->forget('carrello');
        return redirect()->back()->with('success', 'Carrello svuotato con successo!');
    }

    public function dettaglio($id)
    {
        $negozio = new Negozio();
        $articolo = $negozio->getArticolo($id);

        if (!$articolo) {
            abort(404, 'Articolo non trovato');
        }

        return view('dettaglio', ['articolo' => $articolo]);
    }
}
