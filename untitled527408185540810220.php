<?php
    include 'simple_html_dom.php';
    phpinfo();
	
	// new php script to scrape blenderguru for .blend files, videos and relevant descriptions to form into a folder of tutorials.
	// the scraper will run through each page of videos, save the title of the page, extract the contents of the description, download the associated .blend file and download the video.
	
	$url = "http://www.blenderguru.com/video-category/tutorials/"; //url to begin scrape
	$pagestart=1;
	$maxpages=15; //page number to start scrape
	
	/*
	$doc=new DOMDocument();
	
	@$doc->loadHTMLFile($url);
	$found=false;
	var_dump($doc);
	
	$tutorials=$doc->getElementsByTagName("post ");
	var_dump($tutorials);
	
	foreach($tutorials as $tutorial){
		echo $tutorial->getAttribute('href').'|'.$tutorial->nodeValue."\n";
		
	}
	*/
	//find elements by simple html dom 
	function find_posts_on_page($url,$divclass)
	{
	$html=file_get_html($url);
	echo $html;
	echo 'getting html document'."\n";
	foreach($html->find('div[class='.$divclass.']') as $element){
		echo 'finding post elements'."\n\n\n";
		echo $element."/br";
		
	}	
	}	
	//loop through paginated pages on a selection
	function find_next_paginated_page($url,$nextpageclass){
		$html=file_get_html($url);
		echo 'loading page'."\n";
		$nextpage=$html->find('.next');
		foreach($nextpage as $nxtpg){
				echo 'link info'."\n".$nxtpg."\n";
				$linkhref=$nxtpg->href;
				echo $linkhref;

		}
	
		$linkto=$nextpage->href;
		return $linkto;
		
	}
	$vidurl='http://www.blenderguru.com/videos/introduction-to-rigging/';
	//finding video links on a valid tutorial page search for div class single video, prefer to regex search the plaintext document for this really??
	$html=file_get_html($vidurl);
	echo 'loading html file';
	//echo $html;
		$videolink=$html->find('div[class=single-video]');
	
	foreach($videolink as $videos){
		
		echo 'finding videos'."\n";
		echo $videos."\n";
		echo 'finding vidlink'."\n";
		$vidlink=$videos->children(0)->src;
		echo $vidlink."\n";
		$vidrequest=file_get_contents($vidlink);
		echo $vidrequest;
		$vid_json_decode=json_decode($vidrequest);
		var_dump($vid_json_decode);
		$vid_download_url=$vid_json_decode->{'url'};
		echo $vid_download_url;
	}
	
	echo 'matching string "\n"';
	$match_test_pattern='"url":"http://av.vimeo.com/[0-9,/,\n]*.mp4\?[a-z,A-z,0-9,=,_,&]*"';
	$match_test_string='"url":"http://av.vimeo.com/50720/122/67723999.mp4?token2=1396572825_d2b6874213a2a3640722ee62b766e869&aksessionid=5ec2044a776e71fd&ns=4';
	
	$find_vid_url=preg_match($match_test_pattern, $match_test_string);
	
	echo $find_vid_url;
	
	
	
	
	/*$html=file_get_html($url);
	echo 'loading page'."\n";
	$nextpage=$html->find('.next');
	foreach($nextpage as $nxtpg){
			echo 'link info'."\n".$nxtpg."\n";
			$linkhref=$nxtpg->href;
			echo $linkhref;

	}
	
	$linkto=$nextpage->href;
	echo $linkto;
	 * 
	 * 
	 */
	

	echo ' end'."\n";
	
?>