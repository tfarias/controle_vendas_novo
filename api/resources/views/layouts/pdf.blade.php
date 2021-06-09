<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('sistema.titulo') }}</title>

</head>
<body>

<table cellspacing="0" cellpadding="0" class="sem-borda" width="100%">
    <tbody>
    <tr>
        <td style="display: inline-block;" class="header">
            <img src="https://images.tcdn.com.br/static_inst/site/vendedor/tray-cdn/uploads/logo-header.svg" class="logo" alt="Try Logo">
        </td>
    </tr>
    </tbody>
</table>

<div class="row">
    @yield('conteudo')
</div>
</body>
</html>
