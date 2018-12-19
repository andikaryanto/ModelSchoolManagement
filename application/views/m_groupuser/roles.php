<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?=  $modelheader->GroupName?></h4>
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
                  <div class="table-responsive">
                      <table id = "tblRole" class="table table-striped table-hover">
                          <thead class ="text-primary">
                              <tr>
                              <th><?= lang('ui_module')?></th>
                              <th>Alias</th>
                              <th><?= lang('ui_read')?></th>
                              <th><?= lang('ui_write')?></th>
                              <th><?= lang('ui_delete')?></th>
                              <th><?= lang('ui_print')?></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                  $i = 1;
                                  foreach ($modeldetail as $value)
                                  {
                              ?>
                              <tr>
                                  <td id = "td<?= $i ?>formid" hidden = "true"><?= $value->FormId?></td>
                                  <?php if($value->Header == 0) { ?>
                                    <td id = "td<?= $i ?>aliasname"><?= $value->AliasName?></td>
                                  <?php } else {?>
                                    <td><b><?= $value->AliasName?></b></td>
                                  <?php }?>
                                  <td id = "td<?= $i ?>localname"><?= $value->LocalName?></td>
                                  <td id = "td<?= $i ?>tdread">
                                    <div class = "form-check">
                                        <label class="form-check-label">
                                            <?php if($value->Header ==0) { ?>
                                                <input class = "form-check-input" id = "td<?= $i ?>read" type="checkbox" value = "td~<?= $i ?>~read" <?php if($value->Readd == 1)
                                                                        {
                                                                    ?>
                                                                        checked=""
                                                                    <?php
                                                                        }
                                                                    ?>>
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            <?php } ?>
                                        </label>
                                    </div>
                                  </td>
                                  <td id = "td<?= $i ?>tdwrite">
                                    <div class = "form-check">
                                        <label class="form-check-label">
                                            <?php if($value->Header ==0) { ?>
                                                <input class = "form-check-input" id = "td<?= $i ?>write" type="checkbox" value = "td~<?= $i ?>~write"<?php if($value->Writee == 1)
                                                                        {
                                                                    ?>
                                                                        checked=""
                                                                    <?php
                                                                        }
                                                                    ?>>
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            <?php } ?>
                                        </label>
                                    </div>
                                  </td>
                                  <td id = "td<?= $i ?>tddelete">                                  
                                    <div class = "form-check">
                                        <label class="form-check-label">
                                            <?php if($value->Header ==0) { ?>
                                                <input class = "form-check-input" id = "td<?= $i ?>delete" type="checkbox" value = "td~<?= $i ?>~delete" <?php if($value->Deletee == 1)
                                                                        {
                                                                    ?>
                                                                        checked=""
                                                                    <?php
                                                                        }
                                                                    ?>>
                                                
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            <?php } ?>
                                        </label>
                                    </div>
                                  </td>
                                  <td id = "td<?= $i ?>tdprint">                                 
                                    <div class = "form-check">
                                        <label class="form-check-label">
                                            <?php if($value->Header ==0) { ?>
                                                <input class = "form-check-input" id ="td<?= $i ?>print" type="checkbox" value = "td~<?= $i ?>~print"<?php if($value->Printt == 1)
                                                                        {
                                                                    ?>
                                                                        checked=""
                                                                    <?php
                                                                        }
                                                                    ?>>
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            <?php } ?>
                                        </label>
                                    </div>
                                  </td>
                              </tr>
                              <?php
                                  
                                  $i++;
                                  }
                              ?>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

<script>
    $("#searchbutton").on("click",function() {
        var search = $("#search").val();
        console.log('<?= json_encode($modeldetail);?>');
        //window.location =" <?= base_url('m_groupuser');?>?search="+search;
    });

    $("#btnSave").on("click",function() {
        var oTable = document.getElementById('tblRole');
        var i;
        var rowLength = oTable.rows.length;
        for (i = 1; i < rowLength; i++) {
        $.ajax({
            type:"POST",
            url:"<?= base_url('M_groupuser/saverole')?>",
            data:{
                groupid: <?= $modelheader->Id?>,
                formid : document.getElementById("td"+i+"formid").innerHTML,
                read : $("#td"+i+"read").is(":checked") == true ? 1 : 0,
                write : $("#td"+i+"write").is(":checked") == true ? 1 : 0,
                delete : $("#td"+i+"delete").is(":checked") == true ? 1 : 0,
                print : $("#td"+i+"print").is(":checked") == true ? 1 : 0
                },
            success:function(data){
            }
        });
        
        }
    });

    $(":checkbox").on("change", function(e) {
        var numbid = this.value.split("~")[1];
        $.ajax({
            type:"POST",
            url:"<?= base_url('M_groupuser/saverole')?>",
            data:{
                groupid: <?= $modelheader->Id?>,
                formid : document.getElementById("td"+numbid+"formid").innerHTML,
                read : $("#td"+numbid+"read").is(":checked") == true ? 1 : 0,
                write : $("#td"+numbid+"write").is(":checked") == true ? 1 : 0,
                delete : $("#td"+numbid+"delete").is(":checked") == true ? 1 : 0,
                print : $("#td"+numbid+"print").is(":checked") == true ? 1 : 0
                },
            success:function(data){
            }
        });
    });
</script>
      