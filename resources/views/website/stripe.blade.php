@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
<style>
    .hide{
        display: none;
    }
</style>
	<!-- banner sec -->
    @if(!empty($banner->image))
        <section class="agent-inner-banner" style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');">
    @else
        <section class="agent-inner-banner" style="background-image: url('{{asset('/admin/assets/images/images.png') }}');"style="width:100%">
    @endif
		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-heading">
                        @if(isset($banner))
                            <h1>{{$banner->name}}</h1>
                        @endif
                    </div>
                </div>
            </div>
		</div>
	</section>
	<!-- banner sec -->
    <!-- DETAIL SECTION -->
    <section class="detail-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="subscription-charge payment-img-box"></div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="form-stripe-box">
                        <h1>Pay Here</h1>
                        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Name on Card</label>
                                    <input class='form-control' size='4' type='text' placeholder="Johnson" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Card Number</label>
                                    <input autocomplete='off' class='form-control card-number' maxlength="16" type='text' placeholder="0000 0000 0000" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">Expiration Month</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' maxlength='2' type='text' required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Expiration Year</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' maxlength='4' type='text' required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">CVC</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' maxlength="3" type='text' required>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <button  class="btn btn-warning-stripe btn-lg btn-block" value="Pay Now" style="color: white" type="submit">Pay Now</button>
                                </div>
                                <div class="col-md-12 form-group">
                                    <img src="{{ asset('/assets/website') }}/img/stripe_secure.png" alt="Pay-methods" class="img-fluid">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DETAIL SECTION -->
@endsection
@push('js')
   <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
   <script type="text/javascript">
      $(function() {
      var $form = $(".require-validation");
      $('form.require-validation').bind('submit', function(e) {
         var $form = $(".require-validation"),
         inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
         $inputs = $form.find('.required').find(inputSelector),
         $errorMessage = $form.find('.error'),
         valid = true;
         $errorMessage.addClass('hide');
         $('.has-error').removeClass('has-error');
         $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                  $input.parent().addClass('has-error');
                  $errorMessage.removeClass('hide');
                  e.preventDefault();
            }
         });
         if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
               number: $('.card-number').val(),
               cvc: $('.card-cvc').val(),
               exp_month: $('.card-expiry-month').val(),
               exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
         }
      });

      function stripeResponseHandler(status, response) {
            if (response.error) {
               $('.error')
                  .removeClass('hide')
                  .find('.alert')
                  .text(response.error.message);
            } else {
               /* token contains id, last4, and card type */
               var token = response['id'];
               $form.find('input[type=text]').empty();
               $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
               $form.get(0).submit();
            }
      }
      });
   </script>
@endpush
