<?php

namespace App\Http\Controllers\Api;

use App\Models\Bag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $client = new \GuzzleHttp\Client;

        try {
            $res = $client->post('shoplocal_nginx_1/oauth/token' , [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 1,
                    'client_secret' => 'hfaicJUAyO6kJIR0YDuEsJS5blHdaGKvB0Ymy4nw',
                    'username' => $request->get('username'),
                    'password' => $request->get('password'),
                    'scope' => ''
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            return $this->json($exception->getMessage(), $exception->getCode());
        }

        return $this->json(json_decode((string) $res->getBody(), true));
    }

    public function me (Request $request)
    {
        return $this->json($request->user());
    }

    public function addingToBag (Request $request)
    {
        $item = $request->user()
            ->bag()
            ->create([
                'product_id' => $request->get('product_id'),
                'num' => $request->get('num'),
            ]);

        return $this->json(Bag::find($item->id));
    }
}
