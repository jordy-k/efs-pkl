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

    function get_arsip_divisi() {
      var divisi1 = [], num1 = [], bc1 = [], hbc1 = []; 
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('employee/get_efs_divisi');?>";
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
          cvs_pie('arsip_divisi', divisi1, num1, bc1, hbc1);
        }
      };
    }
    get_arsip_divisi();

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

    function cvs_line(cvsid, xlabels, ydatasets) {
      //line
      var ctxL = document.getElementById(cvsid).getContext('2d');
      var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
          labels: xlabels,
          datasets: ydatasets
        },
        options: {
          responsive: true,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ' : ' + number_format(tooltipItem.yLabel)+' berkas';
              }
            }
          }
        },
      });
    }

    function get_efs_data() {
      var thn = [];
      var datatahun = [];
      var temp, temp2, out = [];
      var labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      var rgb1, rgb2;
      var r1, r2, r3;
      <?php foreach($tahun as $thn) { ?>
        thn.push(<?= $thn['tahun']; ?>);
      <?php } ?>
      for(var a=0; a<thn.length; a++) {
          datatahun.push([]);
      }
      for(var a=0; a<thn.length; a++) {
          for(var b=0; b<12; b++) {
            datatahun[a].push(0);
          }
      }
      var ajax = new XMLHttpRequest();
      var method = "GET"; 
      var url = "<?= base_url('employee/get_efs_tahun');?>";
      var asynchronous = true;
      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          for(var i=0; i<thn.length; i++) {
            for(var j=0; j<data.length; j++) {
              temp = data[j].tahun.toString();
              temp = temp.substr(0, 4);
              if(thn[i].toString() == temp) {
                temp2 = data[j].tahun.toString();
                temp2 = temp2.substr(5,6);
                temp2 = parseInt(temp2);
                datatahun[i][temp2-1] = parseInt(data[j].num);
              }
            }
          }
          for(var i=0; i<thn.length; i++) {
            r1 = int_random(0, 255);
            r2 = int_random(0, 255);
            r3 = int_random(0, 255);
            rgb1 = 'rgba('+r1.toString()+','+r2.toString()+','+r3.toString()+',0.2)';
            rgb2 = 'rgba('+r1.toString()+','+r2.toString()+','+r3.toString()+',0.7)';
            out.push({});
            out[i].label = thn[i].toString();
            out[i].data = datatahun[i];
            out[i].backgroundColor = [rgb1];
            out[i].borderColor = [rgb2];
            out[i].borderWidth = 2;
          }
          console.log(labels,out)
          cvs_line('chart_efs', labels, out);
        }
      };
    }
    get_efs_data();
</script>