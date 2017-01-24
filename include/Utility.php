<?php

class Utility {

	public static function getGallaryHtml($folder_name){
	    $tumbnail_path = $folder_name."/thumbnail/";
	    $image_path = $folder_name."/image/";
	    $i = 1;
	    $html = "";
	    if ($handle = opendir($folder_name)) {
	        while (false !== ($file = readdir($handle))) {
	            if ('.' === $file) continue;
	            if ('..' === $file) continue;
                $arr_file = explode('.', $file);
                $file_name = $arr_file[0];

	            $html .= '
	            <div class="col-md-4 item residential">
                    <div class="picframe">
                        <a class="image-popup-gallery" href="'.$folder_name.$file.'">
                            <span class="overlay">
                                <span class="pf_text">
                                    <span class="project-name">'.$file_name.'</span>
                                </span>
                            </span>
                        </a>
                        <img src="'.$folder_name.$file.'" alt="" />
                    </div>
                </div>
                ';

	            //$i++;
	        }
	    }
	    return $html;
	}
	
}

?>