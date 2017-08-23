<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/prototype.js"></script>


<div id="content">
<?php

$config['first_link'] = '';
$config['last_link'] = '';
//$config['num_links'] = 8;
$config['div'] = 'content'; //Div tag id
$config['base_url'] = site_url()."my_data_page/index";
$config['total_rows'] = $getTotalData;
$config['per_page'] = $perPage;
$config['postVar'] = 'page';



$this->ajax_pagination->initialize($config);
echo $this->ajax_pagination->create_links();
//PRINT TABLE
print $this->table->generate($makeColums);
?>
</div> 