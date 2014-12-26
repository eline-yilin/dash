
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>后台管理</title>
<link rel="icon" href="<?php echo $this->config->item( 'base_theme_url');?>images/fav1.ico" />
 <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/bootstrap.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/bootstrap_theme.css">
    <link rel="stylesheet" href="<?php echo $this->config->item( 'base_theme_url');?>css/app.css"/>
     <script src="<?php echo $this->config->item( 'base_theme_url');?>js/jquery.js"></script> 
       
     <!-- Latest compiled and minified JavaScript -->
      <script src="<?php echo $this->config->item( 'base_theme_url');?>js/bootstrap.js"></script>
      <script src="<?php echo $this->config->item( 'base_theme_url');?>js/validator.js"></script>
      <script src="<?php echo $this->config->item( 'base_theme_url');?>js/utility.js"></script>
      <script src="<?php echo $this->config->item('base_theme_url');?>js/app.js"></script>
</head>
<body>
	<!-- Fixed navbar -->
    <div role="navigation" class="navbar my-navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
         
        </div>
        <div class="my-top-nav">
        <div class='my-pills-overlay'></div>
          <ul class="nav  nav-pills my-pills">
           <?php foreach( $this->config->item( 'nav_arr') as $key => $nav_item):
            $text = isset( $nav_item['text']) ? $nav_item['text'] : $key;
            $href = isset( $nav_item['href']) ? $nav_item['href'] : $key;
            $href = $this->config->item('base_url') . $href;
           ?>
           		<li class='nav-item <?php if($router == $key) echo " active";?>' id='nav-item-<?php echo $key;?>'>
           			<a href='<?php echo $href;?>'><?php echo $text;?></a>
           		</li>
           <?php endforeach;?>
           		
          </ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class='page-content'>
    	
    
    
 	