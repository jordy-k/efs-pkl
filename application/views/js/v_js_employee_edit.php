<script>
	function showedit_employee(n) {
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('admin/employee_data/');?>" + n;
      var asynchronous = true;

      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          document.getElementById("id_user").value = data.id;
          document.getElementById("name").value = data.name;
          document.getElementById("username1").value = data.username;
          document.getElementById("divisi").value = data.divisi;
        }
      };
    }
</script>