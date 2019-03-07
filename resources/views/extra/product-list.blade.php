<!-- Vendor Listing -->
<div class="portfolio-grid vendor-list clearfix">

  <!-- Grid Item -->
  <div class="productList">
    @foreach($datas as $data)
      <div class="mix green">
        <div class="portfolio-wrapper divclick">
          @php
          if(!empty($data->vendor->profile_img)) {
            $img = $data->vendor->profile_img;
          }
          else {
            $img = 'img/vendor-profile/default.png';
          }
          @endphp
          <img src="{{asset($img)}}" alt="{{ $data->vendor->title }}">
          <div class="caption">
            <div class="caption-text pull-left">
              <a class="text-title" href="{{url('vendors/'.$catagory = $catagorydata->name.'/'.$vendor = $data->vendor->id)}}">{{ $data->vendor->title }}</a>
              <span class="text-category" style="text-transform:uppercase;">{{ $catagorydata->name }}</span>
            </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
</div>
<!--/ End Vendor Listing -->
