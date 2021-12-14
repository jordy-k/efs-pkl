<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('assets/') ?>js/zjs.utils.js"></script>
<script src="<?= base_url('assets/') ?>js/checkboxes.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script>
	$(document).ready(function () {
      var rows_selected = [];
      var tableInstance = $('#efs_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?= base_url('employee/get_employee_datatables');?>",
            "type": "POST"
        },
        "columns": [
          { "data": "id_arsip" , "className": "clm_0"},
          { "data": "no_berkas" },
          { "data": "keterangan" },
          { "data": "lokasi_penyimpanan" },
          { "data": "no_arsip"},
          { "data": "nama_arsip" },
          { "data": "tgl_arsip" },
          
          { "data": "divisi" },
          { "data": "download" },
          { "data": "edit" }
        ],
        "order": [[ 0, "desc"]],
        "columnDefs": [{
          'targets': [8, 9],
          'searchable': false,
          'orderable': false,
        }],
        "dom":
          "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
          "<'row'<'col-md-12'tr>>" +
          "<'row'<'col-md-5'i><'col-md-7'p>>",
        "buttons": [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
</script>