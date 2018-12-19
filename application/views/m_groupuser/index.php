<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title "><?= lang('ui_data')?></h4>
                      <p class="card-category"> <?= lang('ui_master_groupuser')?></p>
                    </div>
                    
                    <div class="col">
                      <div class="text-right">
                        <button type="button" rel="tooltip" class="btn btn-primary btn-round btn-fab" title="<?= lang('ui_add')?>" onclick="window.location.href='<?= base_url('mgroupuser/add');?>'">
                          <i class="material-icons">add</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- <div class="col-sm-12 col-md-6">
                      <div class="dataTables_length" id="datatables_length">
                        <label>Show 
                          <select name="datatables_length" aria-controls="datatables" class="custom-select custom-select-sm form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="-1">All</option>
                          </select> entries
                        </label>
                      </div>
                    </div> -->
                    <div class="col text-right">
                      <label>
                        <span class="bmd-form-group bmd-form-group-sm">
                          <input id="search" type="search" class="form-control form-control-sm" placeholder="Search records" aria-controls="datatables" value = "<?= $search?>">
                        </span>
                      </label>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                          <th># </th>
                          <th><?=  lang('ui_name')?></th>
                          <th><?=  lang('ui_description')?></th>
                          <th></th>
                      </thead>
                      <tbody>
											<?php
												foreach ($modeldetail as $value)
												{
											?>
													<tr>
														<td><?= $startnumber?></td>
														<td><?= $value->GroupName?></td>
														<td><?= $value->Description?></td>
														<td class = "td-actions text-right">
                              <button type="button" rel="tooltip" class="btn btn-primary btn-round" data-original-title="" title="<?=  lang('ui_edit')?>" onclick="window.location.href='<?= base_url('mgroupuser/edit/').$value->Id;?>'">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" class="btn btn-primary btn-round" data-original-title="" title="<?=  lang('ui_role')?>" onclick="window.location.href='<?= base_url('mgroupuser/editrole/').$value->Id;?>'">
                                <i class="material-icons">face</i>
                              </button>
                              <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="<?=  lang('ui_delete')?>" onclick="delete_disaster('<?= $value->Id?>','<?= $value->GroupName?>')">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
													</tr>
                      <?php
                          $startnumber++;
												}
											?>
                      </tbody>
                    </table>
                  </div>
									<div class="row">
                    <div class = "col ">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-primary">
                          
                          <?php if($currentpage > 3)
                          {
                          ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= base_url('m_groupuser');?>?page=<?= $currentpage-1?>&search=<?= $search?>#cardtabel" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                          <?php
                          }
                          ?>
                          <?php for ($i = $firstpage ; $i <= $lastpage; $i++)
                          {
                            if ($currentpage == $i){
                            ?>
                              <li class="page-item">
                                <div class="page-link paging-active" ><?= $i?></div>
                              </li>
                            <?php
                            } else {
                            ?>
                            <li class="page-item">
                              <a class="page-link" href="<?= base_url('m_groupuser');?>?page=<?= $i?>&search=<?= $search?>#cardtabel"><?= $i?></a>
                            </li>
                            <?php
                            }
                            ?>
                          <?php
                          }
                          ?>
                          <?php if($currentpage < $totalpage - 2)
                          {
                          ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= base_url('m_groupuser');?>?page=<?= $currentpage+1?>&search=<?= $search?>#cardtabel" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </nav>
                    </div>
                    <div class = "col text-right">
                      <?= lang('ui_showing')." ".$firstrow." ".lang('ui_to')." ".$lastrow." ".lang('ui_of')." ".$totalrow." ".lang('ui_data')?>
                    </div>
                  </div>
                </div>
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
      if($this->session->flashdata('success_msg'))
      {
        $msg = $this->session->flashdata('success_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?= lang($msg[$i]); ?>", 2, "bottom", "right");
      <?php 
        }
      }

      if($this->session->flashdata('delete_msg'))
      {
        $msg = $this->session->flashdata('delete_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?= lang($msg[$i]); ?>", 2, "bottom", "right");
      <?php 
        }
      }

      if($this->session->flashdata('warning_msg'))
      {
        $msg = $this->session->flashdata('warning_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?= lang($msg[$i]); ?>", 3, "bottom", "right");
      <?php 
        }
      }
    ?>
  }
  
  $("#search").on("keyup",function(e) {
    if (e.keyCode == 13) {
      var search = $("#search").val();
      //alert(search);
      window.location =" <?= base_url('m_groupuser');?>?search="+search;
    }
  })   

  function delete_disaster(id, name){
    deleteData(name, function(result){
      if (result==true)
        window.location = "<?= base_url('mgroupuser/delete/');?>" + id;
    });
  } 
</script>
      