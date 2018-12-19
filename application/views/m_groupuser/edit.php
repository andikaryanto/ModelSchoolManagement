<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('ui_edit_data')?></h4>
                      <p class="card-category"> <?= lang('ui_master_groupuser')?></p>
                    </div>
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="index" onclick="window.location.href='<?= base_url('mgroupuser');?>'">
                          <i class="material-icons">list</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('mgroupuser/editsave');?>">
                    <input hidden name ="idgroupuser" id="idgroupuser" value="<?= $model['id']?>">
                    <div class="form-group">
                      <label><?= lang('ui_name')?></label>
                      <input id="named" type="text"  class="form-control" name = "named" value="<?= $model['groupname']?>" required>
                    </div>
                    <div class="form-group">       
                      <label><?= lang('ui_description')?></label>
                      <textarea id="description" type="text" class="form-control" name = "description" ><?= $model['description']?></textarea>
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script>
        $(document).ready(function() {    
         init();
        });

        function init(){
          <?php 
          if($this->session->flashdata('edit_warning_msg'))
          {
            $msg = $this->session->flashdata('edit_warning_msg');
            for($i=0 ; $i<count($msg); $i++)
            {
          ?>
              setNotification("<?= lang($msg[$i]); ?>", 3, "bottom", "right");
          <?php 
            }
          }
          ?>
        }
      </script>