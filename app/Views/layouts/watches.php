<!DOCTYPE html>
<html>

<head>
    <base href ="/">
    <link rel="shortcut icon" href="images/star.png" type="image/png" />

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>


    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>

    <!--start-menu-->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/jquery.easydropdown.js"></script>


    <link rel="stylesheet" href="megamenu/css/style.css">
    <link rel="stylesheet" href="megamenu/css/ionicons.min.css">

    <?= $this->getMeta(); ?>
</head>

<body>
<!--top-header-->
<div class="top-header">

    <div class="container">
        <div class="top-header-main">
            <div class="col-md-6 top-header-left">
                <div class="drop">
                    <div class="box">
                        <select id="currency" tabindex="4" class="dropdown drop">
                            <?php new \app\widgets\currency\Currency(); ?>
                        </select>
                    </div>
                    <div class="btn-group">
                        <a class="dropdown-toggle" data-toggle="dropdown">ACCOUNT<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if(\App\Models\UserModel::isAuth()): ?>
                                <li><a href="user/cabinet" onclick="return false;">Welcome, <?php echo h($_SESSION['user']['login']);?></a></li>
                                <li><a href="user/logout">Logout</a></li>
                            <?php else: ?>
                                <li><a href="user/login">Login</a></li>
                                <li><a href="user/signup">Registration</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
<!--                    <div class="box1">-->
<!--                        <select tabindex="4" class="dropdown">-->
<!--                            <option value="" class="label">English :</option>-->
<!--                            <option value="1">English</option>-->
<!--                            <option value="2">French</option>-->
<!--                            <option value="3">German</option>-->
<!--                        </select>-->
<!--                    </div>-->
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 top-header-left">
                <div class="cart box_1">
                    <a href="cart/show" onclick="getCart(); return false;">
                        <div class="total">
                            <img src="images/cart-1.png" alt="" />
                            <?php if(!empty($_SESSION['cart'])): ?>
                                <span class="simpleCart_total"><?= $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol_right']; ?></span>
                            <?php else: ?>
                                <span class="simpleCart_total">Empty Cart</span>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--top-header-->
<!--start-logo-->
<div class="logo">
    <a href="<?= PATH ?>">
        <h1>Luxury Watches</h1>
    </a>
</div>
<!--start-logo-->
<!--bottom-header-->
<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="menu-container">
                    <div class="menu">
                        <?php new \App\Widgets\Menu\Menu([
                            'tpl' => WWW . '/menu/menu.php',
                        ]) ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3 header-right">
                <div class="search-bar">
                    <form action="search" method="get" autocomplete="off">
                        <input type="text" class="typeahead" id="typeahead" name="s">
                        <input type="submit" value="">
                    </form>

<!--                    <input type="text" value="Search" onfocus="this.value = '';"-->
<!--                           onblur="if (this.value == '') {this.value = 'Search';}">-->
<!--                    <input type="submit" value="">-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--bottom-header-->
<?php //session_destroy() ?>
<?php //dpre($_SESSION) ?>
<?= $content ?>

<!--information-starts-->
<div class="information">
    <div class="container">
        <div class="infor-top">
            <div class="col-md-3 infor-left">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#"><span class="fb"></span>
                            <h6>Facebook</h6>
                        </a></li>
                    <li><a href="#"><span class="twit"></span>
                            <h6>Twitter</h6>
                        </a></li>
                    <li><a href="#"><span class="google"></span>
                            <h6>Google+</h6>
                        </a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Information</h3>
                <ul>
                    <li><a href="#">
                            <p>Specials</p>
                        </a></li>
                    <li><a href="#">
                            <p>New Products</p>
                        </a></li>
                    <li><a href="#">
                            <p>Our Stores</p>
                        </a></li>
                    <li><a href="contact.html">
                            <p>Contact Us</p>
                        </a></li>
                    <li><a href="#">
                            <p>Top Sellers</p>
                        </a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>My Account</h3>
                <ul>
                    <li><a href="account.html">
                            <p>My Account</p>
                        </a></li>
                    <li><a href="#">
                            <p>My Credit slips</p>
                        </a></li>
                    <li><a href="#">
                            <p>My Merchandise returns</p>
                        </a></li>
                    <li><a href="#">
                            <p>My Personal info</p>
                        </a></li>
                    <li><a href="#">
                            <p>My Addresses</p>
                        </a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Store Information</h3>
                <h4>The company name,
                    <span>Lorem ipsum dolor,</span>
                    Glasglow Dr 40 Fe 72.
                </h4>
                <h5>+955 123 4567</h5>
                <p><a href="mailto:example@email.com">contact@example.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->


<!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cart</h4>
            </div>
            <div class="modal-body">
            <!-- сюда будет подгружаться шаблон cart -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Continue shopping</button>
                <a href="cart/view" type="button" class="btn btn-primary">Checkout</a>
                <button type="button" class="btn btn-danger" onclick="clearCart()">Empty cart</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!--footer-starts-->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
                <form>
                    <input type="text" value="Enter Your Email" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
                    <input type="submit" value="Subscribe">
                </form>
            </div>
            <div class="col-md-6 footer-right">
                <p>© 2015 Luxury Watches. All Rights Reserved | Design by <a href="http://w3layouts.com/"
                                                                             target="_blank">W3layouts</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--footer-end-->

<div class="preloader">
    <img src="images/ring.svg" alt="">
</div>

<!--dropdown-->

<script src="js/bootstrap.min.js "></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/responsiveslides.min.js"></script>

<script src="megamenu/js/megamenu.js"></script>
<!--dropdown-->
<script src="js/jquery.easydropdown.js"></script>
<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider4").responsiveSlides({
            auto: true,
            pager: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>
<script type="text/javascript">
    $(function () {

        var menu_ul = $('.menu_drop > li > ul'),
            menu_a = $('.menu_drop > li > a');

        menu_ul.hide();

        menu_a.click(function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                menu_a.removeClass('active');
                menu_ul.filter(':visible').slideUp('normal');
                $(this).addClass('active').next().stop(true, true).slideDown('normal');
            } else {
                $(this).removeClass('active');
                $(this).next().stop(true, true).slideUp('normal');
            }
        });

    });
</script>

<?php $curr = \Core\App::$app->getProperty('currency'); ?>
<script>
    var path = '<?= PATH; ?>',
        course = <?= $curr['value']; ?>,
        symboleLeft = '<?= $curr['symbol_left']; ?>',
        symboleRight = '<?= $curr['symbol_right']; ?>';
</script>
<script src="js/main.js"></script>
</body>

</html>