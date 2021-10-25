<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function stacking_pool(){
        return view('stacking_pool.index');
    }

    public function stackpool(){
        return view('stacking_pool.stackpool');
    }

     public function node_register(){
        return view('accounts.register');
    }

     public function node_management(){
        return view('accounts.network');
    }

     public function crypto_wallets(){
        return view('crypto_wallet.index');
    }

     public function yield_wallet(){
        return view('yield_wallet.index');
    }

     public function commission_wallet(){
        return view('commission_wallet.index');
    }


     public function nft_wallet(){
        return view('nft_wallet.index');
    }

    public function withdrawal(){
        return view('withdrawal.index');
    }

    public function nft_marketplace(){
        return view('nft_marketplace.index');
    }

    public function ledger(){
        return view('reports.index');
    }

    public function account(){
        return view('profile.profile');
    }


    public function my_collection(){
        return view('profile.my_collection');
    }

     public function help_support(){
        return view('help_support.index');
    }

    public function nftproduct(){
        return view('nft_marketplace.product');
    }

    public function sell_nft(){
        return view('nft_marketplace.sell_nft');
    }
}
