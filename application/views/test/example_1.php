<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js">
    </script>
    <script>
        $(document).ready(function () {
            var datatableInstance = $('#datatable').DataTable({
                ajax: {
                    url: "<?= base_url('example/get_ajax'); ?>",
                    type: 'post'
                },
                sort: true,
                searching: true,
                columns: [
                    { 'data': 'id_arsip' },
                    { 'data': 'no_berkas' },
                    { 'data': 'lokasi_penyimpanan' },
                    { 'data': 'no_arsip' },
                    { 'data': 'nama_arsip' },
                    { 'data': 'tgl_diterima' },
                    { 'data': 'keterangan' }
                ]
            });


            $('#datatable thead#searchbox th').each(function () {
                var title = $('#datatable thead#title th').eq($(this).index()).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });
            var i = 1;
            datatableInstance.columns().every(function () {
                var dataTableColumn = this;

                var searchbox = $(this.header()).find('input');

                searchbox.on('keyup change', function () {
                    dataTableColumn.search(this.value).draw();
                });

                searchbox.on('click', function(e) {
                    e.stopPropagation();
                });
                console.log("column "+i+" : "+ this.value + "\n");
                i++;
            });
        });
    </script>
</head>
<body style="font-family: Arial">
    <form id="form1">
        <div style="width: 1700px; border: 1px solid black; padding: 3px">
            <table id="datatable">
                <thead id="searchbox">
                    <tr>
                      <th>ID Link</th>
                      <th>No Berkas</th>
                      <th>Lokasi</th>
                      <th>No Bantek</th>
                      <th>Nama Arsip</th>
                      <th>Tanggal Arsip</th>
                      <th>Keterangan</th>
                    </tr>
                </thead>
                <thead id="title">
                    <tr>
                      <th>ID Link</th>
                      <th>No Berkas</th>
                      <th>Lokasi</th>
                      <th>No Bantek</th>
                      <th>Nama Arsip</th>
                      <th>Tanggal Arsip</th>
                      <th>Keterangan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>ID Link</th>
                      <th>No Berkas</th>
                      <th>Lokasi</th>
                      <th>No Bantek</th>
                      <th>Nama Arsip</th>
                      <th>Tanggal Arsip</th>
                      <th>Keterangan</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</body>
</html>