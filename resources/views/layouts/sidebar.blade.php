  @if (!Auth::guest())
<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-speedometer"></i>Admin Menu</a>
                    </li> --}}

                  @if (auth()->user()->user_type == config('constants.admintype'))
                    <li class="nav-title">
                        Admin Menu
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> ตั้งค่า</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-drawer"></i> สินค้า</a>
                                <ul class="nav-dropdown-items">
                                  <li class="nav-item"><a href="/store" class="nav-link"><i class="icon-drawer"></i>เพิ่มสินค้าใหม่</a></li>
                                  <li class="nav-item"><a href="/product" class="nav-link"><i class="icon-drawer"></i>สินค้าทั้งหมด</a></li>
                                  <li class="nav-item"><a href="/category" class="nav-link"><i class="icon-drawer"></i>ประเภทสินค้า</a></li>
                                  <li class="nav-item"><a href="/style/main" class="nav-link"><i class="icon-drawer"></i>สไตล์สินค้า</a></li>



                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/shipping"><i class="icon-rocket"></i> การขนส่ง</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> การเงิน</a>
                            </li> --}}
                             <li class="nav-item nav-dropdown">
                                <a class="nav-link  nav-dropdown-toggle" href="#"><i class="icon-people"></i> บัญชี</a>
                                <ul class="nav-dropdown-items">
                                  <li class="nav-item"><a href="/createuser" class="nav-link"><i class="icon-user-follow"></i>เพิ่มผู้ใช้งาน</a></li>
                                  <li class="nav-item"><a href="/listuser" class="nav-link"><i class="icon-user"></i>ผู้ใช้งานทั้งหมด</a></li>
                                   <li class="nav-item"><a href="/supplier/create" class="nav-link"><i class="icon-user-follow"></i>เพิ่ม supplier ใหม่</a></li>
                                   <li class="nav-item"><a href="/supplier" class="nav-link"><i class="icon-user"></i>supplier ทั้งหมด</a></li>
                                   <li class="nav-item"><a href="/store/create" class="nav-link"><i class="icon-user-follow"></i>เพิ่มร้านค้าใหม่</a></li>
                                    <li class="nav-item"><a href="/store" class="nav-link"><i class="icon-user-follow"></i>ร้านค้าทั้งหมด</a></li>
                                   <li class="nav-item"><a href="/reseller/create" class="nav-link"><i class="icon-user-follow"></i>เพิ่ม reseller ใหม่</a></li>
                                   <li class="nav-item"><a href="/reseller" class="nav-link"><i class="icon-user"></i>reseller ทั้งหมด</a></li>

                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> การเงิน</a>
                        <ul class="nav-dropdown-items">
                          <li class="nav-item">
                              <a class="nav-link" href="/cashadmin"><i class="icon-list"></i>รายการเงินทั้งหมด</a>
                          </li>

                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-doc"></i> รายงาน</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-doc"></i>ยอดขาย</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-doc"></i>คลังสินค้า</a>
                            </li>
                        </ul>
                    </li>
                    {{-- end admin menu --}}
                    @endif
                    {{-- supplier --}}
                    @if (auth()->user()->user_type == config('constants.suppliertype'))
                      <li class="nav-title">
                          Supplier Menu
                      </li>
                      <li class="nav-item nav-dropdown">
                          <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> การเงิน</a>
                          <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="/cash"><i class="icon-list"></i>บัญชีของฉัน</a>
                            </li>
                              {{-- <li class="nav-item">
                                  <a class="nav-link" href="/deposit"><i class="icon-arrow-up-circle"></i>แจ้งฝาก</a>
                              </li> --}}
                              <li class="nav-item">
                                  <a class="nav-link" href="/withdraw"><i class="icon-arrow-down-circle"></i>แจ้งถอน</a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item nav-dropdown">
                          <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-docs"></i> สินค้าของฉัน</a>
                          <ul class="nav-dropdown-items">
                            <li class="nav-item">
                              @isset(auth()->user()->supplier)
                                  <a class="nav-link" href="/storegroup/{{auth()->user()->supplier->id}}"><i class="icon-hourglass"></i>สินค้าทั้งหมด</a>
                              @endisset

                            </li>


                          </ul>
                      </li>
                      <li class="nav-item nav-dropdown">
                          <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-docs"></i> รายการสั่งซื้อ</a>
                          <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="/myorder"><i class="icon-hourglass"></i>กำลังดำเนินการ</a>
                            </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/ordership"><i class="icon-rocket"></i>กำลังจัดส่ง</a>
                              </li>

                          </ul>
                      </li>
                    @endif

                    @if (auth()->user()->user_type == config('constants.resellertype'))
                      {{-- reseller  --}}
                      <li class="nav-title">
                          Reseller Menu
                      </li>
                      <li class="nav-item nav-dropdown">
                          <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-home"></i> Shop</a>
                          <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="/subscribe/{{auth()->user()->reseller->id}}"><i class="icon-home"></i>ร้านค้าทั้งหมด</a>
                            </li>
                              {{-- <li class="nav-item">
                                  <a class="nav-link" href="/createshop"><i class="icon-plus"></i>สร้าง shop</a>
                              </li> --}}

                          </ul>
                      </li>
                      <li class="nav-item nav-dropdown">
                          <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> การเงิน</a>
                          <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="/cash"><i class="icon-list"></i>บัญชีของฉัน</a>
                            </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/deposit"><i class="icon-arrow-up-circle"></i>แจ้งฝาก</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/withdraw"><i class="icon-arrow-down-circle"></i>แจ้งถอน</a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item nav-dropdown">
                          <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-docs"></i> รายการสั่งซื้อ</a>
                          <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="/myorder"><i class="icon-hourglass"></i>กำลังดำเนินการ</a>
                            </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/ordership"><i class="icon-rocket"></i>กำลังจัดส่ง</a>
                              </li>

                          </ul>
                      </li>
                    @endif

                    @if (auth()->user()->user_type == config('constants.sellertype'))
                      {{-- reseller  --}}
                      <li class="nav-title">
                         seller Menu
                      </li>


                      <li class="nav-item nav-dropdown">
                          <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-docs"></i> รายการสั่งซื้อ</a>
                          <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="/myorder"><i class="icon-hourglass"></i>กำลังดำเนินการ</a>
                            </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/ordership"><i class="icon-rocket"></i>กำลังจัดส่ง</a>
                              </li>

                          </ul>
                      </li>
                    @endif


                </ul>
            </nav>
        </div>
  @endif
