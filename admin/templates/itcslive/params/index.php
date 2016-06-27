<?php  
	error_reporting(0); 
?>
<div style="min-height: 601px;" id="page-content" class="clearfix ng-scope">
    <div style="" id="wrap" class="mainview-animation ng-scope">
      <div class="ng-scope" id="page-heading">
       <h1>Params</h1>
	   <div class="clear"></div>
	   <ul class="allOption">
	   <?php foreach($this->ConfigMenu as $eachMenu): ?>
	   		<li><a href="index.php?view=params&param_index=<?php echo $eachMenu["param_index"]; ?>"><?php echo $eachMenu["name"]; ?></a></li>
	   <?php endforeach; ?>
	   </ul>
      </div>
      <div class="container ng-scope" >
	  <form name="paramForm" id="paramForm" class="paramForm" method="post" enctype="multipart/form-data">
        <div class="row">
          <div id="param_block">
         <?php echo  $this->Generatedhtml; ?>        
          </div><!--end of tab strip-->
        </div>
		<p><input type="submit" value="Save" /></p>
		<input type="hidden" name="config_name" value="<?php echo $this->filename; ?>" />
		<input type="hidden" name="view" value="params" />
		<input type="hidden" name="task" value="saveConfig" />
		</form>
		<div class="clear"></div>
      </div>
      <!-- container -->
    </div>
    <!--wrap -->
  </div>
  <!-- page-content -->
  <div class="clear"></div>
  <script>
                $(document).ready(function() {
                    $("#param_block").kendoTabStrip({
                        animation:  {
                            open: {
                                effects: "fadeIn"
                            }
                        }
                    });
                });
</script>
<style scoped>
                #param_block {
                    width: 90%;
                    margin: 30px auto;
                }

                #param_block h2 {
                    font-weight: lighter;
                    font-size: 5em;
                    padding: 0;
                    margin: 0;
                }

                #param_block h2 span {
                    background: none;
                    padding-left: 5px;
                    font-size: .5em;
                    vertical-align: top;
                }

                #param_block p {
                    margin: 0;
                    padding: 0;
                }
				ul.allOption {list-style-type:none;}
				ul.allOption li {background:#3399FF; color:#fff; padding:5px 10px; float:left; margin:0 10px 0 0;}
				ul.allOption li a {color:#fff; text-decoration:none;}
				ul.allOption li a:hover{color:#000;}
				
            </style>