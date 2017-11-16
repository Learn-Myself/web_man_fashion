<?php
include('inc/myconnect.php');
include('inc/function.php');
//error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quần áo nam đẹp, quần áo hàng hiệu, cao cấp kiểu 2017</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style-main.css">
    <!--    <link rel="stylesheet" type="text/css" href="css/style.css">-->
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <link rel="stylesheet" type="text/css" href="css/style-body1.css">


    <style type="text/css">
  /*      #gioi-thieu {margin-top: 0px}
        #themes{transform: rotate(90deg);  -webkit-transform: rotate(90deg);-moz-transform: rotate(90deg);z-index: 9999999999;position: fixed;top: 172px;right: -24px;font-family: "Josefin Slab", serif;cursor: pointer;font-weight: 700;color: white;background: #d73814;padding:8px 10px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px}
        #themeContainer{position: fixed;top:150px;right: -200px;z-index: 999999999999999;width: 200px;padding-top: 2px;background: #1e1e1e;}

         #themeContainer .wrapper-style .time #minutes,#themeContainer .wrapper-style .time #seconds{width: 40px}
         #themeContainer .wrapper-style .time{padding: 15px}
         #themeContainer .wrapper-style .time  #save-time{margin-left: 10px}
        #themeContainer .wrapper-style .time #point{font-weight: bold;color: white;margin: 0 2px}
        #themeContainer .wrapper-style >h4 {box-sizing: border-box;background: #1e1e1e;font-size: 16px;margin: 0;color: white;padding: 10px;width: 100%;border-top: 1px solid #444;border-bottom: 1px solid #444;}
        #themeContainer .wrapper-style >h4 #close-themes{transition: color .5s;float: right;font-size: 20px;margin-top: -5px;margin-right: 10px;box-sizing: border-box}
        #themeContainer .wrapper-style >h4 #close-themes:hover{color: #d73814}
        #themeContainer .wrapper-style .oregional-skins{width: 100%;border-bottom: 1px solid #444}
        #themeContainer .wrapper-style .oregional-skins  .item-oregional-skins{box-sizing: border-box;padding: 10px ;width: 100%}
        #themeContainer .wrapper-style .oregional-skins  .item-oregional-skins .item-oregional-skins-x{width: 18px;height: 18px;border: 2px solid #666;display: inline-block;margin-right: 5px}*/
      /*  #themeContainer .wrapper-style .oregional-skins  .item-oregional-skins  #default{background: #F1F1F1}
        #themeContainer .wrapper-style .oregional-skins  .item-oregional-skins  #red{background: red}*/



        /*.item-product-sp{width: 200px;padding: 0;position: absolute;text-align: left;top: 78px;display: none;background: white;z-index: 9999}*/
        /*.item-product-sp li{margin: 0!important;display: block;border-bottom: 1px solid #ededed;width: 200px;font-size: 13px;font-weight: bold;}*/
        /*.item-product-sp li:hover{background: #ededed;color:#bd0103}*/
        /*.item-product-sp li:hover a{color:#bd0103 }*/
        /*.item-product-sp li a{margin: 0;padding:0;color: #666;width: 100%;height: 100%;display: block;}*/
        /*.menu-header > ul li:hover .item-product-sp{display: block;}*/
    </style>
</head>

<body>
<?php
session_start();
include('include/header.php');
?>

<div class="banner hidden-sm hidden-xs ">
    <div class="container-fluid">
        <div class="row">
            <div class="hidden-sm hidden-xs wap">
                <div class="slider">
                    <!-- <div id="pre"><img src="pre-icon.png"></div>
                    <div id="next"><img src="next-icon.png"></div> -->
                    <ul id="img">
            
                        <li stt="0"><img src="image/slider/g144.jpg"></li>
                        <li stt="1"><img src="image/slider/g116.jpg"></li>
                        <li stt="2"><img src="image/slider/g137.jpg"></li>
                        <li stt="3"><img src="image/slider/g142.jpg"></li>
                        <li stt="4"><img src="image/slider/g143.jpg"></li>
                    </ul>
                    <ul id="icon">
                        <li class="active" stt="0"></li>
                        <li stt="1"></li>
                        <li stt="2"></li>
                        <li stt="3"></li>
                        <li stt="4"></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="bcrumbs" style="height: 48px;background-color: #f2f2f2;overflow: hidden;margin-top: -10px;line-height: 48px">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
<div id="wapper-body" style="padding-top: 30px;">
    <div id="gioi-thieu" class=" hidden-xs">
        <div class="container">
            <div class="row">
                <div class="column-left col-xs-3">
                    <a href="#">
                        <img src="image/slide-1-trang-chu-slide-1.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="column-center col-xs-6">
                    <a href="#" class="img-top">
                        <img src="image/slide-2-trang-chu-slide-2.jpg" class="img-responsive" alt="">
                    </a>
                    <a href="#" class="img-bottom">
                        <img src="image/slide-3-trang-chu-slide-3.jpg" class="img-responsive" alt="">
                    </a>
                </div>

                <div class="column-right col-xs-3">
                    <a href="#">
                        <img src="image/slide-4-trang-chu-slide-4.jpg" class="img-responsive" alt="">
                    </a>
                </div>

            </div>

        </div>

    </div>
    <div class="body">
        <div class="container">
            <div class="row wapper-center">
                <?php
                $query_category_c = "SELECT * FROM tb_category WHERE parent_id=0";
                $result_category_c = mysqli_query($dbc, $query_category_c);
                kt_query($query_category_c, $result_category_c);

                while ($category_c = mysqli_fetch_array($result_category_c, MYSQLI_ASSOC)) {
                    $id = lay_id($category_c['id_category']);
                    if (empty($id)) {
                        $id = $category_c['id_category'];
                    } else {
                        $id .= "," . $category_c['id_category'];
                    }


                    ?>

                    <div id="<?php echo $category_c['unaccentname_category']; ?>" class="col-xs-12  product-body themes-product">
                        <div class="row">
                            <div class="title-<?php echo $category_c['unaccentname_category']; ?> title-product">
                                <div class="left">
                                    <h2>
                                        <a href="sp-category.php?category=<?php echo $category_c['id_category']; ?>"><?php echo $category_c['name_category']; ?></a>
                                    </h2>
                                </div>
                                <div class="right">
                                    <a href="sp-category.php?category=<?php echo $category_c['id_category']; ?>">Xem tất
                                        cả</a>
                                </div>
                            </div>
                            <div class="page-button">
                                <div class="pre"></div>
                                <div class="next"></div>
                            </div>
                            <div class="col-xs-12 wp" style="margin-top: 20px">
                                <div class="row width" style="overflow: hidden;">
                                    <div class="wapper">
                                        <?php
                                        $query_sp = "SELECT * FROM tb_product WHERE id_category IN ($id)";
                                        $result_sp = mysqli_query($dbc, $query_sp);
                                        kt_query($query_sp, $result_sp);
                                        while ($product = mysqli_fetch_array($result_sp, MYSQLI_ASSOC)) {
                                            ?>
                                            <div class="item">
                                                <div class="khung-img">
                                                    <div class="item-img">
                                                        <?php
                                                        $img_product = explode(" ", $product['image_thump']);
                                                        $i = 0;
                                                        foreach ($img_product as $value) {
                                                            ?>
                                                            <a href="product.php?id=<?php echo $product['id_product']; ?>">
                                                                <img title="<?php echo $product['name_product']; ?>"
                                                                     src="<?php echo $value; ?>"
                                                                     class="img<?php if ($i == 1) {
                                                                         echo '_1';
                                                                     } ?>">
                                                            </a>

                                                            <?php
                                                            if ($i == 1) {
                                                                break;
                                                            }
                                                            ++$i;
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="text-center name"><a
                                                                href=""><?php echo $product['name_product']; ?></a>
                                                    </div>
                                                    <div class="text-center price"><?php echo number_format($product['saleprice_product'], 0, ',', '.'); ?></div>
                                                    <div class="button-product">
                                                        <a href="product.php?id=<?php echo $product['id_product']; ?>"
                                                           class="cart">
                                                            <i class="glyphicon glyphicon-shopping-cart"></i><span>Mua ngay</span>
                                                        </a>
                                                        <a href="product.php?id=<?php echo $product['id_product']; ?>"
                                                           class="see">
                                                            <i class="glyphicon glyphicon-triangle-right"></i><span>Chi tiết</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                }
                ?>

            </div>
        </div>
    </div>  <!-- kết thúc body -->
    <div class="news-letter hidden-sm hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2>ĐĂNG KÝ ĐỂ NHẬN THÔNG TIN KHUYẾN MÃI HOẶC SẢN PHẨM MỚI NHẤT</h2>
                    <div>Thông tin này sẽ được bảo mật trên hệ thống 4MEN</div>
                    <div>Hệ thống sẽ tự động gửi thông tin khuyến mãi hoặc sản phẩm mới nhất về thời trang nam về email
                        mà
                        bạn đã đăng ký
                    </div>
                    <form action="xuli/mail.php" method="post">
                        <div class="form-group">
                            <input type="text" name="insertMail" placeholder="Email của bạn">
                            <button type="submit" name="submitNewleter">Đăng kí</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12 footer-content">
                <h4>Quần áo nam đẹp, shop bán quần áo thời trang nam hàng hiệu, cao cấp kiểu 2017</h4>
                <p>4MEN(R) giới thiệu đến các bạn các mẫu quần áo nam đẹp, kiểu dáng thời trang, kiểu quần áo nam thời
                    trang
                    Hàn Quốc, phong cách thời trang 2017<br>
                    Thương hiệu thời trang nam 4MEN(R) luôn hướng đến những sản phẩm quần áo nam chất lượng, cao cấp,
                    kiểu
                    mẫu quần áo nam theo xu hướng mới nhất và thịnh hành nhất hiện nay</p>

                <h4>Mua quần áo nam online giá rẻ, giao hàng toàn quốc</h4>
                <p>Khi chọn được các mẫu style quần áo nam thời trang đẹp và ưng ý, các bạn nhớ đặt hàng mùa sản phẩm
                    quần
                    áo thời trang nam tại website để 4MEN được tư vấn chính xác hơn về chất lượng cũng như chi phí giao
                    hàng
                    đến tận tay cho các bạn</p>

                <h4>Mua quần áo nam thời trang tại 4MEN</h4>
                <p>Đến với 4MEN(R) chắc chắn bạn sẽ chọn được mẫu quần áo nam đẹp và ưng ý.<br>
                    Khi chọn mua sản phẩm quần áo nam chúng tôi sẽ có nhân tư vấn và giao hàng đến tận nơi cho quí
                    khách.
                    4MEN(R) giao hàng trên toàn quốc, tùy thuộc vào địa điểm giao hàng mà phí ship hàng có giá trị khác
                    nhau
                    Nếu tổng giá trị đơn hàng lớn hơn 1 triệu đồng, chúng tôi sẽ ship hàng miễn phí cho quí khách<br>
                    Xin cảm ơn quí khách.</p>

                <p>4MEN hân hạnh được phục vụ các bạn</p>
            </div>
        </div>
    </div>
</div>
<?php
include('include/footer.php');
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/jquery-main.js"></script>
<script src="http://malsup.github.com/jquery.cycle2.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
//        function server_busy($numer) {
//            if (THIS_IS == 'WEBSITE' && PHP_OS == 'Linux' and @file_exists ( '/proc/loadavg' ) and $filestuff = @file_get_contents ( '/proc/loadavg' )) {
//                $loadavg = explode ( ' ', $filestuff );
//                if (trim ( $loadavg [0] ) > $numer) {
//                    print '';
//                    print 'Lượng truy cập đang quá tải, mời bạn quay lại sau vài phút.';
//                    exit ( 0 );
//                }
//            }
//        }
//        $srv = server_busy ( 10 ); // 1000 là số người truy cập tại 1 thời điểm
        //
        $('#themeContainer .wrapper-style .oregional-skins  .item-oregional-skins .item-oregional-skins-x').each(function(){
            if($(this).attr("id")=="default"){
                $(this).css("background","#F1F1F1");
            }else{
                 $(this).css("background",function(){
                    return $(this).attr("id");
                 });
            }
        });
        $("#themes").click(function(){
          $(this).animate({"right": -60},500,function(){
              $("#themeContainer").animate({"right": 0},500);
          });
        });
        $("#themeContainer .wrapper-style >h4").click(function(){
            $("#themeContainer").animate({"right": -200},500,function(){
                $("#themes").animate({"right": -24},500);
            });
        });
        var id ="";
        $("#themeContainer .wrapper-style .oregional-skins  .item-oregional-skins .item-oregional-skins-x").click(function(){
            $("#themeContainer .wrapper-style .oregional-skins  .item-oregional-skins .item-oregional-skins-x").css("border-color","#666");
            $(this).css("border-color","#d73814");
            id=$(this).attr("id").toString();
        });

        $("#themeContainer .wrapper-style .oregional-skins  .item-oregional-skins  #default").click(function(){
            $(".header").css("background","#F1F1F1");
            $(".product-body .title-product .left").css("background","white");
            $(".product-body .title-product .left h2").css("background","url(../image/icon/c.gif) no-repeat left center,#fff url(../image/icon/c.gif) no-repeat right center");
            $(".product-body .title-product .right").css("background","white");
        });
        $("#themeContainer .wrapper-style .time  #save-time").click(function(){

            if (id=="") {
                $("#themeContainer .wrapper-style .time #error").text("Hãy chọn màu");
                $("#themeContainer .wrapper-style .time #error").css({"color":"#bd0103","font-weight":700});
            }
            else if(id=="default"){
                $(".header").css("background","#F1F1F1");
                $(".product-body .title-product .left").css("background","white");
                $(".product-body .title-product .left h2").css("background","url(../image/icon/c.gif) no-repeat left center,#fff url(../image/icon/c.gif) no-repeat right center");

                $(".product-body .title-product .right").css("background","white");
            }else{
                var time;
                if(Number($("#themeContainer .wrapper-style .time #minutes").val()) >=0 && Number($("#themeContainer .wrapper-style .time #seconds").val()) >=0){
                    time = (Number($("#themeContainer .wrapper-style .time #minutes").val())*60 + Number($("#themeContainer .wrapper-style .time #seconds").val())) * 1000;

                }
                else{
                    $("#themeContainer .wrapper-style .time #error").text("Lỗi thời gian");
                    $("#themeContainer .wrapper-style .time #error").css({"color":"#bd0103","font-weight":700});

                }
                $(".header").css("background",id);
                $(".product-body .title-product .left").css("background",id);
                $(".product-body .title-product .left h2").css("background",id);
                $(".product-body .title-product .right").css("background",id);
                setTimeout(function(){
                     $(".header").css("background","#F1F1F1");
                     $(".product-body .title-product .left").css("background","white");
                     $(".product-body .title-product .left h2").css("background","url(../image/icon/c.gif) no-repeat left center,#fff url(../image/icon/c.gif) no-repeat right center");
                     $(".product-body .title-product .right").css("background","white");
                },time);
            }



        });

    //
        $('.body .cart').click(function () {

            $.get("xuli-seeproduct/session-display.php", {display: "display:block"});
        });
        var width_body = $('body').width();
        if (width_body < 480) {

            $('.item').css('width', function () {
                return $('.item').parents('.width').width();

            });
        }
        else if (width_body < 768) {

            $('.item').css('width', function () {
                return $('.item').parents('.width').width() * 50 / 100;

            });
        }
        else if (width_body < 1200) {

            $('.item').css('width', function () {
                return $('.item').parents('.width').width() * 33.33333333 / 100;

            });
        }
        else {

            $('.item').css('width', function () {
                return $(this).parents('.width').width() * 25 / 100;

            });
        }


        var width = $('.item').width() + 30;
        $(window).resize(function () {
            // alert('a');
            width_body = $('body').width();
            width = $('.item').width() + 30;
            // alert(width_body);
            if (width_body < 480) {

                $('.item').css('width', function () {
                    return $('.item').parents('.width').width();

                });
            }
            else if (width_body < 768) {

                $('.item').css('width', function () {
                    return $('.item').parents('.width').width() * 50 / 100;

                });
            }
            else if (width_body < 1200) {

                $('.item').css('width', function () {
                    return $('.item').parents('.width').width() * 33.33333333 / 100;

                });
            }
            else {

                $('.item').css('width', function () {
                    return $(this).parents('.width').width() * 25 / 100;

                });
            }
        });
        <?php
        $query_category = "SELECT unaccentname_category FROM tb_category WHERE parent_id=0";
        $result_category = mysqli_query($dbc, $query_category);
        kt_query($query_category, $result_category);

        while ($category = mysqli_fetch_array($result_category, MYSQLI_NUM)) {
        ?>
        $('#<?php echo trim($category[0]); ?>  .next').click(function () {
            width = $('.item').width() + 30;
            $('#<?php echo trim($category[0]); ?> .wapper').css('opacity', 0.75);
            $('#<?php echo trim($category[0]); ?> .wapper').animate({
                'margin-left': -width,
                opacity: 1
            }, 500, function () {

                $('#<?php echo trim($category[0]); ?> .item:first-child').appendTo('#<?php echo trim($category[0]); ?> .wapper');
                $('#<?php echo trim($category[0]); ?> .wapper').css('margin-left', 0);

            });
        });
        $('#<?php echo trim($category[0]); ?> .pre').click(function () {
            width = $('.item').width() + 30;
            $('#<?php echo trim($category[0]); ?> .wapper').css('opacity', 0.45);
            $('#<?php echo trim($category[0]); ?> .wapper ').css('margin-left', -width);
            $('#<?php echo trim($category[0]); ?> .wapper .item:last-child').prependTo('#<?php echo trim($category[0]); ?> .wapper');
            $('#<?php echo trim($category[0]); ?> .wapper').animate({'margin-left': '0', opacity: 1}, 500, function () {

                $('#<?php echo trim($category[0]); ?> .wapper').css('margin-left', 0);
            });
        });
        <?php } ?>


    });

</script>
</body>
</html>
