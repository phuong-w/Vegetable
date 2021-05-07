<div id="content">

  <div class="section-2 section" style="background-color: #f5f5f5;">
      <div class="container">
          <div class="row">
              <div id="product-home">
                  <div class="col-md-3">
                      <h4 id="tile-product-2" style="text-align: center; font-weight: bold; margin-top: 0px;">MENU</h4>

                      <ul id="menu-product-home">
                        <a href="index.php?page_layout=product"><li class="click">All Goods</li></a>
                        <?php
                            $sql = 'select * from category order by id asc';
                            $categoryList = executeResult($sql);

                            foreach ($categoryList as $category){
                                echo '<a href="index.php?page_layout=product&id='.$category['id'].'"><li>'.$category['name'].'</li></a>';
                            }
                        ?>
                      </ul>
                  </div>

                  <div class="col-md-9">
                      <p id="text-title-product"><span>&#8212;</span> Fresh from our farm <span>&#8212;</span></p>

                        <?php include_once 'products.php';
                        ?>

                  </div>
              </div>


          </div>
      </div>
  </div>


</div>