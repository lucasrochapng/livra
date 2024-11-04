<form action="cadastrarCliente" method="post">
@csrf
    <p>{{session('mensagem')}}</p>
    Nome: <input type="text" name="nome">
    CPF: <input type="text" name="cpf">
    Telefone: <input type="text" name="telefone">
    Email: <input type="text" name="email">
    <input type="submit" value="Cadastrar">
</form>
<a href="read">Listar Clientes</a>