<?php
	$ci = get_instance();
	$files = $ci->db->get('tbl_arsip_masuk')->result_array();
	$i = 1; 
	foreach($files as $f) { 
		if($f['id_arsip'] >= 441 && $f['tgl_diterima'] != '00-00-0000') {
            echo '<tr>';
            	echo '<td>'.$i.'</td>';
	            echo '<td>'.$f['id_arsip'].'</td>';
	            echo '<td>'.$f['no_berkas'].'</td>';
	            echo '<td>'.$f['lokasi_penyimpanan'].'</td>';
	            echo '<td>'.$f['no_arsip'].'</td>';
	            echo '<td>'.$f['nama_arsip'].'</td>';
	            echo '<td>'.$f['tgl_diterima'].'</td>';
	            echo '<td>'.$f['keterangan'].'</td>';
	            echo '<td>';
	            	echo '<a href=""><i class="fas fa-edit"></i></a>';
	            	echo '<a href=""><i class="fas fa-trash-alt"></i></a>';
	            echo '</td>';
            echo '</tr>';
    	$i++;
    	} 
	}
?>
