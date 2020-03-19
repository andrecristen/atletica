<?php


namespace View\Admin;


use Pummax\View\BaseFormView;

class UsuarioForm extends BaseFormView
{
    public function createHtml()
    {
        $botao = '';
        $senhas = '';
        if (!$this->getisView()) {
            $botao = '<button class="btn btn-lg btn-primary btn-block" type ="submit">Gravar</button>';
            $senhas =
            '<div class="form-group">
                <label for="exampleFormControlTextarea1">Senha</label>
                <input minlength="6" type="password" class="form-control" name="senha" required>
             </div>
             <div class="form-group">
                <label for="exampleFormControlTextarea1">Confirmar Senha</label>
                <input minlength="6" type="password" class="form-control" name="confirmarSenha" required>
            </div>
             ';
        }
        return '
        <script src="utils/js/editor.js"></script>
        <form action="' . $this->getRouter() . '" method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">#</label>
                <input readonly="readonly" type="text" class="form-control" name="id" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Login</label>
                <input type="email" class="form-control" name="login" required>
            </div>
            ' . $senhas . '
            ' . $botao . '
        </form>';
    }
}