<?php
    require_once('../db/function.php');

    if(!empty($_POST)){
        $name = '';
        if (isset($_POST['add_name_category'])){
          $name = $_POST['add_name_category'];
        }

        if (!empty($name)){
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $created_at = $updated_at = date('Y-m-d H:i:s');
            //Luu vao db
            $name = str_replace('\"', '\\\"', $name);
            
            $sql = 'insert into category(name, created_at, updated_at)
                  values ("'.$name.'", "'.$created_at.'", "'.$updated_at.'")';
                  
            execute($sql);
            header('Location: manage.php?tab=manage_category');
            die();
          }
          
        
    }
?>
<div class="main">
    <div class="title">
        <a href="">
            <h4>Thêm danh mục mới</h4>
        </a>
    </div>

    <div class="main-table">
        <div class="header-table">
            <form method="POST" class="form-block">
                <div class="form-group">
                    <label for="add_name_category" class="form-label">Tên danh mục*</label>
                    <input type="text" class="form-control" id ="add_name_category" name="add_name_category" value="" />
                </div>
                <button class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>