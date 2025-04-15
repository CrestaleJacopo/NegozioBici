<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Negozio extends Model
{
    // Se il tuo model non ha tabella specifica collegata, puoi anche evitare $table

    public function getArticoli()
    {
        return DB::table('articoli')
            ->orderBy('id')
            ->get();
    }

    public function getOrdini($nomeCliente)
    {
        return DB::table('ordini')
            ->join('articoli', 'ordini.idArticolo', '=', 'articoli.id')
            ->select('ordini.id as idOrdine', 'nomeCliente', 'idArticolo', 'articoli.nome', 'ordini.prezzo', 'dataOra')
            ->where('nomeCliente', $nomeCliente)
            ->orderBy('ordini.id')
            ->get();
    }

    
    public function getArticolo($id)
    {
        return DB::table('articoli')->where('id', $id)->first();
    }

    public function getUtente($nome, $password)
    {
        return DB::table('utenti')
            ->where('nome', $nome)
            ->where('password', $password)
            ->first();
    }

    public function getPassword($nome, $email)
    {
        return DB::table('utenti')
            ->where('nome', $nome)
            ->where('email', $email)
            ->first();
    }

    private function random($lunghezza)
    {
        $caratteri = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $stringa = '';
        for ($i = 0; $i < $lunghezza; $i++) {
            $stringa .= $caratteri[rand(0, strlen($caratteri) - 1)];
        }
        return $stringa;
    }

    public function generaNuovaPassword($nome, $email, $hash)
    {
        $messaggio = '';
        $nuovaPassword = $this->random(8);
        $nuovoHash = md5($nuovaPassword);

        $affected = DB::table('utenti')
            ->where('nome', $nome)
            ->where('email', $email)
            ->where('hash', $hash)
            ->update([
                'password' => $nuovaPassword,
                'hash' => $nuovoHash
            ]);

        if ($affected === 0) {
            $messaggio = 'ERRORE: utente non trovato!';
        } else {
            $messaggio = "La nuova password è " . $nuovaPassword;
        }

        return $messaggio;
    }

    public function inserisciOrdine($nomeCliente, $carrello)
    {
        $messaggioDiErrore = null;

        DB::beginTransaction();

        try {
            foreach ($carrello as $merce) {
                DB::table('ordini')->insert([
                    'nomeCliente' => $nomeCliente,
                    'idArticolo' => $merce->id,
                    'prezzo' => $merce->prezzo,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $messaggioDiErrore = $e->getMessage();
        }

        return $messaggioDiErrore;
    }

    public function inserisciUtente($nome, $password, $ruolo, $email)
    {
        try {
            DB::table('utenti')->insert([
                'nome' => $nome,
                'password' => $password,
                'ruolo' => $ruolo,
                'email' => $email,
            ]);
            return null;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function confermaUtente($nome)
    {
        try {
            DB::table('utenti')
                ->where('nome', $nome)
                ->update(['confermato' => 'si']);
            return null;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
