<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('ui_usersetting')?></h4>
                    </div>
                    <div class="col">
                    </div>
                  </div>
                </div>
                <div class="card-body">                 
                  <form method = "post" action = "<?= base_url('savesettings');?>">
                    <input hidden id = "languageid" name = "languageid" type="text">
                    <input hidden id = "rowperpage" name = "rowperpage" type="text">
                    <div class="form-group">
                      <div class = "row">
                          <label class="col-sm-2 col-form-label"><?= lang('ui_language')?></label>
                          <div class="col">
                          <div class="dropdown bootstrap-select show-tick">
                            <select id = "language" name ="language" class="selectpicker" data-style="select-with-transition" title ="<?= $_SESSION['usersetting']->Language?>" >
                              <?php 	
                              foreach ($enums['languageenums'] as $value)
                              { 
                              ?>
                                <option value ="<?= $value->Id?>"><?= $value->Name?></option>
                              <?php 
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">    
                      <div class = "row">
                        <label class="col-sm-2 col-form-label label-checkbox"><?= lang('ui_color')?></label>
                        <div class="col-sm-10 checkbox-radios">
                          <?php 	
                          $i=1;
                          foreach ($enums['colorenums'] as $value)
                          { 
                            $option = "option~".$value->Id;
                          ?>
                            <div class="form-check form-check-inline">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="radiocolor" id="exampleRadios1" value="<?= $option?>" 
                                  <?php if($_SESSION['usersetting']->ColorId == $value->Id){
                                  ?>
                                    checked
                                  <?php
                                  }?>
                                > 
                                <div style = "color : <?= $value->Value?>"><?= $value->Name?></div>
                                <span class="circle">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          <?php 
                          $i++;
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class = "row">
                          <label class="col-sm-2 col-form-label"><?= lang('ui_rowperpage')?></label>
                          <div class="col">
                          <div class="dropdown bootstrap-select show-tick">
                            <select id = "rowpage" name ="rowpage" class="selectpicker" data-style="select-with-transition" title ="<?= $_SESSION['usersetting']->RowPerpage?>" >
                              <option value ="5">5</option>
                              <option value ="10">10</option>
                              <option value ="15">15</option>
                            </select>
                          </div>
                        </div>
                      </div>
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

<script>
  $(document).ready(function() {    
    init();
    $("#language").val("<?= $_SESSION['usersetting']->LanguageId?>");
    $("#languageid").val("<?= $_SESSION['usersetting']->LanguageId?>");
    $("#rowperpage").val("<?= $_SESSION['usersetting']->RowPerpage?>");
  });

  function init(){
    <?php 
    if($this->session->flashdata('add_warning_msg'))
    {
      $msg = $this->session->flashdata('add_warning_msg');
      for($i=0 ; $i<count($msg); $i++)
      {
    ?>
        setNotification("<?= lang($msg[$i]); ?>", 3, "bottom", "right");
    <?php 
      }
    }
    ?>
  }
  
  $("#language").on("change", function(e){
    var data = $(this).children("option:selected").val();
    $("#languageid").val(data);
  });

  $("#rowpage").on("change", function(e){
    var data = $(this).children("option:selected").val();
    $("#rowperpage").val(data);
  });

</script>