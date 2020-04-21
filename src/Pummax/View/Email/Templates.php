<?php


namespace Pummax\View\Email;


use Pummax\Configuration\DataBase;

class Templates
{
    public static function criacaoConta($usuario, $sistema, $senha, $urlSite)
    {
        return '<table style=\"width:100%;border-spacing:0;border-collapse:collapse;vertical-align:top;text-align:inherit;margin:0 auto;padding:0\">
            <tbody>
            <tr>
                <td style=\"padding:20px;color:#555;line-height:25px;font-size:16px\">
                    <p>
                        <div  style="text-align: center">
                            Olá <b>'.$usuario.'</b>, seja muito bem-vindo(a)!
                            <br>
                            <br>
                            <span>Sua conta em: '.$sistema.' foi criada com a senha: '.$senha.'</span>
                            <br>
                            <br>
                        </div>
                    </p>
                    <div style="text-align: center">
                        <a href="'.$urlSite.'" style=\"padding:10px;display:block;border-radius:6px;background:#1e9ed0;color:#fff;text-decoration:none;font-size:24px; width: 285px;\" target=\"_blank\">ACESSAR <span class=\"m_9139932422997049828il\">SISTEMA</span></a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            </tbody>
        </table>
        <center>
            <h2>Atenciosamente equipe '.$sistema.'</h2>
            <span style=\"padding:20px;color:#555;line-height:25px;font-size:16px\">Não responda este e-mail</span>
        </center>';
    }
}