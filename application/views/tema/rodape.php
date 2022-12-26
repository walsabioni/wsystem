<div class="row-fluid">
    <div id="footer" class="span12"> <a class="pecolor" href="https://instagram.com/wal.sabioni" target="_blank">
            <?= date('Y'); ?> &copy; W. Sabioni - WSYSTEM - Versão:
      <?= $this->config->item('app_version'); ?></a></div>
</div>
<!--end-Footer-part-->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/matrix.js"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        var dataTableEnabled = '<?php echo $configuration['control_datatable']; ?>';
        if(dataTableEnabled == '1') {
            $('#tabela').dataTable( {
                "ordering": false,
                "language": {
                    "url": "<?= base_url(); ?>assets/js/dataTable_pt-br.json"
                }
            } );
        }
    } );
</script>
</html>
