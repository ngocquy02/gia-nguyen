<div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-offset-12 col-md-8 col-lg-8 pr-0">
                    <ul class="left menu-top">
                        <li>Hotline: <a href="tel:{{ isset($company) ? $company->Phone : ""}}" title=""><span>{{ isset($company) ? $company->Phone : ""}}</span></a> | </li>
                        <li><a href="tel:{{ isset($company) ? $company->Tax : ""}}" title=""><span>{{ isset($company) ? $company->Tax : ""}}</a></span> | </li>
                        {{-- <li>Tư vấn nội thất: <a href="" title=""><span>Ms.Loan</span></a> | </li> --}}
                        {{-- <li><a href="" title=""><span>0902 569 854</span></a> | </li> --}}
                        {{-- <li>Download: <a href="" title=""><span>Profile</span></a></li> --}}
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <input type="search" name="Search" class=" input-search" required="required" title="Nhập từ khóa tìm kiếm" placeholder="Nhập từ khóa tìm kiếm">
                    <button type="submit" class="btn-search" data-toggle="button" aria-pressed="false" autocomplete="off"><img src="assets/images/tim-kiem.jpg" class="img-fluid" alt="Responsive image"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <img src="{{ isset($company) ? $company->Logo : ""}}" class="img-fluid" alt="Logo công ty">
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row mx-0">
                        <div class="col-lg-12 p-0">
                            <img src="assets/images/quang-cao.png" class="img-fluid logo" alt="Responsive image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


