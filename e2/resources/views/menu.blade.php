<!DOCTYPE html>
<html lang="pt-BR">
    <script src="{{ asset('js/api/menu.js') }}"></script>
<body>
<div class="col-md-3">
    <div class="wrapper d-flex align-items-stretch" style="float: right">
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url({{ asset('img/logo.jpg') }})"></a>
                <ul class="list-unstyled components mb-5">
                <!--<li class="active">
                        <a href="#">Dashboard</a>
                </li>-->	
                <li>
                    <a href="{{ Route('comunicado') }}">Comunicado de tratamento</a>
                </li>
                <li>
                    <!--<a href="#certSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Certificados</a>
                    <ul class="collapse list-unstyled" id="certSubmenu">
                        <li>
                            <a href="#">Certificado Fosfina</a>
                        </li>-->
                        <li>
                            <a href="{{ Route('certificado') }}">Certificado</a>
                        </li>
                        <li>
                            <a href="{{ Route('consolidado') }}">Consolidado</a>
                        </li>
                    <!--</ul>
                </li>-->
                
                <li>
                    <a href="#cadSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Cadastros</a>
                    <ul class="collapse list-unstyled" id="cadSubmenu">
                        <li>
                            <a href="{{ Route('empresa') }}">Empresas</a>
                        </li>
                        <li>
                            <a href="{{ Route('fornecedor') }}">Estufas</a>
                        </li>
                        <li>
                            <a href="{{ Route('engenheiro') }}">Engenheiros</a>
                        </li>
                        <li>
                            <a href="{{ Route('usuarios') }}">Usuários</a>
                        </li>
                    </ul>
                    </li>
                    
                    <li style="text-align: center;">
                        <a href="{{ Route('logout') }}" style="background-color: red">Sair</a>
                    </li>
                </ul>

                <div class="footer justify-content-center" style="text-align: center">
                    <img src="{{ asset('img/logo_biosweb.png') }}" alt="Logo Biosweb" style="max-width: 80px">
                    <p>Suporte: <i class="fa fa-whatsapp" aria-hidden="true"> (35)99194-1143</i></p>
                    
                </div>
            </div>
        </nav>
    </div>
</div>
</body>
</html>