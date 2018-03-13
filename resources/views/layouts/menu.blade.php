<div type="context toolbar" class="mb-0 menu">
    <div class="container">
        <div class="row">
            <div id="cssmenu" style="text-transform: uppercase;">
                @php
                    $data=App\Models\Category::select('id','ParentID','Alias','Name','Type','IsActive','Level','Icon')->where([['IsActive','=',1]])->orderBy('Idx')->get()->ToArray();
                    subMenu($data,0,$root);
                @endphp
                {{-- <ul class="p-0 m-0">
                    <li><a href="" title="">Trang chủ</a></li>
                    <li><a href="" title="">Giới thiệu</a></li>
                    <li><a href="products.html" title="">Sản phẩm</a>
                        <ul class="p-0">
                            <li><a href="products.html" title="">> Quầy kệ quảng cáo</a>
                                <ul>
                                    <li><a href="products.html" title="">> Kệ sắt, kệ bán hàng</a></li>
                                    <li><a href="products.html" title="">> Kệ treo, kệ để bàn</a></li>
                                    <li><a href="products.html" title="">> Kệ kệ sơn tĩnh điện</a></li>
                                </ul>
                            </li>
                            <li><a href="products.html" title="">> Hanger quảng cáo</a>
                                <ul>
                                    <li><a href="products.html" title="">> Hanger săt, giấy</a></li>
                                    <li><a href="products.html" title="">> Hanger nhựa, format</a></li>
                                    <li><a href="products.html" title="">> Hanger treo mẫu vải</a></li>
                                    <li><a href="products.html" title="">> Hanger treo mẫu quảng cáo</a></li>
                                    <li><a href="products.html" title="">> Hanger giấy trưng bày</a></li>
                                    <li><a href="products.html" title="">> Hanger dây nhựt kẹp móc</a></li>
                                    <li><a href="products.html" title="">> Hanger treo thảm sàn nhà</a></li>
                                </ul>
                            </li>
                            <li><a href="products.html" title="">> In ấn quảng cáo</a>
                                <ul>
                                    <li><a href="products.html" title="">> In decal, pp, giấy các loại</a></li>
                                    <li><a href="products.html" title="">> In UV, bạc hiflex, băng role,...</a></li>
                                </ul>
                            </li>
                            <li><a href="products.html" title="">> Stadee quảng cáo</a>
                                <ul>
                                    <li><a href="products.html" title="">> Stadee chữ T</a></li>
                                    <li><a href="products.html" title="">> Stadee chữ X</a></li>
                                    <li><a href="products.html" title="">> Stadee sắt</a></li>
                                    <li><a href="products.html" title="">> Stadee cuộn nhôm nhựa</a></li>
                                </ul>
                            </li>
                            <li><a href="products.html" title="">> Wobbler quảng cáo</a>
                                <ul>
                                    <li><a href="products.html" title="">> Wobbler để bàn đế mica</a></li>
                                    <li><a href="products.html" title="">> Wobbler để bàn đế inox</a></li>
                                    <li><a href="products.html" title="">> Wobbler để bàn đế nhựa</a></li>
                                    <li><a href="products.html" title="">> Wobbler để bàn đế sơn tĩnh điện</a></li>
                                    <li><a href="products.html" title="">> In Wobbler</a></li>
                                </ul>
                            </li>
                            <li><a href="products.html" title="">> Chai nhựa - bình nước nhựa</a>
                                <ul>
                                    <li><a href="products.html" title="">> Chai mỹ phẩm, dược phẩm</a></li>
                                    <li><a href="products.html" title="">> Chai đựng bột giặt, nước xã</a></li>
                                    <li><a href="products.html" title="">> Chai đựng nhớt ô tô, xe máy</a></li>
                                    <li><a href="products.html" title="">> Chai đựng thuốc bảo vệ thực vật</a></li>
                                </ul>
                            </li>
                            <li><a href="products.html" title="">> Kẹp lò xo quảng cáo</a>
                                <ul>
                                    <li><a href="products.html" title="">> Kẹp lò xo 2 đầu</a></li>
                                    <li><a href="products.html" title="">> Kẹp lò xo inox</a></li>
                                    <li><a href="products.html" title="">> kẹp lò xo nhựa</a></li>
                                    <li><a href="products.html" title="">> Kẹp quảng cáo 2 mặtt</a></li>
                                </ul>
                            </li>
                            <li><a href="products.html" title="">> Hộp mica quảng cáo</a></li>
                            <li><a href="products.html" title="">> Túi nhựa trong, zip bơ</a></li>
                            <li><a href="products.html" title="">> Showroom triển lãm</a></li>
                            <li><a href="products.html" title="">> Giang hàng hội chợ</a></li>
                            <li><a href="products.html" title="">> Mô hình 3D, cổng chào</a></li>
                            <li><a href="products.html" title="">> Pano ngoài trời</a></li>
                            <li><a href="products.html" title="">> Bảng hiệu hộp đèn</a></li>
                        </ul>
                    </li>
                    <li><a href="" title="">Đối tác</a></li>
                    <li><a href="" title="">Xưởng sản xuất</a></li>
                    <li><a href="" title="">Thương mại -Xuất nhập khẩu</a></li>
                    <li><a href="" title="">Thanh Toán</a></li>
                    <li><a href="" title="">Tin tức</a></li>
                    <li><a href="" title="">Liên hệ</a></li>
                </ul> --}}
            </div>
        </div>
    </div>
</div>


{{-- <div class="menu">
    <nav class="header_menu">
        <div class="container" style="width: 100%;">
            <div id="cssmenu">
                @php
                    $data=App\Models\Category::select('id','ParentID','Alias','Name','Type','IsActive','Level','Icon')->where([['IsActive','=',1]])->orderBy('Idx')->get()->ToArray();
                    subMenu($data,0,$root);
                @endphp
            </div>
        </div>
    </nav>
</div> --}}