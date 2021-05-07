<?php
  require_once '../db/function.php';

  $id = $title = $id_category = $price = $quantity = $sale = $content = $thumbnail = $thumbnail_src = ''; // bien chung

  if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'select * from product where id = '.$id;

    $product = executeSingleResult($sql); // lay 1 doi tuong

    if ($product != null){
      $title  = $product['title'];
      $id_category  = $product['id_category'];
      $price  = $product['price'];
      $quantity  = $product['quantity'];
      $sale  = $product['sale'];
      $content  = $product['content'];
      $thumbnail = $product['thumbnail'];
      $thumbnail_src  = $thumbnail;
      

    }else{
      $id = '';
    }
  }


  if(!empty($_POST)){

    if (isset($_POST['title'])){
      $title = $_POST['title'];
    }

    if (isset($_POST['id'])){
        $id = $_POST['id'];
    }

    if (isset($_POST['id_category'])){
        $id_category = $_POST['id_category'];
    }

    if (isset($_POST['price'])){
        $price = $_POST['price'];
    }

    if (isset($_POST['quantity'])){
        $quantity = $_POST['quantity'];
    }

    if (isset($_POST['sale'])){
        $sale = $_POST['sale'];
    }

    if (isset($_POST['content'])){
        $content = $_POST['content'];
    }

    // xu ly file
    if (isset($_FILES['thumbnail']['name']) ==  ''){
        $error_thumbnail = '<span style="color: red;">{*}</span>';
    }else{
        $thumbnail = $_FILES['thumbnail']['name'];
        $tmp_name = $_FILES['thumbnail']['tmp_name'];

    }

    //check select option
    if ($_POST['id_category'] == 'unselect'){
        echo '<span style="color: red;">{*}</span>';
    }else{
        $id_category = $_POST['id_category'];
    }


    if (!empty($title)){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $created_at = $updated_at = date('Y-m-d H:i:s');
        //check loi dau
        $id = str_replace('\'', '\\\'', $id);
        $id_category = str_replace('\'', '\\\'', $id_category);
        $title = str_replace('\'', '\\\'', $title);
        $price = str_replace('\'', '\\\'', $price);
        $content = str_replace('\'', '\\\'', $content);
        $thumbnail_src = str_replace('\'', '\\\'', $thumbnail_src);
        $quantity = str_replace('\'', '\\\'', $quantity);
        $sale = str_replace('\'', '\\\'', $sale);


        move_uploaded_file($tmp_name, 'images/' .  $thumbnail);
        if ($_FILES['thumbnail']['name'] != ''){
          $thumbnail = $_FILES['thumbnail']['name'];
          $thumbnail_src = '../images/products/'.$thumbnail;
        }
        

        // $thumbnail_src += $thumbnail;
        // //Luu vao db
        
        $sql = "update product set title = '$title', id_category = '$id_category', price = '$price',thumbnail = '$thumbnail_src', quantity = '$quantity', sale = '$sale', content = '$content', created_at = '$created_at', updated_at = '$updated_at' where id =".$id ;
        
        echo $thumbnail_src;
        echo $thumbnail_src;
        execute($sql);
        header('Location: manage.php?page_layout=manage_product');
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
            <form  method="POST" class="form-block" enctype="multipart/form-data"> 
                <div class="form-group">
                    <label for="title" class="form-label">Tên sản phẩm*</label>
                    <input type="text" class="form-control" id ="title" name="title" value="<?=$title?>" />
                </div>

                <div class="form-group">
                    <label for="thumbnail" class="form-label">Chọn ảnh*</label>
                    <br>
                    <input type="file" name="thumbnail" id = "thumbnail"/>
                </div>

                <div class="form-group">
                    <label for="category" class="form-label">Chọn danh mục*</label>
                    <select name="id_category" id="id_category" class="form-control">
                        <option value="unselect">--Lựa chọn danh mục--</option>
                      <?php
                        $sql = 'select * from category';
                        $categoryList = executeResult($sql);
                        foreach ($categoryList as $list){
                          if ($list['id'] == $id_category){
                          echo '<option selected value= '.$list['id'].'>'.$list['name'].'</option>';
                          }else{
                          echo '<option value= '.$list['id'].'>'.$list['name'].'</option>';
                          }
                        }
                      ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Giá bán*</label>
                    <input type="number" class="form-control" name="price" id="price" value="<?=$price?>"/>
                </div>

                <div class="form-group">
                    <label for="quantity" class="form-label">Số lượng*</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="<?=$quantity?>"/>
                </div>

                <div class="form-group">
                    <label for="sale" class="form-label">Giảm giá (%)*</label>
                    <input type="number" class="form-control" name="sale" min="0" max="100" minlength="0" maxlength="100" id="sale" value="<?=$sale?>"/>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Nội dung:</label>
                    <textarea name="content" class="form-control" id="content" rows="5"><?=$content?></textarea>
                </div>

                <button name ="submit"class="btn btn-success">Cập nhật</button>
            </form>
        </div>
    </div>
</div>