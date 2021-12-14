<script>
	function showdelete_employee(n) {
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('admin/employee_data/');?>" + n;
      var asynchronous = true;

      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          document.getElementById("showdelete").innerHTML = 'Apakah anda yakin untuk menghapus data employee ini? (Username : '+data.username+')';
          document.getElementById("delete_this").href = '<?= base_url('admin/employee_delete/'); ?>'+data.id;
        }
      };
    }
</script>