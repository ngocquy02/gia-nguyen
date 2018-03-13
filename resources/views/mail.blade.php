<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dcf0f8" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
    <tbody>
    <tr>
        <td align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">           
            <table border="0" cellpadding="0" cellspacing="0" width="600" style="margin-top:15px">
                <tbody>
                <tr>
                    <td align="center" valign="bottom" id="m_-6544534697760207179m_-7473677401122386756headerImage">
                        <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom:3px solid #00b7f1;padding-bottom:10px;background-color:#fff">
                            <tbody>
                            <tr>
                                <td valign="top" bgcolor="#FFFFFF" width="100%" style="padding:0">
                                    <a style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 120px 0px 20px" href="{!!$Link!!}">
                                        <img src="{!!$Logo!!}" class="CToWUd">
                                    </a>              
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>                
                <tr style="background:#fff">
                    <td align="left" width="600" height="auto" style="padding:15px">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách {!!$FullName!!} đã đặt hàng tại {!!$Name!!},</h1>
                                        <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        {!!$Name!!} rất vui thông báo đơn hàng của quý khách đã
                                        được tiếp nhận và đang trong quá trình xử lý. {!!$Name!!} sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.
                                    </p>
                                    <h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">
                                        Thông tin đơn hàng <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày {!!$time->format('d')!!} Tháng {!!$time->format('m')!!} Năm {!!$time->format('Y')!!})</span>
                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">Thông tin thanh toán
                                            </th>
                                            <th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold"> Thông tin giao hàng</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td valign="top" style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                <span style="text-transform:capitalize">{!!$FullName!!}</span><br>
                                                <a href="mailto:{!!$Email!!}" target="_blank">{!!$Email!!}</a><br>
                                                {!!$Phone!!}
                                            </td>

                                            <td valign="top" style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                <span style="text-transform:capitalize">
                                                Address:{!!$FullNameShip!!}</span><br>
                                                {!!$AddressShip!!}<br>Phone: {!!$PhoneShip!!}
                                            </td>
                                        </tr>                                       
                                        <tr>
                                            <td valign="top" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" colspan="2">
                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                    <strong>Phương thức thanh toán: </strong>
                                                    Thanh toán tiền mặt khi nhận hàng
                                                    <br>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">
                                        CHI TIẾT ĐƠN HÀNG</h2>
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
                                        <thead>
                                        <tr>
                                            <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                                            <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> Đơn giá</th>
                                            <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
                                            <th align="right" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
                                        </tr>
                                        </thead>
                                        <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                            @php $summary=0; @endphp
                                            @foreach($ProductCart as $ProductCart)
                                            <tr>
                                                <td align="left" valign="top" style="padding:3px 9px">
                                                    <span >{!!$ProductCart->Name!!}</span><br>
                                                                                                </td>
                                                <td align="left" valign="top" style="padding:3px 9px"><span>{!!number_format($ProductCart->Price)!!} ₫</span></td>
                                                <td align="left" valign="top" style="padding:3px 9px">{!!$ProductCart->Quantity!!}</td>
                                                <td align="right" valign="top" style="padding:3px 9px"><span>{!!number_format($ProductCart->Price*$ProductCart->Quantity)!!} ₫</span></td>
                                            </tr>
                                            @php $summary = $summary + ($ProductCart->Price*$ProductCart->Quantity); @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">                                      
                                        <tr bgcolor="#eee">
                                            <td colspan="4" align="right" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big></strong></td>
                                            <td align="right" style="padding:7px 9px"><strong><big><span>{!!number_format($summary)!!} ₫</span></big></strong></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <br>

                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                                        Một lần nữa {!!$Name!!} cảm ơn quý khách.<br>
                                    </p>
                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right">  
                                      <strong><a style="color:#00a3dd;text-decoration:none;font-size:14px" href="{!!$Link!!}" target="_blank" >{!!$Name!!}</a></strong><br>
                                    </p>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </td>
                </tr>

                </tbody>

            </table>

        </td>

    </tr>
    </tbody>
</table>