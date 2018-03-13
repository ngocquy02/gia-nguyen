<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    // đăng nhập vào quản trị
    Route::get('xjk-control/login', ['as'=>'login','uses' => 'LoginController@login']);
    Route::post('xjk-control/login', ['as'=>'postLogin','uses' => 'LoginController@postLogin']);
    Route::get('xjk-control/logout', ['as'=>'logout','uses' => 'LoginController@logout']);
    Route::post('xjk-control/logout', ['as'=>'postLogout','uses' => 'LoginController@postLogout']);
    // -----------------------------end--------------------
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'xjk-control'], function() {
        // Trang quản trị
        Route::get('/', ['as'=>'controller','uses' => 'ControlController@getController']);
        /*-------------------------Trang xử lý sản phẩm-------------------------------------*/
        Route::group(['prefix' => 'product'], function() {
            // danh sách sản phẩm
            Route::get('/{CatId}', ['as'=>'getProductsByCatId','uses' => 'ProductController@getProductsByCatId'])->where(['CatId'=>'[0-9]+']);
            // thêm sản phẩm
            Route::get('add/{CatId}', ['as'=>'getAddProduct','uses' => 'ProductController@getAddProduct'])->where(['CatId'=>'[0-9]+']);
            Route::post('add', ['as'=>'postAddProduct','uses' => 'ProductController@postAddProduct']);
            // Sửa sản phẩm
            Route::get('edit/{id}', ['as'=>'getProduct','uses' => 'ProductController@getProduct'])->where(['id'=>'[0-9]+']);
            Route::post('editProduct', ['as'=>'postEditProduct','uses' => 'ProductController@postEditProduct']);
            // Kiểm tra tên và alias có tồn tại hay chưa
            Route::post('checkNameProductAdd', ['as'=>'postCheckNameAddProduct','uses' => 'ProductController@postCheckNameAdd']);
            Route::post('checkNameProductEdit', ['as'=>'postCheckNameEditProduct','uses' => 'ProductController@postCheckNameEdit']);
            Route::post('checkAliasProductAdd', ['as'=>'postCheckAliasAddProduct','uses' => 'ProductController@postCheckAliasAdd']);
            Route::post('checkAliasProductEdit', ['as'=>'postCheckAliasEditProduct','uses' => 'ProductController@postCheckAliasEdit']);
            // Ajax 
            Route::post('Active', ['as'=>'postActiveProduct','uses' => 'ProductController@postActiveProduct']);
            Route::post('Hot', ['as'=>'postHotProduct','uses' => 'ProductController@postHotProduct']);
            Route::post('Slider', ['as'=>'postSliderProduct','uses' => 'ProductController@postSliderProduct']);
            // Thêm xóa danh sách hình ảnh
            Route::get('image/{ProdId}', ['as'=>'getProductImage','uses' => 'ProductController@getProductImage'])->where(['id'=>'[0-9]+']);
            Route::post('image', ['as'=>'postProductImage','uses' => 'ProductController@postProductImage']);
            Route::post('image/delete', ['as'=>'postProductImageDelete','uses' => 'ProductController@postProductImageDelete']);
            // Xóa hình ảnh
            Route::post('delete', ['as'=>'postProductDel','uses' => 'ProductController@postProductDel']);
            Route::post('deleteCheck', ['as'=>'postProductDelCheck','uses' => 'ProductController@postProductDelCheck']);
        });
        /*--------------------------Trang xử lý bài viết-------------------------------------*/
        Route::group(['prefix' => 'article'], function() {
            // danh sách bài viết
            Route::get('/{CatId}', ['as'=>'getArticles','uses' => 'ArticleController@getArticles'])->where(['CatId'=>'[0-9]+']);
            // thêm bài viết
            Route::get('add/{CatId}', ['as'=>'getAddArticle','uses' => 'ArticleController@getAddArticle'])->where(['CatId'=>'[0-9]+']);
            Route::post('add', ['as'=>'postAddArticle','uses' => 'ArticleController@postAddArticle']);
            // Sửa bài viết
            Route::get('edit/{id}', ['as'=>'getArticle','uses' => 'ArticleController@getArticle'])->where(['id'=>'[0-9]+']);
            Route::post('editArticle', ['as'=>'postEditArticle','uses' => 'ArticleController@postEditArticle']);
            // Kiểm tra tên và alias có tồn tại hay chưa
            Route::post('checkNameArticleAdd', ['as'=>'postCheckNameAddArticle','uses' => 'ArticleController@postCheckNameAddArticle']);
            Route::post('checkNameArticleEdit', ['as'=>'postCheckNameEditArticle','uses' => 'ArticleController@postCheckNameEditArticle']);
            Route::post('checkAliasArticleAdd', ['as'=>'postCheckAliasAddArticle','uses' => 'ArticleController@postCheckAliasAddArticle']);
            Route::post('checkAliasArticleEdit', ['as'=>'postCheckAliasEditArticle','uses' => 'ArticleController@postCheckAliasEditArticle']);
            // Ajax 
            Route::post('Active', ['as'=>'postActiveArticle','uses' => 'ArticleController@postActiveArticle']);
            Route::post('Hot', ['as'=>'postHotArticle','uses' => 'ArticleController@postHotArticle']);
            Route::post('Slider', ['as'=>'postSliderArticle','uses' => 'ArticleController@postSliderArticle']);
            // Xóa bài viết
            Route::post('delete', ['as'=>'postArticleDel','uses' => 'ArticleController@postArticleDel']);
            Route::post('deletecheck', ['as'=>'postArticleDelCheck','uses' => 'ArticleController@postArticleDelCheck']);
        });
        /*-----------------------Trang xử lý danh mục---------------------------*/
        Route::group(['prefix' => 'category'], function() {
            Route::get('/', ['as'=>'getCategorys','uses' => 'CategoryController@getCategorys']);

            Route::get('addHome', ['as'=>'getAddHomeCategory','uses' => 'CategoryController@getAddHomeCategory']);
            Route::get('addAbout', ['as'=>'getAddAboutCategory','uses' => 'CategoryController@getAddAboutCategory']);
            Route::get('addContact', ['as'=>'getAddContactCategory','uses' => 'CategoryController@getAddContactCategory']);
            // Thêm danh mục
            Route::get('addProduct/{ParentId}', ['as'=>'getAddCategoryProduct','uses' => 'CategoryController@getAddCategoryProduct'])->where(['ParentId'=>'[0-9]+']);
            Route::get('addArticle/{ParentId}', ['as'=>'getAddCategoryArticle','uses' => 'CategoryController@getAddCategoryArticle'])->where(['ParentId'=>'[0-9]+']);
            Route::post('add', ['as'=>'postAddCategory','uses' => 'CategoryController@postAddCategory']);
            // sửa danh mục
            Route::get('edit/{id}', ['as'=>'getCategory','uses' => 'CategoryController@getCategory'])->where(['id'=>'[0-9]+']);
            Route::post('edit', ['as'=>'postEditCategory','uses' => 'CategoryController@postEditCategory']);
            // Xóa danh mục
            Route::post('delete', ['as'=>'postCategoryDel','uses' => 'CategoryController@postCategoryDel']);
            // Kiểm tra tên và alias có tồn tại hay chưa
            Route::post('checkNameAdd', ['as'=>'postCheckNameAdd','uses' => 'CategoryController@postCheckNameAdd']);
            Route::post('checkNameEdit', ['as'=>'postCheckNameEdit','uses' => 'CategoryController@postCheckNameEdit']);
            Route::post('checkAliasAdd', ['as'=>'postCheckAliasAdd','uses' => 'CategoryController@postCheckAliasAdd']);
            Route::post('checkAliasEdit', ['as'=>'postCheckAliasEdit','uses' => 'CategoryController@postCheckAliasEdit']);
            // Ajax 
            Route::post('Active', ['as'=>'postActiveCategory','uses' => 'CategoryController@postActiveCategory']);
            Route::post('Idx', ['as'=>'postIdxCategory','uses' => 'CategoryController@postIdxCategory']);
        });
        // Trang xử lý thông tin công ty
        Route::group(['prefix' => 'company'], function() {
            Route::get('/', ['as'=>'getCompany','uses' => 'CompanyController@getCompany']);
            Route::post('map', ['as'=>'postCompanyMap','uses' => 'CompanyController@postCompanyMap']);
            Route::post('/', ['as'=>'postCompany','uses' => 'CompanyController@postCompany']);
            Route::post('img', ['as'=>'postCompanyImg','uses' => 'CompanyController@postCompanyImg']);
            Route::post('logo', ['as'=>'postCompanyLogo','uses' => 'CompanyController@postCompanyLogo']);
        });
        // Trang xử lý slider
        Route::group(['prefix' => 'slider'], function() {
            // danh sách bài viết
            Route::get('/', ['as'=>'getSliders','uses' => 'SliderController@getSliders']);
            // thêm bài viết
            Route::get('getAddSlider', ['as'=>'getAddSlider','uses' => 'SliderController@getAddSlider']);
            Route::post('add', ['as'=>'postAddSlider','uses' => 'SliderController@postAddSlider']);
            // Sửa bài viết
            Route::get('edit/{id}', ['as'=>'getEditSlider','uses' => 'SliderController@getEditSlider'])->where(['id'=>'[0-9]+']);
            Route::post('editSlider', ['as'=>'postEditSlider','uses' => 'SliderController@postEditSlider']);
            // Ajax 
            Route::post('Active', ['as'=>'postActiveSlider','uses' => 'SliderController@postActiveSlider']);
            // Xóa bài viết
            Route::post('delete', ['as'=>'postSliderDel','uses' => 'SliderController@postSliderDel']);
            Route::post('deleteCheck', ['as'=>'postSliderDelCheck','uses' => 'SliderController@postSliderDelCheck']);
        });
        // Trang xử lý Popup
        Route::group(['prefix' => "popup"],function(){
            // danh sách popup
            Route::get('/','PopupController@getPopup')->name('getPopup');
            // Thêm popup
            Route::get('getAddPopup','PopupController@getAddPopup')->name('getAddPopup');
            Route::post('add','PopupController@postAddPopup')->name('postAddPopup');
            // sửa popup
            Route::get('edit/{id}','PopupController@getEditPopup')->where(['id'=>'[0-9]+'])->name('getEditPopup');
            Route::post('editPopup','PopupController@postEditPopup')->name("postEditPopup");
            // xóa popup
            Route::post('delete','PopupController@postPopupDel')->name('postPopupDel');
            // Route::post('deleteCheck','PopupController@postPopupDelCheck')->name('postPopupDelCheck');
        });

        // trang xủ lý quảng cáo
        Route::group(['prefix' => "ads"],function(){
            // Danh sách quảng cáo
            Route::get('/','AdvertiseController@getAds')->name('getAds');
            // Thêm quảng cáo
            Route::get('getAddAds','AdvertiseController@getAddAds')->name('getAddAds');
            Route::post('add','AdvertiseController@postAddAds')->name('postAddAds');
            //Sửa quảng cáo
            Route::get('edit/{id}','AdvertiseController@getEditAds')->where(['id'=>'[0-9]+'])->name('getEditAds');
            Route::post('editAds','AdvertiseController@postEditAds')->name("postEditAds");
            // Xóa quảng cáo
            Route::post('delete','AdvertiseController@postAdsDel')->name('postAdsDel');
        });

        // Trang xử lý giỏ hàng
        Route::group(['prefix' => 'cart'], function() {
            // danh sách các đơn hàng
            Route::get('/', ['as'=>'getCartControl','uses' => 'CartController@getCartControl']);
            // chi tiết đơn hàng
            Route::get('/detailCart/{id}', ['as'=>'getEditCartControl','uses' => 'CartController@getEditCartControl'])->where(['id'=>'[0-9]+']);
            // cập nhập đơn hàng -------------------chưa xong--------------------------
            Route::post('/detailCart', ['as'=>'postEditCartControl','uses' => 'CartController@postEditCartControl']);
            /*gửi đơn hàng đến đối tác*/
            Route::post('/sendCart', ['as'=>'postSendCartControl','uses' => 'CartController@postSendCartControl']);
            /*Hủy đơn hàng*/
            Route::post('/CancelCart', ['as'=>'postCancelCartControl','uses' => 'CartController@postCancelCartControl']);
            /*Xác nhận đơn hàng*/
            Route::post('/SuccessCart', ['as'=>'postSuccessCartControl','uses' => 'CartController@postSuccessCartControl']);
            // Xóa đơn hàng
            Route::post('delete', ['as'=>'postCartDel','uses' => 'CartController@postCartDel']);
        });
        // Trang xử lý liên hệ
        Route::group(['prefix' => 'contact'], function() {
            // danh sách liên hệ
            Route::get('/', ['as'=>'getContact','uses' => 'ContactController@getContact']);
            // Xóa liên hệ
            Route::post('delete', ['as'=>'postContactDel','uses' => 'ContactController@postContactDel']);
        });
        // Trang xử lý đối tác
        Route::group(['prefix' => 'partner'], function() {
            // danh sách các đối tác
            Route::get('/', ['as'=>'getPartner','uses' => 'PartnerController@getPartner']);
            // thêm đối tác
            Route::get('addPartner', ['as'=>'getAddPartner','uses' => 'PartnerController@getAddPartner']);
            Route::post('saveAddPartner', ['as'=>'postAddPartner','uses' => 'PartnerController@postAddPartner']);
            Route::post('postActivePartner', ['as'=>'postActivePartner','uses' => 'PartnerController@postActivePartner']);
            // chi tiết đối tác (xem và chỉnh sửa)
            Route::get('/{id}', ['as'=>'getEditPartner','uses' => 'PartnerController@getEditPartner'])->where(['id'=>'[0-9]+']);
            Route::post('saveEditPartner', ['as'=>'postEditPartner','uses' => 'PartnerController@postEditPartner']);
            // Xóa xóa đối tác
            Route::post('delete', ['as'=>'postPartnerDel','uses' => 'PartnerController@postPartnerDel']);
            Route::post('deleteCheck', ['as'=>'postPartnerDelCheck','uses' => 'PartnerController@postPartnerDelCheck']);
        });
        // Trang xử lý khách hàng
        Route::group(['prefix' => 'account'], function() {
            // danh sách các khách hàng
            Route::get('/', ['as'=>'getAccountAdmin','uses' => 'AccountController@getAccountAdmin']);
            // thêm khách hàng
            Route::get('addAccount', ['as'=>'getAddAccount','uses' => 'AccountController@getAddAccount']);
            Route::post('saveAddAccount', ['as'=>'postAddAccount','uses' => 'AccountController@postAddAccount']);
            Route::post('postActiveAccount', ['as'=>'postActiveAccount','uses' => 'AccountController@postActiveAccount']);
            // chi tiết khách hàng (xem và chỉnh sửa)
            Route::get('/{id}', ['as'=>'getEditAccount','uses' => 'AccountController@getEditAccount'])->where(['id'=>'[0-9]+']);
            Route::post('saveEditAccount', ['as'=>'postEditAccount','uses' => 'AccountController@postEditAccount']);
            // Xóa xóa khách hàng
            Route::post('delete', ['as'=>'postAccountDel','uses' => 'AccountController@postAccountDel']);
            Route::post('deleteCheck', ['as'=>'postAccountDelCheck','uses' => 'AccountController@postAccountDelCheck']);
        });
        // Trang xử lý thông tin user
        Route::group(['prefix' => 'user'], function() {
            Route::get('show/{role}','UserController@showRole')->name('role-user');
            Route::get('/', function() {
                return view('control.users.index');
            });
            Route::get('register', ['as'=>'getRegister','uses' => 'UserController@getRegister']);
            Route::post('register', ['as'=>'postRegister','uses' => 'UserController@postRegister']);
            Route::get('edit/{id}', ['as'=>'getEdit','uses' => 'UserController@getEdit'])->where(['id'=>'[0-9]+']);
            Route::post('edit', ['as'=>'postEdit','uses' => 'UserController@postEdit']);
        });
        //Cập nhật Sitemap
        Route::get('sitemap',['as'=>'getSitemap','uses' => 'ControlController@getSitemap']);
    });
});
    Route::get('/', ['as'=>'getIndex','uses' => 'PublicController@getIndex']);
    // Giỏ hàng 
   /* Route::get('gio-hang', ['as'=>'getCart','uses' =>'PublicController@getCart']);
    Route::get('thanh-toan', ['as'=>'getCheckOut','uses' =>'PublicController@getCheckOut']);*/
    /*Đăng nhập bằng Facebook*/
    Route::get('login/facebook', ['as'=>'getLoginFb','uses' =>'PublicController@redirectToProvider']);
    Route::get('login/facebook/callback', ['as'=>'getLoginFbCallBack','uses' =>'PublicController@handleProviderCallback']);
/*Đăng nhập bằng Google*/
     Route::get('login/google', ['as'=>'getLoginGoogle','uses' =>'PublicController@redirectToProviderGoogle']);
    Route::get('login/google/callback', ['as'=>'getLoginGoogleCallBack','uses' =>'PublicController@handleProviderGoogleCallback']);

    // Đăng ký thành viên
    Route::group(['prefix' => 'account'], function() {
        Route::get('/',['as'=>'getAccount','uses' => 'PublicController@getAccount']);
        // xem chi tiết đơn hàng
        Route::get('order/{CartCode}', ['as'=>'getOrder','uses' =>'PublicController@getOrder'])->where(['CartCode'=>'[0-9]+']);
        // thay đổi thông tin tài khoản
        Route::get('/update',['as'=>'getUpdateAccount','uses' => 'PublicController@getUpdateAccount']);
        Route::post('/update',['as'=>'postUpdateAccount','uses' => 'PublicController@postUpdateAccount']);
        // đăng nhập
        Route::get('/login',['as'=>'getLoginAccount','uses' => 'PublicController@getLoginAccount']);
        Route::post('/checkLogin',['as'=>'postLoginAccount','uses' => 'PublicController@postLoginAccount']);
        // Đăng xuất
        Route::get('/logout',['as'=>'getLogout','uses' => 'PublicController@getLogout']);
        // Đăng ký tài khoản
        Route::get('/register', ['as'=>'getRegisterAccount','uses' => 'PublicController@getRegisterAccount']);
        Route::post('/checkRegister', ['as'=>'postRegisterAccount','uses' => 'PublicController@postRegisterAccount']);
        // Quên mật khẩu
        Route::post('/sendlinkmail', ['as'=>'sendResetLinkEmail','uses' => 'PublicController@sendResetLinkEmail']);
        Route::get('/password-reset/{token}/{email}', ['as'=>'getPasswordResetAccount','uses' => 'PublicController@getPasswordResetAccount']);
        Route::post('/password-reset', ['as'=>'postPasswordReset','uses' => 'PublicController@postPasswordReset']);
    });

    // Đăng ký đối tác
    Route::group(['prefix' => 'partner'], function() {
        Route::get('/',['as'=>'getPartnerMain','uses' => 'MainPartnerController@getPartnerMain']);
        // xem chi tiết đơn hàng
        Route::get('order/{CartCode}', ['as'=>'getOrderPartner','uses' =>'MainPartnerController@getOrderPartner'])->where(['CartCode'=>'[a-zA-Z0-9]+']);
        // thay đổi thông tin tài khoản
        Route::get('/update',['as'=>'getUpdatePartner','uses' => 'MainPartnerController@getUpdatePartner']);
        Route::post('/update',['as'=>'postUpdatePartner','uses' => 'MainPartnerController@postUpdatePartner']);
        // đăng nhập
        Route::get('/login',['as'=>'getLoginPartner','uses' => 'MainPartnerController@getLoginPartner']);
        Route::post('/checkLogin',['as'=>'postLoginPartner','uses' => 'MainPartnerController@postLoginPartner']);
        // Đăng xuất
        Route::get('/logout',['as'=>'getLogoutPartner','uses' => 'MainPartnerController@getLogoutPartner']);
        // Đăng ký tài khoản
        Route::get('/register', ['as'=>'getRegisterPartner','uses' => 'MainPartnerController@getRegisterPartner']);
        Route::post('/checkRegister', ['as'=>'postRegisterPartner','uses' => 'MainPartnerController@postRegisterPartner']);
        // Quên mật khẩu
        Route::post('/sendlinkmail', ['as'=>'sendResetLinkEmailPartner','uses' => 'MainPartnerController@sendResetLinkEmailPartner']);
        Route::get('/password-reset/{token}/{email}', ['as'=>'getPasswordResetPartner','uses' => 'MainPartnerController@getPasswordResetPartner']);
        Route::post('/password-reset', ['as'=>'postPasswordPartnerReset','uses' => 'MainPartnerController@postPasswordPartnerReset']);
        Route::post('/password-change', ['as'=>'postChangePassword','uses' => 'MainPartnerController@postChangePassword']);
        /*---Thông báo---*/
        Route::get('/notification',['as'=>'getNotificationPartner','uses' => 'MainPartnerController@getNotificationPartner']);
        Route::post('/read-notification', ['as'=>'postReadNotification','uses' => 'MainPartnerController@postReadNotification']);
        Route::post('/add-cart-partner', ['as'=>'postAddCartPartner','uses' => 'MainPartnerController@postAddCartPartner']);
        Route::post('/success-cart-partner', ['as'=>'postSuccessCartPartner','uses' => 'MainPartnerController@postSuccessCartPartner']);
        Route::post('/cancel-cart-partner', ['as'=>'postCancelCartPartner','uses' => 'MainPartnerController@postCancelCartPartner']);

    });
    Route::post('tinh-gia', ['as'=>'postcheckKm','uses' => 'PublicController@postcheckKm']);
    Route::get('delete/{id}', ['as'=>'delItemCart','uses' =>'PublicController@delItemCart']);
    Route::get('/{root}', ['as'=>'getRoot','uses' => 'PublicController@getRoot']);
    Route::get('/{root}/{detail}.html', ['as'=>'getRootDetail','uses' => 'PublicController@getRootDetail']);
    
    Route::get('/{root}/{parent}', ['as'=>'getParent','uses' => 'PublicController@getParent']);
    Route::get('/{root}/{parent}/{detail}.html', ['as'=>'getParentDetail','uses' => 'PublicController@getParentDetail']);

    Route::get('/{root}/{parent}/{child}', ['as'=>'getChild','uses' => 'PublicController@getChild']);
    Route::get('/{root}/{parent}/{child}/{detail}.html', ['as'=>'getChildDetail','uses' => 'PublicController@getChildDetail']);
     // Ajax 
    Route::post('AddCart', ['as'=>'postAddCart','uses' => 'PublicController@postAddCart']);
    Route::post('AddItemCart', ['as'=>'postAddItemCart','uses' => 'PublicController@postAddItemCart']);
    Route::post('UpdateCart', ['as'=>'postUpdateCart','uses' => 'PublicController@postUpdateCart']);
    Route::post('CreateCart', ['as'=>'postCreateCart','uses' => 'PublicController@postCreateCart']);

    Route::post('contact', ['as'=>'postContact','uses' => 'PublicController@postContact']);
    Route::post('tim-kiem-san-pham', ['as'=>'postSeachProduct','uses' => 'PublicController@postSeachProduct']);

