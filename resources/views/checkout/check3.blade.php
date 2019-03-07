@extends('layouts.app')
@push('css')
<link href="css/account.css" rel="stylesheet" type="text/css">
@endpush


@section('content')
  <!-- Masthead -->
<header class="pagehead" style="background-image: url('img/backgrounds/bg-footer.jpg');">
  <div class="container">
    <div class="row">
      <div class="col-12 my-auto text-center text-white">
        <img class="pagehead-img img-responsive mb-3" src="img/ayojok-logo-transparent.png" alt="">
      </div>
    </div>
  </div>
</header>
<!-- FB Profile Style -->

<!-- Blank section -->


<section class="page-section mt-4 mb-4">
  <div class="container">

    <div class="row mb-4">
      <div class="col-lg-12">
        <div class="wow fadeIn">
          <h3><i class="fa fa-shopping-cart fa-lg" style="margin-right:1rem;"></i>  PAYMENT METHOD</h3>
        </div>
      </div>
    </div>


    {{-- <div class="row mt-4">
      <div class="col-lg-12">
        <ul class="orderStep orderStepLook2">
          <li><a href="#"> <i class="fa fa-map-marker "></i> <span> address</span></a></li>
          <li><a href="#"><i class="fa fa-truck "> </i><span>Shipping</span> </a></li>
          <li class="active"><a href="#"><i class="fa fa-money  "> </i><span>Payment</span> </a></li>
          <li><a href="#"><i class="fa fa-check-square "> </i><span>Order</span></a>
          </li>
        </ul>
      </div>
    </div> --}}

    {{-- <div class="row">
      <div class="col-lg-12">
        <div class="my-account">
          <p>PAYMENT METHOD</p>
        </div>
      </div>
    </div> --}}



    <div class="row">
      <div class="col-lg-12">
        <p class="mb-3">Please select a payment method to complete your order. If you do any customization in your ordered products, please pay the additional payment during delivery.</p>
        <div id="accordion">
          {{-- Cash on Delivery --}}
          {{-- <div class="card mb-2">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <span style="font-weight:600;">Option 1 </span> Cash on Delivery
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body mb-5">
                <p>All transactions are secure and encrypted, and we never store. To learn more, please view our privacy policy.</p>
                <br>
                {!! Form::open(array('route' => 'paymentAdd', 'method' => 'POST'))  !!}
                  <div class="checkout-address form-group">
                    <label class="container">Cash On Delivery
                      <input required type="radio" value="1" name ="paymentCheck">
                      <span class="checkradio"></span>
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="CommentsCOD"><h6>Add Comments About Your Order</h6></label>
                    <textarea class="form-control" name="Comments" cols="26" rows="3"></textarea>
                  </div>
                  <div class="checkout-address form-group">
                    <label class="container">I have read and agree to the <a href="{{route('terms-condition')}}">Terms & Conditions</a>
                      <input required type="checkbox" value="1" name ="codTermCheck">
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-proceed btn-lg"> Place Order &nbsp; <i class="fa fa-check-square"></i> </button>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div> --}}

            {{-- Bkash --}}
            <div class="card mb-2">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span style="font-weight:600;">Option 1 </span>Bkash
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body mb-5">
                  <p>All transactions are secure and encrypted, and we never store. To learn more, please view our <a href="{{route('privacy')}}">privacy policy</a>.</p>
                  <br>
                  {!! Form::open(array('route' => 'paymentAdd', 'method' => 'POST'))  !!}
                    <div class="checkout-address form-group">
                      <label class="container">
                        <img src="https://www.bkash.com/sites/all/themes/bkash/logo.png" width="80rem" alt="Bkash">  Checkout with Bkash
                        <input required type="radio" value="2" name ="paymentCheck">
                        <span class="checkradio"></span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="usedBkash"><h6>Sender Bkash Number</h6></label>
                      <input type="text" class="form-control" name="used_num" placeholder="xxxx-xxxxxxx" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" required>
                      <p class="help-block">Enter the bkash number used for the payment.</p>
                    </div>
                    <div class="form-group">
                      <label for="trxid"><h6>Transaction ID</h6></label>
                      <input type="text" class="form-control" name="trxid" placeholder="xxxxxxxx" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57 || event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122" style="text-transform:uppercase" required>
                      <p class="help-block">After succesful transaction there will be a <b>TrxID</b>, please enter that TrxID.</p>
                    </div>
                    <div class="form-group">
                      <label for="CommentsBkash"><h6>Add Comments About Your Order</h6></label>
                      <textarea class="form-control" name="comments" cols="26" rows="3"></textarea>
                    </div>
                    <div class="checkout-address form-group">
                      <label class="container">I have read and agree to the <a href="#">Terms & Conditions</a>
                        <input required type="checkbox" value="1" name ="bkashTermCheck">
                        <span class="checkmark"></span>
                      </label>
                    </div>
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary btn-proceed btn-lg"> Place Order &nbsp; <i class="fa fa-check-square"></i> </button>
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>

              {{-- <div class="card mb-2">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <span style="font-weight:600;">Option 2 </span> MasterCard
                    </button>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                  <div class="card-body mb-5">
                    <p>All transactions are secure and encrypted, and we never store. To learn more, please view our privacy policy.</p>
                    <br>
                    <form class="" action="#" role="form">

                        <p>Supported Credit Cards</p>

                        <div class="form-group">
                          <label for="CardNumber">Credit Card Number *</label>
                          <br/>
                          <input id="CardNumber" type="text" name="Number">
                        </div>
                        <!--paymentInput-->
                        <div class="form-group">
                          <label for="CardNumber2">Name on Credit Card *</label>
                          <br/>
                          <input type="text" name="CardNumber2" id="CardNumber2">
                        </div>
                        <!--paymentInput-->
                        <div class="form-group">
                          <label>Expiration date *</label>
                          <div class="row">
                            <div class="col-lg-4">
                              <select class="form-control" required="" aria-required="true" name="expire" tabindex="-1" aria-hidden="true">
                                <option value="">Month</option>
                                <option value="1">01 - January</option>
                                <option value="2">02 - February</option>
                                <option value="3">03 - March</option>
                                <option value="4">04 - April</option>
                                <option value="5">05 - May</option>
                                <option value="6">06 - June</option>
                                <option value="7">07 - July</option>
                                <option value="8">08 - August</option>
                                <option value="9">09 - September</option>
                                <option value="10">10 - October</option>
                                <option value="11">11 - November</option>
                                <option value="12">12 - December</option>
                              </select>
                            </div>
                            <div class="col-lg-4">
                              <select class="form-control" required="" aria-required="true" name="year" tabindex="-1" aria-hidden="true">
                                <option value="">Year</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!--paymentInput-->
                        <div class="form-group">
                          <label for="VerificationCode">Verification Code *</label>
                          <br/>
                          <input type="text" name="VerificationCode" value="" id="VerificationCode">
                        </div>

                        <div class="checkout-address form-group">
                          <label class="container">Save my Card Information
                            <input type="checkbox" value="" id="defaultCheck1">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                        <div class="pull-right"><a href="checkout-4.html" class="btn btn-proceed btn-lg"> Order
                          &nbsp; <i class="fa fa-arrow-circle-right"></i> </a></div>

                      </form>
                    </div>
                  </div>
                </div> --}}

              </div>

            </div>
            {{-- <div class="col-lg-4">
              <!-- checkout card -->
              <div class="card">
                <div class="card-body">
                  <div class="row table-responsive">
                    <table class="table">
                      <tr>
                        <td>Total Price</td>
                        <td style="font-weight:700;">BDT {{session('total')}}</td>
                      </tr>
                      <tr>
                        <td>Shipping</td>
                        <td style="font-weight:700; color:grey;">Free Shipping</td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td style="color:rgb(244, 127, 32); font-weight:800;">BDT {{session('totalall')}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <!-- End of Checkout card -->
            </div> --}}

          </div>

          <div class="row mb-5">
            <div class="col-lg-12 ">
              <ul class="pager">
                <li class="previous pull-left"><a href="{{route('payment')}}"> <i class="fa fa-arrow-left"></i>  Payment</a></li>
                <!-- <li class="next pull-right"><a href="checkout-2.html">Payment Method <i class="fa fa-arrow-right"></i></a></li> -->
              </ul>
            </div>
          </div>


        </div>
      </section>
@endsection

@push('scripts')

@endpush
