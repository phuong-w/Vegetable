<?php
  require_once '../db/function.php';

  $id = ''; // bien chung

  if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'select * from category where id = '.$id;

    $category = executeSingleResult($sql); // lay 1 doi tuong

    if ($category != null){
      $name = $category['name'];
    }else{
      $id = '';
    }
  }

  if(!empty($_POST)){
    $name = '';
    if (isset($_POST['edit_name_category'])){
      $name = $_POST['edit_name_category'];
    }

    if (!empty($name)){
      date_default_timezone_set("Asia/Ho_Chi_Minh");
      $created_at = $updated_at = date('Y-m-d H:i:s');
      //Luu vao db
      $name = str_replace('\'', '\\\'', $name);
      $id = str_replace('\'', '\\\'', $id);
      
      $sql = "update category set name = '$name', created_at = '$created_at', updated_at = '$updated_at' where id = '$id'";
            
      execute($sql);
      header('Location: manage.php?page_layout=manage_category');
      die();
    }
}
?>

<div class="main">
    <div class="title">
        <a href="">
            <h4>Sửa danh mục</h4>
        </a>
    </div>

    <div class="main-table">
        <div class="header-table">
            <form method="POST" class="form-block">
                <div class="form-group">
                    <label for="edit_name_category" class="form-label">Tên danh mục*</label>
                    <input type="number" name="id" value="<?=$id?>" style="display: none">
                    <input type="text" class="form-control" id ="edit_name_category" name="edit_name_category" value="<?=$name?>" />
                </div>
                <button class="btn btn-success">Lưu lại</button>
            </form>
        </div>
    </div>
</div>