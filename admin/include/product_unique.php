
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="product-image">
        <img src="<?=SERVER_PATH?>images/super-combo-black1.jpg" alt="...">
    </div>
    <div class="product_gallery">
        <a>
            <img src="<?=SERVER_PATH?>images/super-combo-black5.jpg" alt="...">
        </a>
        <a>
            <img src="<?=SERVER_PATH?>images/super-combo-black7.jpg" alt="...">
        </a>
        <a>
            <img src="<?=SERVER_PATH?>images/super-combo-black8v1.jpg" alt="...">
        </a>
        <a>
            <img src="<?=SERVER_PATH?>images/super-combo-black9v1.jpg" alt="...">
        </a>
    </div>
</div>


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
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Additional Image</label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><i class="fa fa-bars"></i> Upload Images</small></h2>
            <ul class="nav navbar-right panel_toolbox">
               <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <div class="form-group">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file"   class="form-control col-md-7 col-xs-12">
               </div>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file"   class="form-control col-md-7 col-xs-12">
               </div>
               <div class="col-md-12 col-sm-12  col-xs-12">
                  <input type="file"   class="form-control col-md-7 col-xs-12">
               </div>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file"   class="form-control col-md-7 col-xs-12">
               </div>
            </div>
            <button type="button" class="btn btn-primary btn pull-right"><i class="fa fa-plus"></i></button>
         </div>
      </div>
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
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification</label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2><i class="fa fa-bars"></i> Parameters</h2>
            <ul class="nav navbar-right panel_toolbox">
               <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">Model </span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"   class="form-control col-md-7 col-xs-12">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">Color </span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"   class="form-control col-md-7 col-xs-12">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">Capacity    </span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"   class="form-control col-md-7 col-xs-12">
               </div>
               <button type="button" class="btn btn-primary btn"><i class="fa fa-plus"></i></button>
            </div>
            <div class="form-group">
               <div class="col-md-5 col-sm-5 col-xs-12">
                  <input type="text" placeholder="Enter label"   class="form-control col-md-7 col-xs-12">
               </div>
               <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" placeholder="Value"   class="form-control col-md-7 col-xs-12">
               </div>
               <button type="button" class="btn btn-success btn"><i class="fa fa-save"></i></button>
            </div>

          </div>
      </div>
   </div>
</div>

</div>