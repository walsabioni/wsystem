<div class="new122">
    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aEquipamento')) { ?>
    <a href="<?php echo base_url() ?>index.php/equipamentos/adicionar" class="button btn btn-mini btn-success" style="max-width: 160px">
      <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Add. Equipamento</span></a>
<?php } ?>

<div class="widget-box">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-wrench"></i>
        </span>
        <h5>Equipamento</h5>
    </div>
    <div class="widget-content nopadding tab-content">
        <table id="tabela" class="table table-bordered ">
            <thead>
                <tr>
                    <th>Cod.</th>
                    <th>Marca</th>
                    <th>Equipamento</th>
                    <th>Num. Serie</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Descrição</th>
                    <th>Tensão</th>
                    <th>Potencia</th>
                    <th>Voltagem</th>
                    <th>Data Fabricação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!$results) {
                        echo '<tr>
                                <td colspan="12">Nenhuma Equipamento Cadastrado</td>
                              </tr>';
                    }
                    foreach ($results as $r) {
                        echo '<tr>';
                        echo '<td>' . $r->idEquipamentos . '</td>';
                        echo '<td>' . $r->marcas_id . '</td>';
                        echo '<td>' . $r->equipamento . '</td>';
                        echo '<td>' . $r->num_serie . '</td>';
                        echo '<td>' . $r->modelo . '</td>';
                        echo '<td>' . $r->cor . '</td>';
                        echo '<td>' . $r->descricao . '</td>';
                        echo '<td>' . $r->tensao . '</td>';
                        echo '<td>' . $r->potencia . '</td>';
                        echo '<td>' . $r->voltagem . '</td>';                        
                        echo '<td>' . date(('d/m/Y'), strtotime($r->data_fabricacao)) . '</td>';                        
                        echo '<td>';
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eEquipamento')) {
                            echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/equipamentos/editar/' . $r->idEquipamentos . '" class="btn-nwe3" title="Editar Equipamento"><i class="bx bx-edit bx-xs"></i></a>';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dEquipamento')) {
                            echo '<a href="#modal-excluir" role="button" data-toggle="modal" equipamento="' . $r->idEquipamentos . '" class="btn-nwe4" title="Excluir Equipamento"><i class="bx bx-trash-alt bx-xs"></i></a>  ';
                        }
                        echo '</td>';
                        echo '</tr>';
                    } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php echo $this->pagination->create_links(); ?>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/equipamentos/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Equipamento</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idEquipamentos" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este equipamento?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
          <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
          <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', 'a', function(event) {
            var equipamento = $(this).attr('equipamento');
            $('#idEquipamentos').val(equipamento);
        });
    });
</script>
