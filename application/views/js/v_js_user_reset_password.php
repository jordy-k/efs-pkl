<script>
	function copylink() {
      var copyText = document.getElementById("reset");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
    }

    function link_timer() {
      var expired = Math.round((new Date()).getTime() / 1000) + 180;
      var now, distance, minutes, seconds, lt;
      var x = setInterval(function() {
        now = Math.round((new Date()).getTime() / 1000);
        distance = expired - now;
        minutes = (distance - distance%60)/60;
        seconds = distance%60;

        lt = document.getElementById("link_timer");
        if(distance%2 == 0) {
          lt.className = 'text-danger';
          lt.innerHTML = 'Expired at '+minutes+' minute(s) '+seconds+' second(s)';
        } else {
          lt.className = 'text-dark';
          lt.innerHTML = 'Expired at '+minutes+' minute(s) '+seconds+' second(s)';
        }
        if(distance < 0) {
          clearInterval(x);
          lt.className = 'text-danger';
          lt.innerHTML = "Link Expired";
        }
      }, 1000);
    }
    link_timer();
</script>