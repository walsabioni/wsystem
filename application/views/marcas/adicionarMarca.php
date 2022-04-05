<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-wrench"></i>
                </span>
                <h5>Cadastro de Marcas</h5>
            </div>
            <div class="widget-content nopadding tab-content">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formMarca" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label for="marca" class="control-label">Marca<span class="required">*</span></label>
                        <div class="controls">
                            <input id="marca" type="text" name="marca" value="<?php echo set_value('marca'); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="cadastro" class="control-label">Cadastro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cadastro" type="date" name="cadastro" value="<?php echo set_value('cadastro'); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="situacao" class="control-label">Situação</label>
                        <div class="controls">
                            <select id="situacao" type="text" name="situacao">
                                <option value="1">Ativado</option>
                                <option value="0" <?php echo set_value('situacao') == 0 ? 'selected' : ''?>>Desativado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3" style="display:flex;justify-content: center">
                                <button type="submit" class="button btn btn-mini btn-success" style="max-width: 160px">
                                    <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Adicionar</span></a></button>
                                <a href="<?php echo base_url() ?>index.php/marcas" id="btnAdicionar" class="button btn btn-mini btn-warning" style="max-width: 160px">
                                    <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#formMarca').validate({
            rules: {
                marca: {
                    required: true
                },
                cadastro: {
                    required: true
                }
            },
            messages: {
                marca: {
                    required: 'Campo Requerido.'
                },
                cadastro: {
                    required: 'Campo Requerido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>