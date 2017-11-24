<?php
  //print_r($data);
?>
<div class="page-container">
  <div data-bottom-top="background-position: 50% 50px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -50px;" class="page-title page-reservation">
    <div class="container">
      <div class="title-wrapper">
        <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(-5px);" data--50-top="transform: translateY(-15px);opacity:0.8;" data--120-top="transform: translateY(-30px);opacity:0;" data-anchor-target=".page-title" class="title">Giỏ hàng của bạn</div>
        <div data-top="opacity:1;" data--120-top="opacity:0;" data-anchor-target=".page-title" class="divider"><span class="line-before"></span><span class="dot"></span><span class="line-after"></span></div>
        <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(5px);" data--50-top="transform: translateY(15px);opacity:0.8;" data--120-top="transform: translateY(30px);opacity:0;" data-anchor-target=".page-title" class="subtitle">Just a few click to make the reservation online for saving your time and money</div>
      </div>
    </div>
  </div>
  <div class="page-content-wrapper">
    <section class="section-reservation-form padding-top-100 padding-bottom-100">
      <div class="container">
        <div class="section-content cart-content">

          <?php
            if (isset($_COOKIE['error'])) {
          ?>
            <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?=$_COOKIE['error']?>
            </div>
          <?php
            }
            if (isset($_COOKIE['success'])) {
          ?>
            <div class="alert alert-success alert-dismissable">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?=$_COOKIE['success']?>
            </div>
          <?php
            }
          
            if (empty($data->items)) {
              echo '<div class="swin-sc swin-sc-title style-2">
                      <h3 class="title"><span>Giỏ hàng rỗng</span></h3>
                    </div>';
              header("refresh:5; url=index.php");

            } else{
          ?>

          <div class="swin-sc swin-sc-title style-2">
            <h3 class="title"><span>Chi tiết giỏ hàng</span></h3>
          </div>
          <div class="reservation-form">
            <div class="swin-sc swin-sc-contact-form light mtl">
              <table class="table table-striped" style="text-align: center;">
                  <thead>
                    <tr>
                      <th width="30%" style="text-align: center;">Product</th>
                      <th width="20%" style="text-align: center;">Price</th>
                      <th width="20%" style="text-align: center;">Qty.</th>
                      <th width="20%" style="text-align: center;">Total</th>
                      <th width="10%" style="text-align: center;">Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data->items as $idSP => $sanpham) {
                    ?>
                      <tr id="sanpham-<?=$idSP?>">
                        <td>
                          <img src="public/assets/images/hinh_mon_an/<?=$sanpham['item']->image ?>" width="250px">
                          <p><br><b><?=$sanpham['item']->name?></b></p>
                        </td>
                        <td><b style="color: blue"><?=number_format($sanpham['item']->price)?> VNĐ</b></td>
                        <td>
                          <select name="product-qty" id="product-qty" class="form-control product-qty" data-id="<?=$idSP?>" width="50">
                            <?php 
                              for ($i=1; $i <= 5; $i++) { 
                            ?>
                              <option value="<?=$i?>" <?=$i==$sanpham['qty'] ? "selected" : ''?>><?=$i?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </td>
                        <td><b style="color: green" id="dongia-<?=$idSP?>"><?=$sanpham['price']?> VNĐ</b></td>
                        <td><a class="remove" title="Remove this item" data-id="<?=$idSP?>" ><i class="fa fa-trash-o fa-2x"></i></a></td>
                      </tr>
                    <?php
                      }
                    ?>
                    <tr>
                      <td colspan="3" style="color: green; font-size: 20px; text-align: right;"><b>Tổng tiền</b></td>
                      <td><b style="color: green; font-size: 20px" id="totalPrice"><?=$data->totalPrice?> VNĐ</b></td>
                    </tr>
                  </tbody>
              </table>     
            </div>
            <div class="swin-sc swin-sc-contact-form light mtl style-full">
              <div class="swin-sc swin-sc-title style-2">
                <h3 class="title"><span>Đặt hàng</span></h3>
              </div>
              <form method="POST" action="checkout.php">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" placeholder="Fullname" name="fullname" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                    <input type="text" placeholder="Email" name="email" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <div class="fa fa-map-marker"></div>
                    </div>
                    <input type="text" placeholder="Address" name="address" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <div class="fa fa-phone"></div>
                    </div>
                    <input type="text" placeholder="Phone" name="phone" class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <textarea placeholder="Message" name="message" class="form-control"></textarea>
                </div>
                 <div class="form-group">
                  <div class="swin-btn-wrap center"><button type="submit" class="swin-btn center form-submit" name="btnCheckout"><span>Checkout</span></button></div>
                </div>
              </form>
            </div>
          </div>
          
          <?php 
            }
          ?>

        </div>
      </div>
    </section>
    <section data-bottom-top="background-position: 50% 100px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px;" class="section-reservation-service padding-top-100 padding-bottom-100">
      <div class="container">
        <div class="section-content">
          <div class="swin-sc swin-sc-title style-2 light">
            <h3 class="title"><span>Fooday Best Service</span></h3>
          </div>
          <div class="swin-sc swin-sc-iconbox light">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="item icon-box-02 wow fadeInUpShort">
                  <div class="wrapper-icon"><i class="icons swin-icon-dish"></i><span class="number">1</span></div>
                  <h4 class="title">Reservation</h4>
                  <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div data-wow-delay="0.5s" class="item icon-box-02 wow fadeInUpShort">
                  <div class="wrapper-icon"><i class="icons swin-icon-dinner-2"></i><span class="number">2</span></div>
                  <h4 class="title">Private Event</h4>
                  <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div data-wow-delay="1s" class="item icon-box-02 wow fadeInUpShort">
                  <div class="wrapper-icon"><i class="icons swin-icon-browser"></i><span class="number">3</span></div>
                  <h4 class="title">Online Order</h4>
                  <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div data-wow-delay="1.5s" class="item icon-box-02 wow fadeInUpShort">
                  <div class="wrapper-icon"><i class="icons swin-icon-delivery"></i><span class="number">4</span></div>
                  <h4 class="title">Fast Delivery</h4>
                  <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('.product-qty').change(function(){
      var soluong = $(this).val();
      var idSP = $(this).attr('data-id');
      var action = "update"

      $.ajax({
            url: "cart.php", //đường dẫn chạy ngầm ở console của trang này
            data:{
              id: idSP, //biến truyền đi: giá trị của id, lấy ở line 176
              qty: soluong,
              action: action
            },
            type: "POST",
            dataType: "json", //thêm cái này để json thành 1 object. Do cần trả về 2 giá trị
            success: function(result){
              //console.log(result)
              var dongiaSP = result.dongiaSanpham
              var tongtien = result.totalPrice
              /*console.log(dongiaSP)
              console.log(tongtien)*/
              $('#totalPrice').html(tongtien)
              $('#dongia-'+idSP).html(dongiaSP)
            },
            error: function(){
              console.log("Lỗi")
            }
          }).done(function(){
            console.log("Chạy xong ajax")
      });
    })

    $('.remove').click(function(){
      var idSP = $(this).attr('data-id');
      var action = "delete"
      //console.log(idSP);

      $.ajax({
        url: "cart.php",
        data:{
          id: idSP,
          action: action
        },
        type: "POST",
        success: function(result){
          //console.log(result)
          if (result == 0) {
            var data = '<div class="swin-sc swin-sc-title style-2"><h3 class="title"><span>Giỏ hàng rỗng</span></h3></div>'
            $('.cart-content').fadeOut(800)
                              .delay(1000)
                              .queue(function(n){
                                $(this).html(data);
                                n();
                              }).fadeIn(1000)

            setInterval(function(){
              window.location.href = "index.php";
            }, 5000);
          }
          else{
            $('#totalPrice').html(result + ' VNĐ')
            $('#sanpham-'+idSP).hide(500)
          }
          
        },
        error: function(){
          console.log("Lỗi")
        }
      })
    })
  })
</script>