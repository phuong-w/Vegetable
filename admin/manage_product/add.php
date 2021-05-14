<?php
    require_once('../db/function.php');

    if(!empty($_POST)){
        $id = $id_category = $title = $price = $content = $thumbnail = $tmp_name = $quantity = $sale = '';
        $thumbnail_src = '../images/products/';

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
            echo "<script>
            $.alert({
                title: 'Thông báo:',
                content: 'Chưa chọn danh mục',
            });
            </script>";
        }else{
            $id_category = $_POST['id_category'];
        }

        $sqldp = "select id from product where title = '$title'";
        $checkName = executeSingleResult($sqldp);

        if (isset($checkName) && $checkName > 0){
        echo "<script>
            $.alert({
                title: 'Thông báo:',
                content: 'Tên đã tồn tại',
            });
        </script>";
        }elseif (!empty($title)){
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
                
                
                $path = str_replace('\\', '/', dirname(getcwd(),1));
                
                move_uploaded_file($tmp_name, $path.'/images/' .  $thumbnail);

                // $thumbnail_src += $thumbnail;
                // //Luu vao db
                $thumbnail_src = $thumbnail_src.$thumbnail;
                
                $sql = "insert into product(title, price, thumbnail, quantity, sale, content, id_category, created_at, updated_at)
                    values('$title', '$price', '$thumbnail_src ', '$quantity', '$sale','$content', '$id_category', '$created_at', '$updated_at')";
                    
                execute($sql);
                header('Location: manage.php?tab=manage_product');
                die();
            }
          
    }
?>
<div class="main">
    <div class="title">
        <a href="">
            <h4>Thêm sản phẩm mới</h4>
        </a>
    </div>

    <div class="main-table">
        <div class="header-table">
            <form  method="POST" class="form-block" enctype="multipart/form-data"> 
                <div class="form-group">
                    <label for="title" class="form-label">Tên sản phẩm*</label>
                    <input type="text" class="form-control" id ="title" name="title" required/>
                </div>

                <div class="form-group">
                    <label for="thumbnail" class="form-label">Chọn ảnh*</label>
                    <br>
                    <input type="file" name="thumbnail" id = "thumbnail"/>
                </div>

                <div class="form-group">
                    <label for="category" class="form-label">Chọn danh mục*</label>
                    <select name="id_category" id="id_category" class="form-control">
                        <option value="unselect" selected>--Lựa chọn danh mục--</option>
                      <?php
                        $sql = 'select * from category';
                        $categoryList = executeResult($sql);
                        foreach ($categoryList as $list){
                          echo '<option value= '.$list['id'].'>'.$list['name'].'</option>';
                        }
                      ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Giá bán*</label>
                    <input type="number" class="form-control" min="0" name="price" id="price" required/>
                </div>

                <div class="form-group">
                    <label for="quantity" class="form-label">Số lượng*</label>
                    <input type="number" class="form-control" min="1" max="500" name="quantity" id="quantity" required/>
                </div>

                <div class="form-group">
                    <label for="sale" class="form-label">Giảm giá (%)*</label>
                    <input type="number" class="form-control" min="0" max="100" minlength="0" maxlength="100" name="sale" id="sale"/>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Nội dung:</label>
                    <textarea name="content" class="form-control" id="content" rows="5"></textarea>
                </div>

                <button name ="submit"class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>