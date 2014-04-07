<?php

echo 'matching string'."\n";
	$match_test_pattern='~"http://av.vimeo.com/[0-9,/,\n]*.mp4\\?[a-z,A-z,0-9,=,_,&]*"~iU';
	$match_test_string='"url":"http://av.vimeo.com/50720/122/67723999.mp4?token2=1396572825_d2b6874213a2a3640722ee62b766e869&aksessionid=5ec2044a776e71fd&ns=4"';
	$matches=array();
	$find_vid_url=preg_match($match_test_pattern,$match_test_string,$matches);
	
	$try="http://av.vimeo.com/93118/796/22381106.mp4?token2=1396659357_0236088de0373b7352c1e65ca1f984f5&aksessionid=dd3145f4d66e3af8&ns=4";
	
	echo $find_vid_url;
	echo $matches[0];
	$vidnumber=0;
	//santisise matched string to get rid of double quotes if there is more than 1 video on the page, loop though each video and download seperately.
	foreach($matches as $match){	
		$match=str_replace('"',"");
		$filename=$match.$vidnumber;
		$file=fopen($match,"r");
		$save=file_put_contents($filename,$file);
		$vidnumber++;
		
		
	}
	
	//$file=fopen($matches[0],"r");
	//$file=fopen($try,"r");
	//$save=file_put_contents('newfile.mp4',fopen($matches[0], "r"));
	//$save=file_put_contents('newfile.mp4',$file);
	
	
	echo 'file saved!';
	
	
	
	
?>

