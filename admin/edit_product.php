<?PHP include('includes/header.php'); ?>
<style>
.results {

    color: #009966;
}

.results1 {
    color: #FF0000;
}
</style>

<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <?php
        include('inc/myconnect.php');
        include('inc/function.php');
        include('inc/images_helper.php');
            //
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $id = $_GET['id'];
        } else {
            header("Location: list_product.php");
            exit();
        }

            //bat dau submit
        if (isset($_POST['submit'])) {
            $errors = array();
            // Kiem tra gia ban vs gia san pham
            if( isset($_POST['price_product']) && isset($_POST['saleprice_product']) ){
                if ($_POST['price_product'] > $_POST['saleprice_product']) {
                    $errors[] = 'price';
                }
            }
            // loại product
            if (empty($_POST['id_loai'])) {
                $errors[] = 'saleprice_product';
            } else {
                $id_loai = ($_POST['id_loai']);
            }
            // hiệu product
            if (empty($_POST['label_product'])) {
                $errors[] = 'label_product';
            } else {
                $label = ($_POST['label_product']);
            }
                // tên sản phẩm
            if (empty($_POST['name_product'])) {
                $errors[] = 'name_product';
            } else {
                $name = $_POST['name_product'];
            }
                // giá sản phẩm
            if (empty($_POST['price_product'])) {
                $errors[] = 'price_product';
            } else {
                $price = $_POST['price_product'];
            }
                // giá bán sản phẩm
            if (empty($_POST['saleprice_product'])) {
                $errors[] = 'saleprice_product';
            } else {
                $saleprice = $_POST['saleprice_product'];
            }
                // mô tả sản phẩm
            if (empty($_POST['describe_product'])) {
                $describe = "";
            } else {
                $describe = $_POST['describe_product'];
            }
            $status = $_POST['status'];
            if (empty($errors)) {
                $link_image ="";
                $link_image_thump ="";
                $link_image = implode(" ", $_POST['anh_hi']);
                $link_image_thump = implode(" ", $_POST['anhthumb_hi']);
                 // Duyệt mảng
                // echo "<pre>";
                // print_r($_FILES['img']);
                // echo "</pre>";
                foreach ($_FILES['img']['name'] as $key => $value) {
                    if (($_FILES['img']['type'][$key] != "image/png") &&
                        ($_FILES['img']['type'][$key] != "image/gif") &&
                        ($_FILES['img']['type'][$key] != "image/jpg") &&
                        ($_FILES['img']['type'][$key] != "image/jpeg")
                    ) {
                        $massge = "<p class='results1'>File không đúng định dạng !!</p>";
                } elseif (($_FILES['img']['size'][$key] > 1000000)) {
                    $massge = "<p class='results1'>Kích thước phải nhỏ hơn 1MB !!</p>";
                } else {

                   $img = str_replace(" ","",$_FILES['img']['name'][$key]);
                   $link_img = 'upload/' . $img;
                   move_uploaded_file($_FILES['img']['tmp_name'][$key], "../upload/" . $img);
                            //xử lí resize, crop hinh anh
                   $temp = explode('.', $img);
                   if ($temp[1] == 'jpeg' or $temp[1] == 'JPEG') {
                    $temp[1] = "jpg";
                }
                $temp[1] = strtolower($temp[1]);
                            $thump = 'upload/resize/' . $temp[0] . '_thump' . '.' . $temp[1]; // đường dẫn
                            $imageThump = new Image("../".$link_img);
                            if ($imageThump->getWidth() > 460) {
                                $imageThump->resize(460, 613,"resize");
                            }
                            $imageThump->save($temp[0] . '_thump', '../upload/resize'); //ten voi duong dan luu anh
                            $link_image .=" " . $link_img;
                            $link_image_thump .= " " .$thump;
                        }
                    }//ket thuc foreach
                    // echo $link_image . "         ....................................            " . $link_image_thump . "<br>";

                    $query_in = "UPDATE tb_product SET 
                    name_product = '$name',
                    image = '$link_image',
                    image_thump = '$link_image_thump',
                    price_product = '$price',
                    saleprice_product = '$saleprice',
                    describe_product = '$describe',
                    status_product = '$status',
                    id_category = " . $id_loai .",
                    id_label = {$label}
                    WHERE id_product='$id'";
                    // echo $query_in;
                    $result_in = mysqli_query($dbc, $query_in);
                    kt_query($query_in, $result_in);
                    if ($result_in == 1) {
                        echo "<p class='results'>Chỉnh sửa thành công</p>";
                        $_POST['code_product'] = "";
                        $_POST['name_product'] = "";
                        $_POST['price_product'] = "";
                        $_POST['saleprice_product'] = "";
                        $_POST['describe_product'] = "";
                    } else {
                        echo "<p class='results1'>Chỉnh sửa không thành công</p>";
                    }
                } else {
                    $message = "<p class='results1'> Bạn hãy nhập đầy đủ thông tin </p>";
                }
            }
            //ket thuc submit
            $query = "SELECT * FROM tb_product  WHERE id_product={$id}";
            $result = mysqli_query($dbc, $query);
            $dong = mysqli_fetch_array($result, MYSQLI_ASSOC);
            kt_query($query, $result);
            //kiem tra id có tồn tại không
            if (mysqli_num_rows($result)) {

            } else {
                if (in_array('price', $errors)) {
                    $message = "<p class='results1'>Giá sản phẩm không được lớn hơn giá bán </p>";
                } else {
                 $message = "<p class='results1'> Bạn hãy nhập đầy đủ thông tin </p>";
             }

            // print_r($errors);
         }
         ?>
         <form name="frmedit-product" method="post" enctype="multipart/form-data" class="frmedit-product">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <h3 style="color: red;">Chỉnh sửa - sản phẩm "<?php echo $dong['name_product']; ?>"</h3>
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="name_product" value="<?php echo $dong['name_product']; ?>"
                class="form-control" placeholder='Nhập tên sản phẩm'/>
                <?php
                if (isset($errors) && in_array('code_product', $errors)) {
                    echo "<p class='results1'> Bạn hãy nhập tên sản phẩm</p>";
                }
                ?>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group wrap-category" id="<?php echo $dong['id_category']; ?>">
                        <label>Thuộc loại : </label>
                        <?php ctrSelect('id_loai', 'class'); ?>
                        <?php
                        if (isset($errors) && in_array('id_loai', $errors)) {
                            echo "<p class='results1' >Bạn hãy nhập mã sản phẩm</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Hiệu Sản phẩm</label>
                        <select name="label_product" style='padding:5px 10px;border-radius:4px;display: block;'>
                            <option value="" style="color: #999">- - - Chưa có hiệu - - -</option>
                            <?php
                            $query_label = "SELECT* FROM tb_label";
                            $result_label = mysqli_query($dbc, $query_label);
                            kt_query($query_label, $result_label);
                            while ($label = mysqli_fetch_array($result_label, MYSQLI_ASSOC)) {
                                ?>
                                <option style="text-transform: capitalize;"
                                value="<?php echo $label['id_label']; ?>" <?php if($label['id_label'] == $dong['id_label']) { echo "selected='selected'";} ?> ><?php echo $label['name_label']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>    
            


            <div class="form-group">
                <label>Ảnh sản phẩm</label>
                <div class="wrap-img">
                    <?php  
                    $array_img = explode(" ", $dong['image']);
                    $array_img_thumb =  explode(" ", $dong['image_thump']);
                        // echo "<pre>";
                        // print_r($array_img_thumb);
                        // echo "</pre>";
                    for($i = 0; $i < count($array_img)-1; $i++ ) {
                        ?>
                        <span class="item">
                            <span class="delete"><i class="glyphicon glyphicon-remove"></i></span>
                            <div class="icon"><i class="glyphicon glyphicon-camera"></i></div>
                            <img src="../<?php echo $array_img[$i]; ?>" class="item-img">
                            <input type="hidden" name="anh_hi[]" value="<?php echo $array_img[$i]; ?>" class="input-hi">
                            <input type="hidden" name="anhthumb_hi[]" value="<?php echo $array_img_thumb[$i]; ?>" class="input-hi">
                            <input type="file" name="img[]" class="file" ">
                        </span>
                        <?php 
                    }
                    ?>
                    <div class="more"><i class="glyphicon glyphicon-plus"></i></div>
                </div>

                <div class="clearfix"></div>
            </div>
            
            <div class="form-group wrap-size">
                <label>Chọn loại size: </label>
                <div class="title">
                    <input type="radio" name="category" value="t" id="text" class="category_size" checked="checked "> 
                    <label for="text">Size chữ</label>

                    <input type="radio" name="category" value="n" id="number"  class="category_size">
                    <label for="number">Size số</label>
                </div>
                <div class="all-size">
                    <?php 
                    if (isset($dong['size_product']) && !empty($dong['size_product']) ) {

                        foreach (Unserialize($dong['size_product']) as $key => $value) {
                            echo $key;
                            if ($key == 's' || $key == 'm' || $key == 'l' || $key == 'xl' || $key == 'xxl' || $key == 'xxxl') {
                                echo "---";
                             temlate_size_text($key,$value);
                         }
                     };
                 }
                 ?>











             </div>
         </div>

         <div class="form-group">
            <label>Giá sản phẩm</label>
            <input type="text" name="price_product" value="<?php if (isset($_POST['price_product'])) {
                echo $_POST['price_product'];
            }
            echo number_format($dong['price_product']); ?>" class="form-control"
            placeholder='Nhập giá sản phẩm'/>
            <?php
            if (isset($errors) && in_array('price_product', $errors)) {
                echo "<p class='results1' >Bạn hãy nhập giá sản phẩm</p>";
            }
            ?>
        </div>

        <div class="form-group">
            <label>Giá bán sản phẩm</label>
            <input type="text" name="saleprice_product" value="<?php if (isset($_POST['saleprice_product'])) {
                echo $_POST['saleprice_product'];
            }
            echo number_format($dong['saleprice_product']); ?>" class="form-control"
            placeholder='Nhập giá bán sản phẩm'/>
            <?php
            if (isset($errors) && in_array('saleprice_product', $errors)) {
                echo "<p class='results1' >Bạn hãy nhập giá bán sản phẩm</p>";
            }
            ?>
        </div>


        <div class="form-group">
            <label>Mô tả sản phẩm</label>
            <textarea rows="7"  name="describe_product" value="" class="form-control"><?php if (isset($_POST['describe_product'])) {
                echo $_POST['describe_product'];
            }
            echo $dong['describe_product']; ?></textarea>
            <?php
            if (isset($errors) && in_array('describe_product', $errors)) {
                echo "<p class='results1' >Bạn hãy nhập mô tả sản phẩm</p>";
            }
            ?>
        </div>

        <div class="form-group">
            <label style="display:block">Trạng thái</label>

            <label class="radio-inline"> <input type="radio" name="status" value="1" checked="checked"/>
                <p class="results"> Còn hàng</p>
            </label>
            <label class="radio-inline"> <input type="radio" name="status" value="0"/>
                <p class="results1"> Hết hàng</p></label>
            </div>



            <input type="submit" name="submit" class="btn btn-primary" value="Chỉnh sửa"/>

        </form>
    </div>
</div>

<?PHP include('includes/footer.php'); ?>
<script type="text/javascript">
    window.onload = function()
    {   
            // auto open sidebar
            $(".wrap-sidebar #menu").addClass("in");
            //
            $(".class option").each(function(){
                if($(this).attr("value") ==  $(".wrap-category").attr("id")) { $(this).attr("selected", "selected")};
            });
            var i = 0;
            $(".more").click(function(e){
                $(this).before(`<span class="item">
                    <div class="icon"><i class="glyphicon glyphicon-camera"></i></div>
                    <input type="file" name="img[]" class="file">
                    </span>`);
                $('.item').fadeIn("slow");
            });
            $("body").on("change", ".file", function(){
                if(this.files.length > 0){
                    i++;
                    $(this).parent().find("img").remove();
                    $(this).parent().find(".input-hi").remove();
                    $(this).before('<span class="delete"><i class="glyphicon glyphicon-remove"></i></span>');
                    $(this).before("<img src='' class='img" + i + " item-img" +"'/>");
                    var ready = new FileReader();
                    ready.onload  = function(e){
                        $('.img' + i).attr('src', e.srcElement.result);
                    };

                    ready.readAsDataURL(this.files[0]);
                }

            });
            $("body").on("click", ".delete", function(){
               $(this).parent().remove();
           })
        };
    </script>
    <script type="text/javascript">
    // auto open sidebar
    $(".wrap-sidebar #menu").addClass("in");
    //
    $('.wrap-size').on('change', '.category_size', function(){
        if($(this).val() == 't' ) {
            $(".wrap-size .all-size").html(size_text);
        } else {
            $(".wrap-size .all-size").html(size_number);
        }
    })
    $('.wrap-size .all-size').on('change', '.check', function(){
        if ( this.checked ) {
            $(this).next().next().removeAttr('disabled');
        } else {
            $(this).next().next().attr('disabled', 'disabled');
        }
    })


    var size_number = `
    <input type="checkbox" id="27" name="size_27" value="27" class="check">
    <label for="27" class="title-size">27</label>
    <input type="number" name="sl_27" value="1"  disabled="disabled" class="number">

    <input type="checkbox" id="28" name="size_28" value="28" class="check">
    <label for="28" class="title-size">28</label>
    <input type="number" name="sl_28" value="1"  disabled="disabled" class="number">

    <input type="checkbox" id="29" name="size_29" value="29" class="check">
    <label for="29" class="title-size">29</label>
    <input type="number" name="sl_29" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="30" name="size_30" value="30" class="check">
    <label for="30" class="title-size">30</label>
    <input type="number" name="sl_30" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="31" name="size_31" value="31" class="check">
    <label for="31" class="title-size">31</label>
    <input type="number" name="sl_31" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="32" name="size_32" value="32" class="check">
    <label for="32" class="title-size">32</label>
    <input type="number" name="sl_32" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="33" name="size_33" value="33" class="check">
    <label for="33" class="title-size">33</label>
    <input type="number" name="sl_33" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="34" name="size_34" value="34" class="check">
    <label for="34" class="title-size">34</label>
    <input type="number" name="sl_34" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="35" name="size_35" value="35" class="check">
    <label for="35" class="title-size">35</label>
    <input type="number" name="sl_36" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="36" name="size_36" value="36" class="check">
    <label for="36" class="title-size">36</label>
    <input type="number" name="sl_36" value="1" disabled="disabled" class="number">`;
    var size_text = `
    <input type="checkbox" id="s" name="size_s" value="s" class="check">
    <label for="s" class="title-size">S</label>
    <input type="number" name="sl_s" value="1"  disabled="disabled" class="number">

    <input type="checkbox" id="m" name="size_m" value="m" class="check">
    <label for="m" class="title-size">M</label>
    <input type="number" name="sl_m" value="1"  disabled="disabled" class="number">

    <input type="checkbox" id="l" name="size_l" value="l" class="check">
    <label for="l" class="title-size">L</label>
    <input type="number" name="sl_l" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="xl" name="size_xl" value="xl" class="check">
    <label for="xl" class="title-size">XL</label>
    <input type="number" name="sl_xl" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="xxl" name="size_xl" value="xxl" class="check">
    <label for="xxl" class="title-size">XXL</label>
    <input type="number" name="sl_xxl" value="1" disabled="disabled" class="number">

    <input type="checkbox" id="xxxl" name="size_xl" value="xxxl" class="check">
    <label for="xxxl" class="title-size">XXXL</label>
    <input type="number" name="sl_xxxl" value="1" disabled="disabled" class="number">`;
</script>
