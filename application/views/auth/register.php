<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Criar conta</h3></div>
                            <div class="card-body">
                                <?= $this->session->flashdata('error'); ?>
                                <form id="formRegister" method="post" action="<?= base_url('login/register_pro')?>">
                                    <h5>Dados pessoais</h5>
                                    <hr/>
                                    <div class="form-group">
                                        <label class="small mb-1" for="nome">Nome*</label>
                                        <input class="form-control" id="nome" name="nome" type="text" placeholder="Nome completo" />
                                    </div>

                                    <div class="form-group" id="CPF-valid">
                                        <label class="small mb-1" for="CPF">CPF*</label>
                                        <input class="form-control" id="CPF" name="CPF" type="text" placeholder="###.###.###-##" onchange="verificaCPF(this.value)" />
                                        <span id="CPF-error2" class="text-danger" style="display: none">CPF já cadastrado.</span>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-8">
                                            <div class="form-group" id="email-valid">
                                                <label class="small mb-1" for="email">Email*</label>
                                                <input class="form-control" id="email" name="email" type="email" placeholder="exemplo@exemplo.com.br" onchange="verificaEmail(this.value)"/>
                                                <span id="email-error2" class="text-danger" style="display: none">E-mail já cadastrado.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="telefone">Telefone</label>
                                                <input class="form-control" id="telefone" name="telefone" type="text" placeholder="## # ####-####" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Senha*</label>
                                                <input class="form-control" id="password" name="password" type="password" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="password2">Confirmar senha*</label>
                                                <input class="form-control" id="password2" name="password2" type="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <h5>Endereço</h5>
                                    <hr/>
                                    <div class="form-row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="small mb-1" for="logradouro">Logradouro*</label>
                                                <input class="form-control" id="logradouro" name="logradouro" type="text" placeholder="Rua Santos Dumont"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="numero">Número*</label>
                                                <input class="form-control" id="numero" name="numero" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label class="small mb-1" for="bairro">Bairro*</label>
                                                <input class="form-control" id="bairro" name="bairro" type="text"/>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="small mb-1" for="complemento">Complemento</label>
                                                <input class="form-control" id="complemento" name="complemento" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="small mb-1" for="cidade">Cidade*</label>
                                                <input class="form-control" id="cidade" name="cidade" type="text"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="UF">UF*</label>
                                                <select class="form-control" id="UF" name="UF">
                                                    <option value="AC">Acre</option>
                                                    <option value="AL">Alagoas</option>
                                                    <option value="AP">Amapá</option>
                                                    <option value="AM">Amazonas</option>
                                                    <option value="BA">Bahia</option>
                                                    <option value="CE">Ceará</option>
                                                    <option value="DF">Distrito Federal</option>
                                                    <option value="ES">Espírito Santo</option>
                                                    <option value="GO">Goiás</option>
                                                    <option value="MA">Maranhão</option>
                                                    <option value="MT">Mato Grosso</option>
                                                    <option value="MS">Mato Grosso do Sul</option>
                                                    <option value="MG">Minas Gerais</option>
                                                    <option value="PA">Pará</option>
                                                    <option value="PB">Paraíba</option>
                                                    <option value="PR">Paraná</option>
                                                    <option value="PE">Pernambuco</option>
                                                    <option value="PI">Piauí</option>
                                                    <option value="RJ">Rio de Janeiro</option>
                                                    <option value="RN">Rio Grande do Norte</option>
                                                    <option value="RS">Rio Grande do Sul</option>
                                                    <option value="RO">Rondônia</option>
                                                    <option value="RR">Roraima</option>
                                                    <option value="SC">Santa Catarina</option>
                                                    <option value="SP">São Paulo</option>
                                                    <option value="SE">Sergipe</option>
                                                    <option value="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small mb-1" for="CEP">CEP*</label>
                                                <input class="form-control" id="CEP" name="CEP" type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" id="btn-criarUsuario">Criar usuário</button></div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="<?= base_url('login') ?>">Já possui conta? Logar</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#usuario').focus();
        $("#formRegister").validate({
            rules: {
                usuario: {
                    required: true
                },
                password: {
                    required: true,
                    equalTo : '[name="password2"]',
                    minlength: 6,
                    maxlength: 16
                },
                password2: {
                    required: true,
                    equalTo : '[name="password"]',
                    minlength: 6,
                    maxlength: 16
                },
                nome: {
                    required: true
                },
                CPF: {
                    required: true,
                    cpf: true
                },
                email: {
                    required: true,
                    email: true
                },
                logradouro: {
                    required: true
                },
                numero: {
                    required: true
                },
                bairro: {
                    required: true
                },
                cidade: {
                    required: true
                },
                UF: {
                    required: true
                },
                CEP: {
                    required: true
                }
            },
            messages: {
                usuario: {
                    required: 'Obrigatório'
                },
                password: {
                    required: 'Obrigatório',
                    equalTo : 'As senhas não coicidem',
                    minlength: 'A senha deve ter entre 6 e 16 caracteres',
                    maxlength: 'A senha deve ter entre 6 e 16 caracteres'
                },
                password2: {
                    required: 'Obrigatório',
                    equalTo : 'As senhas não coicidem',
                    minlength: 'A senha deve ter entre 6 e 16 caracteres',
                    maxlength: 'A senha deve ter entre 6 e 16 caracteres'
                },
                nome: {
                    required: 'Obrigatório'
                },
                CPF: {
                    required: 'Obrigatório',
                    cpf: 'CPF inválido'
                },
                email: {
                    required: 'Obrigatório',
                    email: true
                },
                logradouro: {
                    required: 'Obrigatório'
                },
                numero: {
                    required: 'Obrigatório, utilize S/N'
                },
                bairro: {
                    required: 'Obrigatório'
                },
                cidade: {
                    required: 'Obrigatório'
                },
                UF: {
                    required: 'Obrigatório'
                },
                CEP: {
                    required: 'Obrigatório'
                }
            },
            submitHandler: function(form) {
                form.submit();
            },
            errorClass: "text-danger",
            errorElement: "span"
        });

    });

    $('#telefone').mask("(99) 9 9999-999?9")
    .focusout(function (event) {  
        var target, phone, element;  
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
        phone = target.value.replace(/\D/g, '');
        element = $(target);  
        element.unmask();  
        if(phone.length > 10) {  
            element.mask("(99) 9 9999-999?9");  
        } else {  
            element.mask("(99) 9999-9999?9");  
        }
    });
    $('#CPF').mask('999.999.999-99');
    $('#CEP').mask('99.999-999');
    jQuery.validator.addMethod("cpf", function(value, element) {
        $('#CPF-error2').remove();
        value = jQuery.trim(value);

        value = value.replace('.','');
        value = value.replace('.','');
        cpf = value.replace('-','');
        while(cpf.length < 11) cpf = "0"+ cpf;
        var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
        var a = [];
        var b = new Number;
        var c = 11;
        for (i=0; i<11; i++){
            a[i] = cpf.charAt(i);
            if (i < 9) b += (a[i] * --c);
        }
        if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
            b = 0;
        c = 11;
        for (y=0; y<10; y++) b += (a[y] * c--);
            if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

        var retorno = true;
        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

        return this.optional(element) || retorno;

    }, "Informe um CPF válido");

    
    function verificaCPF(strCPF) {
        $('#CPF-error2').remove();
        nrCPF = strCPF.replace(/\D+/g, '');
        $.ajax({
            url: '<?= base_url("login/check_cpf") ?>',
            type: "post",
            dataType: 'json',
            data: {
                "cpf" : nrCPF
            },
            success: function(msg) {
                if (msg.return == true) {
                    $('#CPF').val('');
                    $('#CPF-valid').append("<span id='CPF-error2' class='text-danger'>CPF já cadastrado.</span>");
                }   
            }
        });
        return;
    }

    function verificaEmail(email) {
        $('#email-error2').remove();
        $.ajax({
            url: '<?= base_url("login/check_email") ?>',
            type: "post",
            dataType: 'json',
            data: {
                "email" : email
            },
            success: function(msg) {
                if (msg.return == true) {
                    $('#email').val('');
                    $('#email-valid').append("<span id='email-error2' class='text-danger'>E-mail já cadastrado.</span>");
                }   
            }
        });
        return;
    }
</script>