<?php

	class Utility {

		public static function uniqueHTML($web_id, $menu_type, $unique_prop, $unique_prop2){

      $inline_style = ($menu_type == 'PMU') ? 'style="display:block;"' : ''; 
			$html = '
                    <div id="menu_PMU" '.$inline_style.' class="unique_menu" >
                            <input value="'.$unique_prop.'" name="unique_prop" type="hidden" value="0"/>
                            <input value="'.$unique_prop2.'" name="unique_prop2" type="hidden" value="0"/>
                    </div>';     

			if(empty($web_id)){
				return $html;
			}

      $inline_style = ($menu_type == 'SCAR') ? 'style="display:block;"' : '';
      $html .= '
              <div id="menu_SCAR" '.$inline_style.' class="unique_menu" >
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Article Id</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="'.$unique_prop.'" name="unique_prop" class="form-control col-md-7 col-xs-12" type="text">
                      </div>
                  </div>

                  <input value="'.$unique_prop2.'" name="unique_prop2" type="hidden" value="0"/>
              </div>';     


      $inline_style = ($menu_type == 'SAR') ? 'style="display:block;"' : '';
      $html .= '
              <div id="menu_SAR" '.$inline_style.' class="unique_menu" >
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Article Id</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="'.$unique_prop.'" name="unique_prop" class="form-control col-md-7 col-xs-12" type="text">
                      </div>
                  </div>

                  <input value="'.$unique_prop2.'" name="unique_prop2" type="hidden"/>
              </div>';     

      //TEMPLATE LIST

		    $objTemplate = new TBL_TEMPLATE();
		    $mainObj = $objTemplate->listall();
		    $list_template = $mainObj["data"];

            $inline_style = ($menu_type == 'SAT') ? 'style="display:block;"' : '';
            $html .='
                    <div id="menu_SAT"  '.$inline_style.' class="unique_menu" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Article Id</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="'.$unique_prop.'" name="unique_prop" class="form-control col-md-7 col-xs-12" type="text">
                                <span>If Article id is not mentioned, Only template content will be show.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Template</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" data-parsley-id="4353" name="unique_prop2" >
                                <option>Choose option</option>';
            foreach ($list_template as $key => $arr_value) {
            	# code...
                $is_selected = ($unique_prop2 == $arr_value["t_id"]) ? "Selected" : "";
            	$html .='<option '.$is_selected.' value="'.$arr_value['t_id'].'" >'.$arr_value['name'].'</option>';
            }

            $html .='
                            </select>
                            </div>
                        </div>
                    </div>';     


		    $objForm = new TBL_FORM();
		    $mainObj = $objForm->listall();
		    $list_form = $mainObj["data"];

            $inline_style = ($menu_type == 'FRM') ? 'style="display:block;"' : '';
            $html .='
                    <div id="menu_FRM" '.$inline_style.'  class="unique_menu" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Forms</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" data-parsley-id="4353" name="unique_prop" >
                                <option>Choose option</option>';

            foreach ($list_form as $key => $arr_value) {
            	# code...
                $is_selected = ($unique_prop2 == $arr_value["f_id"]) ? "Selected" : "";
            	$html .='<option '.$is_selected.' value="'.$arr_value['f_id'].'" >'.$arr_value['name'].'</option>';
            }                                                   

            $html .='
                            </select>
                            </div>
                        </div>

                        <input name="unique_prop2" value="'.$unique_prop2.'" type="hidden" value="0"/>
                    </div>';    


            
      if (!class_exists('TBL_ARTICLE_CATEGORY')) {
      include("../data/TBL_ARTICLE_CATEGORY.php");
      }
			$objArticleCat = new TBL_ARTICLE_CATEGORY();
			$mainObj = $objArticleCat->listallactive();
			$list_category = $mainObj["data"];

            $inline_style = ($menu_type == 'BLI') ? 'style="display:block;"' : '';
            $html .='
                    <div id="menu_BLI"  '.$inline_style.' class="unique_menu" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Blog Category</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" data-parsley-id="4353" name="unique_prop" >
                                <option  value="0"  >All</option>';
            
            foreach ($list_category as $key => $arr_value) {
            	# code...
                $is_selected = ($unique_prop2 == $arr_value["ac_id"]) ? "Selected" : "";
            	$html .='<option '.$is_selected.' value="'.$arr_value['ac_id'].'" >'.$arr_value['title'].'</option>';
            }   

            $html .='
                            </select>
                            </div>
                        </div>
                        <input value="'.$unique_prop2.'" name="unique_prop2" type="hidden" value="0"/>
                    </div>';


            $inline_style = ($menu_type == 'CVW') ? 'style="display:block;"' : '';
            $html .='
                    <div id="menu_CVW"  '.$inline_style.' class="unique_menu" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Category Id</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="'.$unique_prop.'" name="unique_prop" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <input value="'.$unique_prop2.'" name="unique_prop2" type="hidden" value="0"/>
                    </div>';


            $inline_style = ($menu_type == 'SPL') ? 'style="display:block;"' : '';
            $html .='
                    <div id="menu_SPL"  '.$inline_style.' class="unique_menu" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Category Id</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="'.$unique_prop.'" name="unique_prop" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <input value="'.$unique_prop2.'" name="unique_prop2" type="hidden" value="0"/>
                    </div>';
                    
            $inline_style = ($menu_type == 'SPR') ? 'style="display:block;"' : '';
            $html .='
                    <div id="menu_SPR"  '.$inline_style.' class="unique_menu" >
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Id</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="'.$unique_prop.'" name="unique_prop" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <input name="unique_prop2" value="'.$unique_prop2.'" type="hidden" value="0"/>
                    </div>';           


            $inline_style = ($menu_type == 'EXL') ? 'style="display:block;"' : '';
            $html .='
                    <div id="menu_EXL" '.$inline_style.'  class="unique_menu" >

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">External Link</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="'.$unique_prop.'" name="unique_prop" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <input name="unique_prop2" value="'.$unique_prop2.'" type="hidden" value="0"/>
                    </div>       
			';
			return $html;
		}

    public static function menuparents($menu_id, $html){
        //include("../data/TBL_MENUS.php");
        $objInstance = new TBL_MENUS();
        $mainObj = $objInstance->getdetails($menu_id);
        $menu_parent = $mainObj;
        //echo $menu_parent['parent_menu_id'].'--';
        if($menu_parent['parent_menu_id'] != 0){
            if(empty($html)){
              $html = $menu_parent['name'];
            } else {
              $html = $menu_parent['name']." > ".$html;
            }
            return Utility::menuparents($menu_parent['parent_menu_id'], $html);
            //return $html;
        } else {
            if(empty($html)){
              $html = $menu_parent['name'].$html;
            } else {
              $html = $menu_parent['name']." > ".$html;
            }
            return $html;
        }
    }

    
    public static function categorySelectHtml($cat_id, $parent_name, $html){
        $objInstance = new TBL_PRODUCT_CATEGORY();
        $mainObj = $objInstance->listchild($cat_id);
        $listchild = $mainObj["data"];
        if(!empty($listchild)){
          foreach ($listchild as $key => $arr_value) {
            $html .= "<option value='".$arr_value['prc_id']."' >".$parent_name." > ".$arr_value['name']."</option>";
            //$parent_name .= " > ".$arr_value['name'];  
            
            $html = Utility::categorySelectHtml($arr_value['prc_id'], $parent_name." > ".$arr_value['name'], $html); 
          }
          return $html;
        } else {
          return $html;
        }
        /*
        if($product_cat['parent_cat_id'] != 0){
            $html .= "<option value='".$product_cat['prc_id']."' >".$parent_name." > ".$product_cat['name']."</option>";
            $parent_name .= " > ".$product_cat['name'];
            Utility::categorySelectHtml($product_cat['parent_menu_id'], $parent_name, $html);
        } else {
            $html .= "<option value='".$product_cat['prc_id']."' >".$parent_name." > ".$product_cat['name']."</option>";
            return $html;
        }
        */
    }
    

        public static function getProductBasicHtml($id){
            $html = '
                <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Unique Product ID  <span class="required">*</span>
                     </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text"  required="required" class="form-control col-md-7 col-xs-12" readonly>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Title  </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text"   required="required" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Type</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <div class="checkbox-inline">
                              <label>
                                  <input type="checkbox" checked="" value="Residential" id=" " name="ProductType"> Residential
                              </label>
                          </div>
                          <div class="checkbox-inline">
                              <label>
                                  <input type="checkbox" checked="" value="Commercial" id=" " name="ProductType"> Commercial
                              </label>
                          </div>
                          <div class="checkbox-inline">
                              <label>
                                  <input type="checkbox" checked="" value="Industrial" id=" " name="ProductType"> Industrial
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Code <span class="required">*</span>
                     </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text"    class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="select2_multiple form-control" multiple="multiple">
                            <option vlaue="0">Choose Country</option>
                            <option>North America</option>
                            <option>Europe</option>
                            <option>China</option>
                            <option>India </option>          
                        </select>
                    </div>
                  </div>

                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Model  </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text"   required="required" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Brand  </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text"   required="required" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Price  </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text"   required="required" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" type="file">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Short Description</label>
                     <div class="col-md-9 col-sm-9 col-xs-12">                                                
                        <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Long Description</label>
                     <div class="col-md-9 col-sm-9 col-xs-12">                                                
                        <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link</label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" type="text">
                     </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <h2>Upload Product Images</small></h2>
                      <div class="product-image">
                          <img src="'.SERVER_PATH.'images/super-combo-black1.jpg" alt="...">
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control col-md-7 col-xs-12" type="file" name="product_image" >
                     </div>
                  </div>
                  <hr class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <h2>Upload Additional Images</small></h2>
                      <div class="form-group">
                        <div id="comman_image_wrapper" > 
                          <div class="product_gallery">
                              <a>
                                  <img src="'.SERVER_PATH.'images/super-combo-black5.jpg" alt="...">
                              </a>
                              <a>
                                  <img src="'.SERVER_PATH.'images/super-combo-black7.jpg" alt="...">
                              </a>
                              <a>
                                  <img src="'.SERVER_PATH.'images/super-combo-black8v1.jpg" alt="...">
                              </a>
                          </div>
                        </div>
                        <input type="file" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                  </div>
                </div>

                <div  class="col-md-10">
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification</label>
                     <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="x_panel">
                             <div class="x_title">
                                <h2><i class="fa fa-bars"></i> Parameters</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                   <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                             </div>

                             <div class="x_content">
                                <div class="form-group">
                                   <div class="col-md-4 col-sm-4 col-xs-12">
                                      <input type="text" class="form-control col-md-7 col-xs-12">
                                   </div>
                                   <div class="col-md-3 col-sm-3 col-xs-12">
                                      <input type="text"   class="form-control col-md-7 col-xs-12">
                                   </div>
                                   <div class="col-md-3 col-sm-3 col-xs-12">
                                      <input type="text"   class="form-control col-md-7 col-xs-12">
                                   </div>
                                   <button type="button" class="btn btn-primary btn"><i class="fa fa-close"></i></button>
                                </div>
                                <div class="form-group">
                                   <div class="col-md-4 col-sm-4 col-xs-12">
                                      <input type="text" placeholder="Enter label"   class="form-control col-md-7 col-xs-12">
                                   </div>
                                   <div class="col-md-3 col-sm-3 col-xs-12">
                                      <input type="text" placeholder="Value"   class="form-control col-md-7 col-xs-12">
                                   </div>
                                   <div class="col-md-3 col-sm-3 col-xs-12">
                                      <input type="text" placeholder="Value"   class="form-control col-md-7 col-xs-12">
                                   </div>
                                   <button type="button" class="btn btn-success btn"><i class="fa fa-save"></i></button>
                                </div>
                              </div>
                        </div>
                     </div>
                  </div>
                </div>
            ';
            return $html;
        }

        public static function getProductImageHtml($id){
            $html = '
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="product-image">
                        <img src="'.SERVER_PATH.'images/super-combo-black1.jpg" alt="...">
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2>Upload Images</small></h2>
                    <div class="form-group">
                      <div id="comman_image_wrapper" > 
                        <div class="product_gallery">
                            <a>
                                <img src="'.SERVER_PATH.'images/super-combo-black5.jpg" alt="...">
                            </a>
                            <a>
                                <img src="'.SERVER_PATH.'images/super-combo-black7.jpg" alt="...">
                            </a>
                            <a>
                                <img src="'.SERVER_PATH.'images/super-combo-black8v1.jpg" alt="...">
                            </a>
                            <a>
                                <img src="'.SERVER_PATH.'images/super-combo-black9v1.jpg" alt="...">
                            </a>
                        </div>
                      </div>
                      <input type="file" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
            ';
            return $html;
        }


        public static function validation($valid_obj){
            $mainObj = Array(
              "status"=>false, 
              "msg"=>"Issue in validation."
            );
            foreach ($valid_obj as $key => $ind_obj) {
              $check = $ind_obj['check'];
              $val = $ind_obj['value'];
              $name = $ind_obj['name'];
              foreach ($check as $key => $ind_check) {
                switch ($ind_check) {
                  case 'NOT_BLANK':
                    if($val == ''){
                      $mainObj['status'] = false;
                      $mainObj['msg'] = $name." can not be blank."; 
                      goto error_found; 
                    } else {
                      $mainObj['status'] = true;
                    }
                    break;
                  case 'EMAIL':
                    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                      $mainObj['status'] = false;
                      $mainObj['msg'] = $name." is not valid email.";
                      goto error_found; 
                    } else {
                      $mainObj['status'] = true;
                    }
                    break;
                  case 'LINK':
                    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$val)) {
                      $mainObj['status'] = false;
                      $mainObj['msg'] = $name." is not valid link.";
                      goto error_found; 
                    } else {
                      $mainObj['status'] = true;
                    }
                    break;
                  case 'DOMAIN':
                    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$val)) {
                      $mainObj['status'] = false;
                      $mainObj['msg'] = $name." is not valid domain.";
                      goto error_found; 
                    } else {
                      $mainObj['status'] = true;
                    }
                    break;
                  case 'NUMIRIC':
                    if(!is_numeric($val)) {
                      $mainObj['status'] = false;
                      $mainObj['msg'] = $name." is not valid number.";
                      goto error_found; 
                    } else {
                      $mainObj['status'] = true;
                    }
                    break;
                  case 'MOBILE':
                    if(strlen($val) !== 10) {
                      $mainObj['status'] = false;
                      $mainObj['msg'] = $name." is not valid mobile number.";
                      goto error_found; 
                    } else {
                      $mainObj['status'] = true;
                    }
                    break;
                  case 'NOT_SAME':
                    if($val[0] == $val[1]) {
                      $mainObj['status'] = false;
                      $mainObj['msg'] = $name[0]." and ".$name[1]." should be same.";
                      goto error_found; 
                    } else {
                      $mainObj['status'] = true;
                    }
                    break;
                  default:
                    $mainObj['status'] = false;
                    $mainObj['msg'] = $name." Issue.";
                    break;
                }
              }
            }
            return $mainObj;

            error_found : 
              return $mainObj;
        }

        public static function getProductSellOn($product_id){

            if (!class_exists('TBL_PRODUCT_UNIQUE')) {
              include("../data/TBL_PRODUCT_UNIQUE.php");
            }
            $objProducts = new TBL_PRODUCT_UNIQUE();
            $mainObj = $objProducts->listallproduct($product_id);


            if (!class_exists('TBL_WEBSITE')) {
              include("../data/TBL_WEBSITE.php");
            }
            $objWeb = new TBL_WEBSITE();

            $html = '';
            $website = array();
            $websiteName = array();
            foreach ($mainObj as $key => $product) {
                $sell_on = $product['sell_on'];
                $sell_on_arr = explode(',', $sell_on);
                foreach ($sell_on_arr as $key => $web_id) {
                    if(!empty($web_id)){
                      if(!in_array($web_id, $website)){
                          $website[] = $web_id;
                          $webResult = $objWeb->getdetails($web_id);
                          $websiteName[] = $webResult['domain']; 
                          //echo $web_id;
                      }
                    }
                }
            }
            $html = implode(', ', $websiteName);
            return $html;
        }


        public static function getProductAvailableOn($product_id){

            if (!class_exists('TBL_PRODUCT_UNIQUE')) {
              include("../data/TBL_PRODUCT_UNIQUE.php");
            }
            $objProducts = new TBL_PRODUCT_UNIQUE();
            $mainObj = $objProducts->listallproduct($product_id);


            if (!class_exists('TBL_WEBSITE')) {
              include("../data/TBL_WEBSITE.php");
            }
            $objWeb = new TBL_WEBSITE();

            $html = '';
            $website = array();
            $websiteName = array();
            foreach ($mainObj as $key => $product) {
                $web_id = $product['web_id'];
                $webResult = $objWeb->getdetails($web_id);
                $websiteName[] = $webResult['domain']; 
            }
            $html = implode(', ', $websiteName);
            return $html;
        }

        public static function getWebsiteList($web_ids){
            $web_arr = explode(',', $web_ids);
            $returnArr = array(
                  'domainHTML' => 'none',
                  'domainComma' => 'none',
                  'nameComma' => 'none',
                  'nameHTML' => 'none'
              );

            if (!class_exists('TBL_WEBSITE')) {
              include("../data/TBL_WEBSITE.php");
            }
            $objWeb = new TBL_WEBSITE();

            foreach ($web_arr as $key => $web_id) {
                $webResult = $objWeb->getdetails($web_id);
                $websiteName[] = $webResult['domain']; 
            }

            $nameHTML = implode('<br/>', $websiteName);
            $returnArr['nameHTML'] = $nameHTML;
            return $returnArr;
        }

        

        public static function getProductSellOnID($product_id){

            if (!class_exists('TBL_PRODUCT_UNIQUE')) {
              include("../data/TBL_PRODUCT_UNIQUE.php");
            }
            $objProducts = new TBL_PRODUCT_UNIQUE();
            $mainObj = $objProducts->listallproduct($product_id);
            $html = '';
            $website = array();
            $websiteName = array();
            foreach ($mainObj as $key => $product) {
                $sell_on = $product['sell_on'];
                $sell_on_arr = explode(',', $sell_on);
                foreach ($sell_on_arr as $key => $web_id) {
                    if(!empty($web_id)){
                      if(!in_array($web_id, $website)){
                          $website[] = $web_id;
                      }
                    }
                }
            }
            //$html = implode(', ', $website);
            return $website;
        }

        public static function copyFile($image_link,$profix){
          $new_image_link = '';
          $arr_link = explode('/', $image_link);
          $image_name = $arr_link[count($arr_link) - 1];  
          $imageFileTypeArr = explode('.', $image_name);
          $imageFileType = $imageFileTypeArr[count($imageFileTypeArr) - 1];
          $new_image_name = $profix."_".date("Ymdhis").".".$imageFileType;
          $image_folder = BASE_DIR."uploads/";
          $image_folder_link = SERVER_PATH."uploads/";
          $copy_res = copy($image_folder."".$image_name, $image_folder."".$new_image_name);
          if($copy_res == 1){
            $new_image_link = $image_folder_link.''.$new_image_name;
          }
          return $new_image_link;
        }

        public static function get_input($val){
          $val = trim($val);
          return $val;
        }


        public static function getOrderHtml($orderDetails){
              $order_status = '';
              if($orderDetails['order_status'] == 4){
                  $order_status = '<b>Complete</b>';

              } else if($orderDetails['order_status'] == 2){
                  $order_status = '<b>Rejected</b>';

              } else if($orderDetails['order_status'] == 3){
                  $order_status = '<b>Cancelled</b>';

              } else if($orderDetails['order_status'] == 5){
                  $order_status = '<b>In Process</b>';

              } else if($orderDetails['order_status'] == 7){
                  $order_status = '<b>Dispatched</b>';

              } else if($orderDetails['order_status'] == 6){
                  $order_status = '<b>Shipping</b>';

              } else if($orderDetails['order_status'] == 0){
                  $order_status = '<b>Payment Failed</b>';

              } else {
                  $order_status = '<b>Pending</b>';        
              }

            $shipping_add = isset($orderDetails['shipping_address']) ? $orderDetails['shipping_address'] : array();
            $billing_add = isset($orderDetails['billing_address']) ? $orderDetails['billing_address'] : array();

            $objCountry = new TBL_COUNTRY();
            $country = $objCountry->getdetails($shipping_add['country']);
            $country_name = empty($country) ? '' : $country['name'];

            $ship_add = $shipping_add['comp_apt'].'
                        <br>'.$shipping_add['add1'].'
                        <br>'.$shipping_add['add2'].'
                        <br>'.$shipping_add['city'].' '.$shipping_add['postcode'].'
                        <br>'.$shipping_add['state'].'
                        <br>'.$country_name;

            $country = $objCountry->getdetails($billing_add['country']);
            $country_name = empty($country) ? '' : $country['name'];
            $bill_add = $billing_add['comp_apt'].'
                        <br>'.$billing_add['add1'].'
                        <br>'.$billing_add['add2'].'
                        <br>'.$billing_add['city'].' '.$billing_add['postcode'].'
                        <br>'.$billing_add['state'].'
                        <br>'.$country_name;

            $paymentDetails = $orderDetails['payment_method_details'];
            $shippingDetails = $orderDetails['shipping_method_details'];
            $payment_menthod = !empty($paymentDetails) ? $paymentDetails["method_name"] : "Not Set";
            $shipping_menthod=!empty($shippingDetails) ? $shippingDetails["method_name"] : "Not Set";
            

            $product_list = isset($orderDetails['product_list']) ? $orderDetails['product_list'] : array();
            $table_html = '';
            foreach ($product_list as $key => $product) { 
              $table_html .="
                             <tr>
                              <td >".$product['product']['name']."</td>
                              <td >".$product['product']['code']."</td>
                              <td >".$product['quantity']."</td>
                              <td >$".round($product['price'], 2)."</td>
                              <td >$".round(($product['quantity'] * $product['price']), 2)."</td>                    
                            </tr>
                            ";
            }

            $html = '<div style="border:#000 thin solid; background:#EEE; color:#555; border-radius:10px; overflow:hidden;">
                        <h3 style="text-align:left; margin:0px; padding:10px; background:#DDD;" >
                            Order Information
                            <span style="float:right;">
                                '.$order_status.'
                            </span>
                        </h3>
                        <div style="padding:10px; " >
                        <table style="text-align:left; width:100%; font-size:12px; color:#555;" >
                          <tbody>
                            <tr>
                                <td>              
                                    <b>Order ID:</b>'.$orderDetails['order_id'].'<br>
                                    <b>Order Date:</b>'.date('d/m/Y', strtotime($orderDetails['created_on'])).'                         
                                </td>
                                <td>    
                                  <b>Payment Method : </b>'.$payment_menthod.'<br>
                                  <b>Shipping Method : </b>'.$shipping_menthod.'              
                                </td>
                            </tr>
                          </tbody>
                        </table>
                        <br/>

                        <table  style="text-align:left; width:100%; font-size:12px;color:#555;" >
                          <thead>
                            <tr>
                              <td >
                                <b>Billing Address</b>
                              </td>
                              <td >
                                <b>Shipping Address</b>
                              </td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td >'.$bill_add.'
                                </td>
                                <td >'.$ship_add.'
                                </td>
                            </tr>
                          </tbody>
                        </table>
                        <br/>

                        <div >
                          <table style="text-align:left; width:100%; font-size:12px;color:#555;"  >
                            <thead>
                              <tr>
                                <th >Product Name</th>
                                <th >Product Code</th>
                                <th >Quantity</th>
                                <th >Price</th>
                                <th >Total</th>
                              </tr>
                            </thead>
                            <tbody>
                            '.$table_html.'
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="3"></td>
                                <td ><b>Discount</b></td>
                                <td >$'.round($orderDetails['discount'], 2).'</td>
                              </tr>
                              <tr>
                                <td colspan="3"></td>
                                <td ><b>Sub-Total</b></td>
                                <td >$'.round($orderDetails['price'] - $orderDetails['discount'], 2).'</td>
                              </tr>
                              <tr>
                                <td colspan="3"></td>
                                <td ><b>Shipping Cost</b></td>
                                <td >$'.round($orderDetails['shipping_charge'], 2).'</td>
                              </tr>';
                  $coupon_id = $orderDetails['coupon_id'];
                  $coupon_discount = $orderDetails['coupon_discount'];

                  if($coupon_discount != 0){
                      $html .= '
                            <tr>
                              <td colspan="3"></td>
                              <td><b>Coupon Discount</b></td>
                              <td >$'.round($coupon_discount, 2).'</td>
                            </tr>';
                  }

                  $html .= '          
                              <tr>
                                <td colspan="3"></td>
                                <td><b>Total</b></td>
                                <td >$'.round(($orderDetails['price']+$orderDetails['shipping_charge']-$orderDetails['discount']-$coupon_discount), 2).'</td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                       </div>
                    </div>';

                return $html;
        }
        

        public static function editProd(){

          //include("../data/TBL_PRODUCT_UNIQUE.php");
          $objProduct = new TBL_PRODUCT_UNIQUE();
          $mainObj = $objProduct->listall(-1);
          $list_product = $mainObj;
          //var_dump($list_product);
          foreach ($list_product as $key => $product) {
            $name = $product['name'];
            $arr_name = explode(' ', strtolower($name));
            $alise_new = implode('-', $arr_name);
            $alise_new .= '-'.$product["product_id"].'-'.$product["unique_product_id"];
            $objProduct->editAlise($product["unique_product_id"], $alise_new);
          }

        }


	}
?>