<script src="<?= base_url('assets/');?>vendor/chart.js/Chart.min.js"></script>
<script>
	function int_random(min, max) {
        var res = Math.random() * (max - min) + min;
        return parseInt(res);
    }
    var r4, r5, r6;
    function rgb_random() {
        var r1 = int_random(0, 255);
        var r2 = int_random(0, 255);
        var r3 = int_random(0, 255);
        if(r1 >= 20) {
          r4 = r1 - 20;
        } else {
          r4 = r1 + 20;
        }
        if(r2 >= 20) {
          r5 = r2 - 20;
        } else {
          r5 = r2 + 20;
        }
        if(r3 >= 20) {
          r6 = r3 - 20;
        } else {
          r6 = r3 + 20;
        }
        var rgb1 = 'rgb('+r1.toString()+','+r2.toString()+','+r3.toString()+')';
        return rgb1; 
    }
    function rgb_random2() {
        var rgb2 = 'rgb('+r4.toString()+','+r5.toString()+','+r6.toString()+')';
        return rgb2; 
    }

    function cvs_pie(cvsid, xlabel, num, bc, hbc) {
      // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#858796';

      // Pie Chart Example
      var ctx = document.getElementById(cvsid);
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: xlabel,
          datasets: [{
            data: num,
            backgroundColor: bc,
            hoverBackgroundColor: hbc,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: true
          }
        },
      });
    }

    function get_user_divisi() {
      var divisi1 = [], num1 = [], bc1 = [], hbc1 = []; 
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('admin/get_user_divisi');?>";
      var asynchronous = true;

      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          for(var i=0; i<data.length; i++) {
            divisi1[i] = data[i].divisi;
            num1[i] = data[i].num;
            num1[i] = parseFloat(num1[i]);
            bc1[i] = rgb_random();
            hbc1[i] = rgb_random2();
          }
          cvs_pie('user_divisi', divisi1, num1, bc1, hbc1);
        }
      };
    }
    get_user_divisi();

    function get_user_activation() {
      var actx, act1 = [], num1 = [], bc1 = [], hbc1 = []; 
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('admin/get_user_activation');?>";
      var asynchronous = true;

      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          for(var i=0; i<data.length; i++) {
            actx = data[i].is_active;
            if(actx == 0) {
              act1[i] = 'Belum Teraktivasi';
            } else {
              act1[i] = 'Sudah Teraktivasi';
            }
            num1[i] = data[i].num;
            num1[i] = parseFloat(num1[i]);
            bc1[i] = rgb_random();
            hbc1[i] = rgb_random2();
          }
          cvs_pie('user_activation',act1, num1, bc1, hbc1);
        }
      };
    }
    get_user_activation();
</script>