<?php
  // tạo code_order ramdom 7 số  bên bill
function ramdom_code(){
  global $dbc;
  $rd = rand(0000000,9999999);
  $query = "SELECT code_bill FROM tb_bill";
  $result = mysqli_query($dbc,$query);
  $list_code_bill = array();
  while ($array_code = mysqli_fetch_array($result,MYSQLI_NUM) ) {
    array_push($list_code_bill, $array_code[0]);
  }
  if (in_array($rd, $list_code_bill)) {
    ramdom_code();
  }
  else{
    return $rd;
  }
}

// 
function ramdom_code_product($code){
  global $dbc;
  $rd = $code.rand(0,9999);
  $query = "SELECT code_product FROM tb_product WHERE code_product='{$rd}'";
  $result = mysqli_query($dbc,$query);
  // $list_code_order = array();
  // while ($array_code = mysqli_fetch_array($result,MYSQLI_NUM) ) {
  //   array_push($list_code_order, $array_code[0]);
  // }
  if ( mysqli_num_rows($result) >= 1) {
    ramdom_code_product($code);
  }
  else{
    return $rd;
  }
}
// tạo code_product
function creat_code_product($id_loai) {
  global $dbc;
  // lấy mã loại cáo nhất của loai dua vào
  $id_loai = get_id_category($id_loai);
  // lấy những chữ cái của tên loại
  $query="SELECT name_category FROM tb_category WHERE id_category={$id_loai}";
  $result= mysqli_query($dbc,$query);
  kt_query($result,$query);
  list($name_category) = mysqli_fetch_row($result);
  $name_category = stripUnicode($name_category);
  $array_text_category = explode(" ", $name_category);
  $code = '';
  for ($i = 0; $i < count($array_text_category);  $i++) {
   $code .= strtoupper(substr($array_text_category[$i], 0,1));
 }
                // Tạo ra số ramdom
 $code = ramdom_code_product($code);
  // kiểm tra mã này có tồn tại chưa
 return $code;
}

//kiếm tra xem kết quả trả về có đúng hay không.

function stripUnicode($str){
  if(!$str) return false;
  $unicode = array(
    'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|À|Á',
    'd'=>'đ',
    'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
    'i'=>'í|ì|ỉ|ĩ|ị',
    'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
    'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
    'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
  );
  foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
  return str_replace(" ","", $str);
}
function kt_query($result,$query)
{
  global $dbc;
  if (!$result){
    die("Query {$query} \n<br/> MYSQL Errors : " .mysqli_error($dbc));
  }
}

function show_categories($parent_id=0,$insert_text=""){
  global $dbc;
  $query="SELECT * FROM tb_category WHERE parent_id={$parent_id}";
  $result= mysqli_query($dbc,$query);
  kt_query($result,$query);
  while($parent=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    echo ("<option value='".$parent['id_category']."'>".$insert_text.$parent['name_category']."</option>");
    show_categories($parent['id_category'],$insert_text."- ");
  }

}
// lay id category cha cap cao nhat cua id dua vao
function get_id_category($id_category)
{
  global $dbc;
  $query="SELECT id_category,parent_id FROM tb_category WHERE id_category={$id_category}";
  $result= mysqli_query($dbc,$query);
  kt_query($result,$query);
  list($id_category,$parent_id) = mysqli_fetch_row($result);
  if($parent_id != 0) {
    $query="SELECT id_category,parent_id FROM tb_category WHERE id_category={$parent_id}";
    $result= mysqli_query($dbc,$query);
    kt_query($result,$query);
    list($id_category,$parent_id) = mysqli_fetch_row($result);
    if($parent_id != 0) {
      $query="SELECT id_category,parent_id FROM tb_category WHERE id_category={$parent_id}";
      $result= mysqli_query($dbc,$query);
      kt_query($result,$query);
      list($id_category,$parent_id) = mysqli_fetch_row($result);
      if($parent_id != 0) { 
        $query="SELECT id_category,parent_id FROM tb_category WHERE id_category={$parent_id}";
        $result= mysqli_query($dbc,$query);
        kt_query($result,$query);
        list($id_category,$parent_id) = mysqli_fetch_row($result);
        if($parent_id != 0) {

        } else {

          return $id_category;
        }

      } else {

        return $id_category;
      }

    } else {

      return $id_category;
    }
  } else {

    return $id_category;
  }
//    kết thúc if
}

function ctrSelect($name,$class,$current_id =""){
  global $dbc;

  echo "<select name='$name' class='$class' style='padding:5px 10px;border-radius:4px;display:block'>";
  echo "<option value='0'>Danh mục cha</option>";
  show_categories();
  echo "</select>";
}

// Xứ lí form search file list_category.php
function category_search($text_search) {
  global $dbc;

         // 
  $query = "SELECT * FROM tb_category WHERE name_category LIKE". "'%".$text_search."%'";
  $result = mysqli_query($dbc, $query);
  kt_query($query,$result);
        // echo 
  if( mysqli_num_rows($result) <= 0) {
   echo "<tr>
   <td colspan='5' class='text-danger text-center'>Không tìm thấy kết quả</td>
   </tr>";
 }  else {
  while ($category = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
  <tr>
    <td><?php echo $category['code_category']; ?></td>
    <td><?php echo $category['name_category']; ?></td>
    <td><?php
    $parent_id = $category['parent_id'];
    if($parent_id ==0){
      echo "Danh mục gốc";
    }else{
      $query_parent_category = "SELECT id_category,name_category,parent_id FROM tb_category WHERE  id_category={$parent_id} ORDER BY  name_category DESC ";
      $result_parent_category= mysqli_query($dbc, $query_parent_category);
      kt_query($query_parent_category, $result_parent_category);
      list($id_category,$name_category,$parent_id)=mysqli_fetch_array($result_parent_category,MYSQLI_NUM);
      echo $name_category;
    }
    ?>
  </td>


  <td align="center"><a href="edit_category.php?id=<?php echo $category['id_category']; ?>"><i
    class="fa fa-fw fa-pencil"
    style="font-size: 20px; color:#1b926c;"></i> </a></td>
    <td align="center"><a onClick="return confirm('Bạn thật sự muốn xóa không ?');"
      href="delete_category.php?id=<?php echo $category['id_category']; ?>"><i
      class="fa fa-fw fa-trash"
      style="font-size: 20px; color:rgba(26,27,23,0.87);"></i></a></td>
      </tr> <?php
    }



  }
}
// template list_category
function list_category() { 
 global $dbc;
 $query = "SELECT * FROM tb_category ORDER BY id_category";
 $result = mysqli_query($dbc, $query);
 kt_query($query, $result);
 while ($category = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  ?>
  <tr>
    <td><?php echo $category['code_category']; ?></td>
    <td><?php echo $category['name_category']; ?></td>
    <td><?php
    $parent_id = $category['parent_id'];
    if($parent_id ==0){
      echo "Danh mục gốc";
    }else{
      $query_parent_category = "SELECT id_category,name_category,parent_id FROM tb_category WHERE  id_category={$parent_id} ORDER BY  name_category DESC ";
      $result_parent_category= mysqli_query($dbc, $query_parent_category);
      kt_query($query_parent_category, $result_parent_category);
      list($id_category,$name_category,$parent_id)=mysqli_fetch_array($result_parent_category,MYSQLI_NUM);
      echo $name_category;
    }
    ?>
  </td>


  <td align="center"><a href="edit_category.php?id=<?php echo $category['id_category']; ?>"><i
    class="fa fa-fw fa-pencil"
    style="font-size: 20px; color:#1b926c;"></i> </a></td>
    <td align="center"><a onClick="return confirm('Bạn thật sự muốn xóa không ?');"
      href="delete_category.php?id=<?php echo $category['id_category']; ?>"><i
      class="fa fa-fw fa-trash"
      style="font-size: 20px; color:rgba(26,27,23,0.87);"></i></a></td>
    </tr>

    <?php
  }

}

// Xứ lí form search file list_label.php
function label_search($text_search) {
  global $dbc;
    // 
  $query = "SELECT * FROM tb_label WHERE name_label LIKE". "'%".$text_search."%'";
  $result = mysqli_query($dbc, $query);
  kt_query($query,$result);
        // echo 
  if( mysqli_num_rows($result) <= 0) {
   echo "<tr>
   <td colspan='4' class='text-danger text-center'>Không tìm thấy kết quả</td>
   </tr>";
 }  else {
  while ($label = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
  <tr>

    <td><?php echo $label['code_label']; ?></td>
    <td><?php echo $label['name_label']; ?></td>

    <td align="center"><a href="edit_label.php?id=<?php echo $label['id_label']; ?>"><i
      class="fa fa-fw fa-pencil"
      style="font-size: 20px; color:#1b926c;"></i></a></td>
      <td align="center"><a onClick="return confirm('Bạn thật sự muốn xóa không ?');"
        href="delete_label.php?id=<?php echo $label['id_label']; ?>"><i
        class="fa fa-fw fa-trash"
        style="font-size: 20px; color:rgba(26,27,23,0.87);"></i></a></td>

        </tr> <?php
      }



    }
  }

// temlate list_label
  function list_label() {
   global $dbc;
   $query = 'SELECT * FROM tb_label ORDER BY id_label DESC';
   $result = mysqli_query($dbc, $query);
   kt_query($query, $result);
   while ($label = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    ?>
    <tr>
      <td><?php echo $label['code_label']; ?></td>
      <td><?php echo $label['name_label']; ?></td>

      <td align="center"><a href="edit_label.php?id=<?php echo $label['id_label']; ?>"><i
        class="fa fa-fw fa-pencil"
        style="font-size: 20px; color:#1b926c;"></i></a></td>
        <td align="center"><a onClick="return confirm('Bạn thật sự muốn xóa không ?');"
          href="delete_label.php?id=<?php echo $label['id_label']; ?>"><i
          class="fa fa-fw fa-trash"
          style="font-size: 20px; color:rgba(26,27,23,0.87);"></i></a></td>
        </tr>

        <?php
      }

    }

// Xử lý form search file list_product.php
    function product_search($text_search, $page = 1, $limit = 15){
     global $dbc;
     $start = ( $page - 1 ) * $limit ;
     $lm = $limit;
     $query = "SELECT * FROM tb_product WHERE name_product LIKE ". "'%".$text_search."%'" . " LIMIT $start, $lm";
     $result = mysqli_query($dbc, $query);
     kt_query($query,$result);
     if( mysqli_num_rows($result) <= 0) {
       echo "<tr>
       <td colspan='14' class='text-danger text-center'>Không tìm thấy kết quả</td>
       </tr>";
     }  else {
      while ($product = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
      <tr>
        <td><?php echo $product['code_product']; ?></td>
        <td><?php echo $product['name_product']; ?></td>
        <td>
         <?php 
         if (isset($product['size_product']) && !empty($product['size_product']) ) {
          foreach (Unserialize($product['size_product']) as $key => $value) {
            echo strtoupper($key) . " , ";
          };
        }

        ?>
      </td>
      <td><?php echo $product['id_category']; ?></td>
      <td><?php echo $product['id_label']; ?></td>
      <td><?php

      $img_product = explode(" ",  $product['image']);
      $stt = 0;
      foreach ($img_product as $value) {
        if(isset($value) && !empty($value)){
          ?>

          <img  style="width: 50px;" src="../<?php echo $value; ?>"  style="margin: 0 auto">

          <?php
          $stt++;
        }
      }
      ?></td>
      <td><?php echo number_format($product['price_product']) ; ?><br/><strong> VND</strong></td>
      <td><?php echo number_format($product['saleprice_product']) ; ?><br/><strong> VND</strong></td>
      <td><?php echo $product['describe_product']; ?></td>
      <td><?php echo $product['view_product']; ?></td>
      <td><?php echo date("d/m/Y",strtotime($product['date_product'])); ?></td>
      <td><?php
      $status = $product['status_product'];
      if ($status==1)
      {
        echo "Còn hàng";
      }
      else
      {
        echo "Hết hàng";
      }
      ?></td>

      <td align="center"><a href="edit_product.php?id=<?php echo $product['id_product']; ?>"><i
        class="fa fa-fw fa-pencil"
        style="font-size: 20px; color:#1b926c;"></i></a></td>
        <td align="center"><a onClick="return confirm('Bạn thật sự muốn xóa không ?');"
          href="delete_product.php?id=<?php echo $product['id_product']; ?>"><i
          class="fa fa-fw fa-trash"
          style="font-size: 20px; color:rgba(26,27,23,0.87);"></i></a></td>
        </tr>

        <?php
      }



    }
  }
  // template list_product 
  function list_product($page = 1, $limit = 15) {
    global $dbc;
    $start = ( $page - 1 ) * $limit ;
    $lm = $limit;
    $query = "SELECT * FROM tb_product,tb_category,tb_label WHERE tb_product.id_category = tb_category.id_category && tb_label.id_label = tb_product.id_label  ORDER BY id_product DESC LIMIT $start, $lm";
    $result = mysqli_query($dbc, $query);
    kt_query($query, $result);
    while ($product = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      ?>
      <tr>
        <td><?php echo $product['code_product']; ?></td>
        <td><?php echo $product['name_product']; ?></td>
        <td>
          <?php 
          if (isset($product['size_product']) && !empty($product['size_product']) ) {
            foreach (Unserialize($product['size_product']) as $key => $value) {
              echo strtoupper($key) . " , ";
            };
          }

          ?>


        </td>
        <td><?php echo $product['name_category']; ?></td>
        <td><?php echo $product['name_label']; ?></td>
        <td><?php

        $img_product = explode(" ",  $product['image']);
        $stt = 0;
        foreach ($img_product as $value) {
          if(isset($value) && !empty($value)){
            ?>

            <img  style="width: 50px" src="../<?php echo $value; ?>"  style="margin: 0 auto">

            <?php
            $stt++;
          }
        }
        ?></td>
        <td><?php echo number_format($product['price_product']) ; ?><br/><strong> VND</strong></td>
        <td><?php echo number_format($product['saleprice_product']) ; ?><br/><strong> VND</strong></td>
        <td><?php echo $product['describe_product']; ?></td>
        <td><?php echo $product['view_product']; ?></td>
        <td><?php echo date("d/m/Y",strtotime($product['date_product'])); ?></td>
        <td><?php
        $status = $product['status_product'];
        if ($status==1)
        {
          echo "Còn hàng";
        }
        else
        {
          echo "Hết hàng";
        }
        ?></td>

        <td align="center"><a href="edit_product.php?id=<?php echo $product['id_product']; ?>"><i
          class="fa fa-fw fa-pencil"
          style="font-size: 20px; color:#1b926c;"></i></a></td>
          <td align="center"><a onClick="return confirm('Bạn thật sự muốn xóa không ?');"
            href="delete_product.php?id=<?php echo $product['id_product']; ?>"><i
            class="fa fa-fw fa-trash"
            style="font-size: 20px; color:rgba(26,27,23,0.87);"></i></a></td>
          </tr>

          <?php
        }

      }
      // temlate size 
      // file : edit_product.php
      function temlate_size_text($key ,$value) {
        if($key == 's'){
          ?>
          <input type="checkbox" id="s" name="size_s" value="s" class="check">
          <label for="s" class="title-size">S</label>
          <input type="number" name="sl_s" value="<?php echo $value; ?>" class="number">
          <?php 
          return false;
        } else {
          ?>
          <input type="checkbox" id="s" name="size_m" value="s" class="check">
          <label for="s" class="title-size">S</label>
          <input type="number" name="sl_s" value="1"  disabled="disabled" class="number">
          <?php 
          return false;
        }

        if($key == 'm'){
          ?>
          <input type="checkbox" id="m" name="size_m" value="m" class="check">
          <label for="m" class="title-size">M</label>
          <input type="number" name="sl_m" value="<?php echo $value; ?>" class="number">
          <?php 
          return false;
        } else {
          ?>
          <input type="checkbox" id="m" name="size_m" value="m" class="check">
          <label for="m" class="title-size">M</label>
          <input type="number" name="sl_m" value="1"  disabled="disabled" class="number">
          <?php 
          return false;
        }

        if($key == 'l'){
          ?>
          <input type="checkbox" id="l" name="size_l" value="l" class="check">
          <label for="l" class="title-size">L</label>
          <input type="number" name="sl_l" value="<?php echo $value; ?>"  class="number">
          <?php 
          return false;
        } else {
          ?>
          <input type="checkbox" id="l" name="size_l" value="l" class="check">
          <label for="l" class="title-size">L</label>
          <input type="number" name="sl_l" value="1" disabled="disabled" class="number">
          <?php 
          return false;
        }

        if($key == 'xl'){
          ?>
          <input type="checkbox" id="xl" name="size_xl" value="xl" class="check">
          <label for="xl" class="title-size">XL</label>
          <input type="number" name="sl_xl" value="<?php echo $value; ?>" class="number">
          <?php 
          return false;
        } else {
          ?>
          <input type="checkbox" id="xl" name="size_xl" value="xl" class="check">
          <label for="xl" class="title-size">XL</label>
          <input type="number" name="sl_xl" value="1" disabled="disabled" class="number">
          <?php 
          return false;
        }

        if($key == 'xxl'){
          ?>
          <input type="checkbox" id="xxl" name="size_xl" value="xxl" class="check">
          <label for="xxl" class="title-size">XXL</label>
          <input type="number" name="sl_xxl" value="<?php echo $value; ?>"  class="number">
          <?php 
          return false;
        } else {
          ?>
          <input type="checkbox" id="xxl" name="size_xl" value="xxl" class="check">
          <label for="xxl" class="title-size">XXL</label>
          <input type="number" name="sl_xxl" value="1" disabled="disabled" class="number">
          <?php 
          return false;
        }

        if($key == 'xxxl'){
          ?>
          <input type="checkbox" id="xxxl" name="size_xl" value="xxxl" class="check">
          <label for="xxxl" class="title-size">XXXL</label>
          <input type="number" name="sl_xxxl" value="<?php echo $value; ?>" class="number">
          <?php 
          return false;
        } else {
          ?>
          <input type="checkbox" id="xxxl" name="size_xl" value="xxxl" class="check">
          <label for="xxxl" class="title-size">XXXL</label>
          <input type="number" name="sl_xxxl" value="1" disabled="disabled" class="number">
          <?php 
          return false;
        }


      }
      function patination_product(){

      }
        // Hàm chuyển số tiền sang chữ
      function convert_number_to_words($number) {

        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
          0                   => 'Không',
          1                   => 'Một',
          2                   => 'Hai',
          3                   => 'Ba',
          4                   => 'Bốn',
          5                   => 'Năm',
          6                   => 'Sáu',
          7                   => 'Bảy',
          8                   => 'Tám',
          9                   => 'Chín',
          10                  => 'Mười',
          11                  => 'Mười một',
          12                  => 'Mười hai',
          13                  => 'Mười ba',
          14                  => 'Mười bốn',
          15                  => 'Mười năm',
          16                  => 'Mười sáu',
          17                  => 'Mười bảy',
          18                  => 'Mười tám',
          19                  => 'Mười chín',
          20                  => 'Hai mươi',
          30                  => 'Ba mươi',
          40                  => 'Bốn mươi',
          50                  => 'Năm mươi',
          60                  => 'Sáu mươi',
          70                  => 'Bảy mươi',
          80                  => 'Tám mươi',
          90                  => 'Chín mươi',
          100                 => 'trăm',
          1000                => 'ngàn',
          1000000             => 'triệu',
          1000000000          => 'tỷ',
          1000000000000       => 'nghìn tỷ',
          1000000000000000    => 'ngàn triệu triệu',
          1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
          return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
// overflow
          trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
          );
          return false;
        }

        if ($number < 0) {
          return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
          list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
          case $number < 21:
          $string = $dictionary[$number];
          break;
          case $number < 100:
          $tens   = ((int) ($number / 10)) * 10;
          $units  = $number % 10;
          $string = $dictionary[$tens];
          if ($units) {
            $string .= $hyphen . $dictionary[$units];
          }
          break;
          case $number < 1000:
          $hundreds  = $number / 100;
          $remainder = $number % 100;
          $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
          if ($remainder) {
            $string .= $conjunction . convert_number_to_words($remainder);
          }
          break;
          default:
          $baseUnit = pow(1000, floor(log($number, 1000)));
          $numBaseUnits = (int) ($number / $baseUnit);
          $remainder = $number % $baseUnit;
          $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
          if ($remainder) {
            $string .= $remainder < 100 ? $conjunction : $separator;
            $string .= convert_number_to_words($remainder);
          }
          break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
          $string .= $decimal;
          $words = array();
          foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
          }
          $string .= implode(' ', $words);
        }

        return $string;
      }
      ?>

