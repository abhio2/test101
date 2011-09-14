<?php




if($_GET['page']<1)
{
	
$_GET['page']=1;	
}

		$apiKey = '58c2856181761b3101e0af3a06410db9';
		$search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=' . $apiKey . '&text=' . urlencode($_GET['search']) . '&per_page=5&format=php_serial&page='.$_GET['page']; 
		$result = file_get_contents($search); 
		
		//$data = curl_get_file_contents($search); 
		
		$data = unserialize($result); 
		$html = '<div width="800px>';
	if (!empty($data['photos']['total'])) {
		$html = '<p>Total '.$data['photos']['total'].' photo(s) for this keyword.</p>';	
		foreach($data['photos']['photo'] as $photo) { 
			$html .=  '
			<a target="_blank" href="http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '.jpg"><img src="http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '_s.jpg" alt="" /></a>'; 
		
			
			

		}
	} else {
		$html = '<p>There are no photos for this keyword.</p>';
	}
	
	
		if($data['photos']['total']>0)
		{
	$html.="<br>";
		$previous=$_GET['page']-1;
		$next=$_GET['page']+1;
		if($_GET['page']>1)
		{
$html.="<span class='paginate' id='".$previous."' style='cursor:pointer;color:red;'><< - Previous </span>&nbsp;";

		}
$html.="<span class='paginate' id='".$next."' style='cursor:pointer;color:red;'>Next - >> </span>&nbsp;";
		}
	
	$html.="</div>";
	echo $html;

?>