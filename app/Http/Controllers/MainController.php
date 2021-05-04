<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;


class MainController extends Controller
{
    public function home(){
        return view('home');
    }
    public function create_users(Int $coll_users_flag = 1){
        $user = new UserModel();
            $user->login = 'user'.$coll_users_flag;
            $user->password = $coll_users_flag.'pass'.$coll_users_flag;
            $user->save();
            if ($coll_users_flag<10) $this->create_users($coll_users_flag+1);
        return redirect()->route('/');
    }
    public function users_link_product(Int $user_index, Int $count_prod, Int $count_flag = 1){
        $product = new ProductModel();
        $data_prod = (object)['name' => 'product' . $count_flag, 'price' => rand(100, 3000), 'user_id' => $user_index];
        $product->data_product = json_encode($data_prod);
        $product->user_id = $user_index;
        $product->save();
        if ($count_flag<$count_prod) $this->users_link_product($user_index, $count_prod, $count_flag+1);
    }
    protected function create_products(Int $user_id_flag = 1){
        $count_prod = rand(20,50);
        $this->users_link_product($user_id_flag, $count_prod);
        if ($user_id_flag<10) $this->create_products($user_id_flag+1);
        return redirect()->route('/');
    }
}
