<?php include('common_header.php');?>
    <div class="pageheader">
      <h2><i class="fa fa-pencil"></i> 提测管理 <span>提交代码</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">你的位置:</span>
        <ol class="breadcrumb">
          <li><a href="/">我的控制台</a></li>
          <li><a href="/test/my">提测管理</a></li>
          <li class="active">提交代码</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      
      <div class="row">
        
        <div class="col-md-12">
          <form method="POST" id="basicForm" action="/conf/repos_add" class="form-horizontal">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="panel-close">&times;</a>
                  <a href="" class="minimize">&minus;</a>
                </div>
                <h4 class="panel-title">提交代码</h4>
                <p>请认真填写下面的选项</p>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">相关任务 <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="issue_name" name="issue_name" class="form-control" value="<?php echo $row['issue_name']?>" disabled="" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">代码库</label>
                  <div class="col-sm-9">
                    <select id="repos_id" name="repos_id" class="select2-2" data-placeholder="请选择代码库" required>
                      <option value=""></option>
                      <?php
                      if (isset($repos) && $repos) {
                        foreach ($repos as $value) {
                      ?>
                      <option value="<?php echo $value['id'];?>"><?php echo $value['repos_name_other'];?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">版本号 <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" id="test_flag" name="test_flag" class="form-control" placeholder="请输入版本号" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">说明 </label>
                  <div class="col-sm-9">
                    <textarea id="test_summary" name="test_summary" rows="5" class="form-control" placeholder="请简要说明提测时需要注意的事项"></textarea>
                  </div>
                </div>
              </div><!-- panel-body -->
              <input type="hidden" value="<?php echo $row['id'];?>" id="issue_id" name="issue_id">
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary" id="btnSubmit">提交</button>
                    <button type="reset" class="btn btn-default">重置</button>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
          
        </div><!-- col-md-6 -->
        
      </div><!--row -->
      
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->
  
</section>

<script src="/static/js/jquery-1.11.1.min.js"></script>
<script src="/static/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
<script src="/static/js/modernizr.min.js"></script>
<script src="/static/js/jquery.sparkline.min.js"></script>
<script src="/static/js/toggles.min.js"></script>
<script src="/static/js/retina.min.js"></script>
<script src="/static/js/jquery.cookies.js"></script>

<script src="/static/js/jquery.validate.min.js"></script>
<script src="/static/js/jquery.form.js"></script>
<script src="/static/js/jquery.gritter.min.js"></script>

<script src="/static/js/select2.min.js"></script>

<script src="/static/js/custom.js"></script>

<script>
function validForm(formData,jqForm,options){
  return $("#basicForm").valid();
}

function callBack(data) {
  $("#btnSubmit").attr("disabled", true);
  if(data.status){
    jQuery.gritter.add({
      title: '提醒',
      text: data.message,
        class_name: 'growl-success',
        image: '/static/images/screen.png',
      sticky: false,
      time: ''
    });
    setTimeout(function(){
      location.href = data.url;
    }, 2000);
  } else {
    jQuery.gritter.add({
      title: '提醒',
      text: data.message,
        class_name: 'growl-danger',
        image: '/static/images/screen.png',
      sticky: false,
      time: ''
    });
    setTimeout(function(){
      location.href = data.url;
    }, 2000);
  }
}

jQuery(document).ready(function(){

  $("#basicForm").submit(function(){
    $(this).ajaxSubmit({
      type:"post",
      url: "/test/add_ajax",
      dataType: "JSON",
      beforeSubmit:validForm,
      success:callBack
    });
    return false;
  });

  $("#basicForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    },
  });

  jQuery(".select2-2").select2({
      width: '100%'
  });

});
</script>

</body>
</html>
