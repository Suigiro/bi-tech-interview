<?php

namespace App\Http\Controllers;

use App\Http\Resources\PacienteResource;
use App\Models\Pacientes;
use Illuminate\Http\Request;
use Validator;


class PacientesController extends BaseApiController
{
    public function index()
    {
       try {

            $pacientes = Pacientes::all();

            return $this->sendResponse(PacienteResource::collection($pacientes), 'Lista de Pacientes');

       } catch (Exception $e) {
            return $this->sendError('Erro ao carregar pacientes', $e);
       }
    }

    public function show($id)
    {
        try {

        $paciente = Pacientes::find($id);

        return $this->sendResponse(new PacienteResource($paciente), 'Paciente encontrado');

        } catch (Exception $e) {

            return $this->sendError('Erro ao carregar pacientes', $e);
       }
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'nome' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'sexo' => 'required',
                'data_nasc' => 'required',
                'celular' => 'required',
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $paciente = Pacientes::create($input);

            return $this->sendResponse(new PacienteResource($paciente), 'Paciente cadastrado com sucesso');

        } catch (Exception $e) {

            return $this->sendError('Erro ao cadastrar usuario', $e);
       }
    }

    public function update($id, Request $request)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'nome' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'sexo' => 'required',
                'data_nasc' => 'required',
                'celular' => 'required',
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $paciente = Pacientes::find($id);

            $paciente->nome         = ($paciente->nome==$input['nome'])?$paciente->nome:$input['nome'];
            $paciente->cpf          = ($paciente->cpf==$input['cpf'])?$paciente->cpf:$input['cpf'];
            $paciente->rg           = ($paciente->rg==$input['rg'])?$paciente->rg:$input['rg'];
            $paciente->sexo         = ($paciente->sexo==$input['sexo'])?$paciente->sexo:$input['sexo'];
            $paciente->data_nasc    = ($paciente->data_nasc==$input['data_nasc'])?$paciente->data_nasc:$input['data_nasc'];
            $paciente->email        = ($paciente->email==$input['email'])?$paciente->email:$input['email'];
            $paciente->celular      = ($paciente->celular==$input['celular'])?$paciente->celular:$input['celular'];
            $paciente->descricao    = ($paciente->descricao==$input['descricao'])?$paciente->descricao:$input['descricao'];

            $paciente->save();

            return $this->sendResponse(new PacienteResource($paciente), 'Paciente atualizado com sucesso');

        } catch (Exception $e) {

            return $this->sendError('Erro ao atualizado paciente', $e);
       }
    }

    public function destroy($id)
    {
        try {
            $paciente = Pacientes::find($id);
            $paciente->delete();

            return $this->sendResponse([], 'Paciente excluido com sucesso');
        } catch (Exception $e) {
            return $this->sendError('Erro ao excluir paciente', $e);
        }
    }

    public function totalPacientes(){
        try {

            $total = Pacientes::count();
            return $this->sendResponse($total, 'Total de Registros');

       } catch (Exception $e) {
            return $this->sendError('Erro ao carregar itens', $e);
       }

    }
}
