<script>
	function showedit_efs(n) {
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('employee/get_efs/');?>" + n;
      var asynchronous = true;

      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          document.getElementById("id_arsip").value = data.id_arsip;
          document.getElementById("no_berkas").value = data.no_berkas;
          document.getElementById("keterangan").value = data.keterangan;
          document.getElementById("no_arsip").value = data.no_arsip;
          document.getElementById("lokasi_penyimpanan").value = data.lokasi_penyimpanan;
          document.getElementById("nama_arsip").value = data.nama_arsip;
          document.getElementById("tgl_arsip").value = data.tgl_arsip;
          document.getElementById("divisi").value = data.divisi;
        }
      };
    }
</script>