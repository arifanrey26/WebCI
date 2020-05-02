<html>
<head>
	<title>Heading Helper HTML</title>
</head>
<body>
<?php 
    echo heading("Hello CI",1); 
    echo heading("Hello CI ",2);     
    echo heading("Hello CI ",3);     
    echo heading("Hello CI ",4);     
    echo heading("Hello CI ",5);     
    echo heading("Hello CI ",6); 
  
  $gambar = array(
    'src'   => 'http://localhost/ci/assets/img/about/1.jpg',
    'alt' => 'Codeigniter-CI',
    'class' => 'post_images',
    'width'=>'300',
    'height'=>'300',
    'title'=>'ArtesonrajuMountain'
 );

  echo img($gambar);
 ?>
</body>
</html>
