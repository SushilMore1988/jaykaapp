<div class="mx-3 logo-position customer-padding row justify-content-between">
      @if (isset($company_logo) && !empty($company_logo) && file_exists('uploads/companyPic/' . $company_logo))
      <div class="logo_bg image-left"><img src="{{ asset('uploads/companyPic/'.$company_logo) }}" /></div>
      @endif
  </div>