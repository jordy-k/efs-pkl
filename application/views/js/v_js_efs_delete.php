<script>
	function showdelete_efs(n) {
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('employee/get_efs/');?>" + n;
      var asynchronous = true;

      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          document.getElementById("showdelete").value = 'Are you sure to delete this efs data (No berkas : '+data.no_berkas+')';
          document.getElementById("delete_this").href = '<?= base_url('employee/delete/'); ?>'+data.id_arsip;
        }
      };
    }
</script>