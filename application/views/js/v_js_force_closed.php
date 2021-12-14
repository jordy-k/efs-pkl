<script>
	function force_closed() {
      var expired = Math.round((new Date()).getTime() / 1000) + 5;
      var now, distance, minutes, seconds, lt;
      var x = setInterval(function() {
        now = Math.round((new Date()).getTime() / 1000);
        distance = expired - now;
        minutes = (distance - distance%60)/60;
        seconds = distance%60;
        fc = document.getElementById("force_closed");
        if(distance%2 == 0) {
          fc.className = 'text-danger';
          fc.innerHTML = 'Tab browser ini akan tertutup dalam '+seconds+' detik';
        } else {
          fc.className = 'text-dark';
          fc.innerHTML = 'Tab browser ini akan tertutup dalam '+seconds+' detik';
        }
        if(distance == 0) {
          clearInterval(x);
          window.close();
        }
      }, 1000);
    }
    <?php if($this->session->flashdata('force_closed') == 1) { ?>
      force_closed();
    <?php } ?>
</script>