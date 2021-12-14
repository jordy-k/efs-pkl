<!DOCTYPE html>  
<html>  
  <head>  
       <title>Webslesson Tutorial | How to Extract a Zip File in Php</title>  
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  </head>  
  <body>  
       <br />  
       <div class="container" style="width:500px;">  
            <h3 align="">How to Extract a Zip File in Php</h3><br />
            <?= $this->session->flashdata('message'); ?>  
            <?= form_open_multipart('example/proses_upload'); ?>  
                 <label>Please Select Zip File</label>  
                 <input type="file" name="file_zip" />  
                 <br />  
                 <input type="submit" name="btn_zip" class="btn btn-info" value="Extract" />  
            <?= form_close(); ?>  
            <br />
            <a href="<?= base_url('example/proses_extract'); ?>">test</a>  
       </div>  
       <br />  
  </body>  
</html>