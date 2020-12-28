<div class="container">
  <div class="panel-group">
    <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
        <div class="card">
        <div class="card-header bg-info text-white">edit Bor Project</div>
            <div class="card-body">

                <form class="form-horizontal" action="javascript:void(0)" id="frm-create-book" method="post">

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="txt_name">Project Name:</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" required id="txt_name" name="txt_name" placeholder="Enter project name">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="txt_description">Project description:</label>
                      <div class="col-sm-12">
                        <textarea class="form-control" required id="txt_description" name="txt_description" placeholder="Enter project description"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-4" for="end_date">End Date</label>
                      <div class="col-sm-4">
                        <input type="date" id="birthday" name="end_date">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Create Project</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</div>