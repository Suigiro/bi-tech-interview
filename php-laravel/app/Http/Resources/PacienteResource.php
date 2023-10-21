<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'nome'  => $this->nome,
            'cpf'   => $this->cpf,
            'rg'  => $this->rg,
            'data_nasc' => $this->data_nasc,
            'sexo' => $this->sexo,
            'email' => $this->email,
            'celular'=> $this->celular,
            'descricao'=> $this->descricao,
        ];
    }
}
