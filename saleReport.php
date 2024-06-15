

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <!--<div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
					</ol>
                </div>-->
                <!-- row -->
     <form method="get">
                <div class="row col-md-12">
                  
                <div class="mb-3 col-lg-3 col-md-3">
                  <label class="form-label">Category</label>
                    <select class="form-control form-control-sm mb-3" required  name="category">
                    <option selected="" value="">Select</option>
                    <?php error_reporting(0); $query1 = $this->db->query("select * from tbl_category");
                      foreach($query1->result() as $category){?>
                    <option value="<?=$category->cate_id?>" <?php if($category->cate_id==$_GET['category']){ echo 'selected';}?>><?=$category->category?></option>
                    <?php } ?>
                    </select>
              	</div>
              	
              
              	
              	<div class="mb-3 col-lg-3 col-md-3">
                  <label class="form-label">To Date</label>
                   	<input type="date" name="to" class="form-control" value="<?=$_GET['to']?>"  placeholder="Please Enter Brand">
              	</div>
              	
              		<div class="mb-3 col-lg-3 col-md-3">
                  <label class="form-label">From Date</label>
                   	<input type="date" name="from" class="form-control" value="<?=$_GET['from']?>"  placeholder="Please Enter Brand">
              	</div>
              	
              		<div class="mb-3 col-lg-3 col-md-3">
                 
                   	<input type="submit" class="btn btn-primary"></button>
              	</div>
              
            </div>
            	</form>

                <div class="row">
                    
					<div class="col-12">
						<div class="card">
							<div class="card-header">
                    <h4 class="card-title"><?php echo 'Sales Report'; ?> </h4>


                </div>
							<div class="card-body">
								<table id="responsiveTable" class="display responsive nowrap" style="width:100%;">
									<thead>
                  <?php 
									  $qry= $this->db->query("select * from tbl_category where cate_id='".$_GET['category']."'");
									  foreach($qry->result() as $size){?>
                      <tr>
                        <th>S. No.</th>
                        <th>Category</th>
                          <th>Brand</th>
                          <th><?php if(!empty($size->size1)){ echo $size->size1.' ml' ;}?></th>
                          <th><?php if(!empty($size->size2)){ echo $size->size2.' ml' ;}?></th>
                          <th><?php if(!empty($size->size3)){ echo $size->size3.' ml' ;}?></th>
                          <th><?php if(!empty($size->size4)){ echo $size->size4.' ml' ;}?></th>
                          <th><?php if(!empty($size->size5)){ echo $size->size5.' ml' ;}?></th>
                        <th>Date</th>
                      </tr>
                      <?php } ?>
									</thead>
									<tbody>
									  <?php $i=1; 
									  if(!empty($_GET['category']) && empty($_GET['to'])){
									  $qry= $this->db->query("select * from tbl_product_out where cate_id='".$_GET['category']."'");
									  }elseif(!empty($_GET['category']) && !empty($_GET['to'])){
									  $category = $this->input->get('category', TRUE);
$date_from = $this->input->get('from', TRUE);
$date_to = $this->input->get('to', TRUE);

$sql = "SELECT * FROM tbl_product_out WHERE cate_id = ? AND order_date BETWEEN ? AND ?";
$query = $this->db->query($sql, array($category, $date_from, $date_to));
}
foreach ($query->result() as $product) {
    // Your code here to process $product


                      $cate  = $this->db->query("select * from tbl_category where cate_id='".$product->cate_id."'");
                      foreach($cate->result() as $cate){
                       $category = $cate->category;
                      }
                      $pro  = $this->db->query("select * from tbl_product_master where product_id='".$product->product_id."'");
                      foreach($pro->result() as $pro){
                       $brand_id = $pro->brand_id;
                      }

                      $brand  = $this->db->query("select * from tbl_brand where brand_id='".$pro->brand_id."'");
                      foreach($brand->result() as $brand){
                       $brand = $brand->brand;
                      }
									  
									  ?>
                    			      <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $category ?></td>
                                       <td><?php echo $brand ?></td>
                                       <td><?php echo $product->qty1; ?></td>
                                       <td><?php echo $product->qty2; ?></td>
                                       <td><?php echo $product->qty3; ?></td>
                                       <td><?php echo $product->qty4; ?></td>
                                       <td><?php echo $product->qty5; ?></td>
                                      <td><?php echo $product->create_date; ?></td>
                                    </tr>
                                      <?php $i++; }?>
									
                                </tbody>
                              </table>
                            </div>
						</div>
					</div>
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        <script>
  function getFilterUrl(filterurl) {
    var url = filterurl;        
      if (url) { 
          window.location = url; //  price change according to size 
      }
      return false;
 }
</script>