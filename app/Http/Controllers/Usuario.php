<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UsuarioModel;
use App\Models\AvaliacaoUsuario;

class Usuario extends Controller
{

    public function index()
    {
        $usuario = auth()->user(); // Obtém o usuário autenticado
    
        // Calcula a média usando o método na model
        $mediaNota = $usuario->mediaAvaliacoes();
    
        // Obtém as avaliações recebidas
        $avaliacoes = $usuario->avaliacoesRecebidas()->with('avaliador')->get();
    
        return view('usuario.index', compact('usuario', 'mediaNota', 'avaliacoes'));
    }
       
    
    public function create(){
        return view('Usuario.create');
    }

    public function store(Request $request){
        $status = UsuarioModel::salvar($request);

        if ($status){
            return redirect()->back()->with('mensagem', 'Usuário cadastrado com sucesso!');
        }
        else {
            return redirect()->back()->with('mensagem', 'Erro ao cadastrar o usuário. Tente novamente!');
        }
    }

    // public function index(){
    //     $usuarios = UsuarioModel::listar();
    //     return view('Usuario.index', compact('usuarios'));
    // }

    public function destroy($id){
        $status = UsuarioModel::deletar($id);
        if($status) {
            return redirect('listarUsuario')->with('mensagem', 'Usuário deletado com sucesso!');
        }
        else {
            return redirect('listarUsuario')->with('mensagem', 'Usuário não encontrado');
        }
    }

    public function edit($id){
        $usuario = UsuarioModel::consultar($id);
        return view('Usuario.edit', compact('usuario'));
    }

    public function update(Request $request, $id){
        // Validação dos dados do usuário, se necessário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'senha' => 'nullable|string|min:6',
            'telefone' => 'nullable|string|max:15',
        ]);

        // Encontrar o usuário pelo ID
        $usuario = UsuarioModel::consultar($id);

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        // Atualizar os dados do usuário
        $status = DB::table('usuario')->where('id', $id)->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha,
            'telefone' => $request->telefone,
        ]);

        if($status) {
            return redirect()->route('listarUsuario')
            ->with('success', 'Usuário atualizado com sucesso!');
        } else {
            return redirect()->back()
            ->with('error', 'Erro ao atualizar o usuário');
        }

        

    }


}
