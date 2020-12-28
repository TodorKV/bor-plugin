<div class="w-100 p-3 list-projects-div">
    <div class="card"  style="max-width: 144rem;">
            <div class="card-header bg-info text-white">List Projects</div>
            <div class="card-body">

                <table id="table-list-project" class="display" style="width:100%">
                  <thead>
                      <tr>
                        <th>Project Code</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                            if(count($projects) > 0){
                                foreach($projects as $index => $data){
                                    ?>
                                    <tr>
                                        <td> <?php echo $data->id ?> </td> 
                                        <td> <?php echo strtoupper($data->name) ?> </td> 
                                        <td> <?php echo $data->description ?> </td> 

                                        <td> <?php echo $data->created_at ?> </td> 
                                        <td> <?php echo $data->end_date ?> </td> 
                                        <td> 
                                           <button class="btn btn-success btn-edit-project" data-id="<?php echo $data->id ?>">Edit</button>
                                           <button class="btn btn-danger btn-delete-project" data-id="<?php echo $data->id ?>">Delete</button>
                                        </td> 
                                    </tr>
                                    <?php
                                }
                            }
                        ?>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Project Code</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>

            </div>
    </div>
</div>

<div class="container edit-project-div">
  <div class="panel-group">
    <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
        <div class="card">
        <div class="card-header bg-info text-white">
            Edit Bor Project
            <div class="col-sm-offset-2 col-sm-10">
              <button type="cancel" class="btn btn-danger cancel-btn">Cancel</button>
            </div>
        </div>
            <div class="card-body">

                <form class="form-horizontal" action="javascript:void(0)" id="frm-update-book" method="post" data-id="">

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="txt_name">Project Name:</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control text-name-input" required id="txt_name" name="txt_name" placeholder="Enter project name">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="txt_description">Project description:</label>
                      <div class="col-sm-12">
                        <textarea class="form-control text-desc-input" required id="txt_description" name="txt_description" placeholder="Enter project description"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="end_date">End Date</label>
                      <div class="col-sm-4">
                        <input class="date-input" type="date" id="birthday" name="end_date">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary update-btn" data-id="">Update Project</button>
                      </div>
                    </div>
                 
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

