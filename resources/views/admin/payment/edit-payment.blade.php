@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/invoice-style.min.css') }}">
@endsection

@section('content')

<div class="col-sm-12" id="sales-edit-payment-container">
	<div class="card">
		<div class="card-header">
			<h5><a href="{{ url('payment/list') }}">{{ __('Payments')  }}</a> >> {{ sprintf("%04d", $payment_info->id) }}</h5>
		</div>
		<div class="card-body">
			<div class="m-t-10 p-0">
				<form action="{{ url('payment/update-payment') }}" method="post" id="payment_update" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
					<input type="hidden" name="menu" value="{{ $menu }}">
					<input type="hidden" name="sub_menu" value="{{ $sub_menu }}">
					<input type="hidden" name="customer" value="{{ $payment_info->customer_id }}">
			        <input type="hidden" name="payment_id" value="{{ $payment_info->id }}">
			        <input type="hidden" name="invoice_currency" value="{{ $payment_info->saleOrder->currency_id }}">
			        <input type="hidden" name="payment_currency" value="{{ $payment_info->currency_id }}">
			        <input type="hidden" name="exchange_rate" value="{{ $payment_info->exchange_rate }}">
			        <input type="hidden" name="account_no" value="{{ isset($payment_info->transactionReference->transactions[0]) ? $payment_info->transactionReference->transactions[0]->account_id : null }}">
			        <input type="hidden" name="order_no" value="{{ $payment_info->sale_order_id }}">
			        <input type="hidden" name="amount" value="{{ $payment_info->amount }}">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">

							@if (isset($payment_info->transactionReference->transactions[0]->account->name))
							    <label class="col-sm-2">{{ __('Account')  }}</label>
							    <label class="col-sm-7 p-md-0 font-weight-bold">
							    	{{ $payment_info->transactionReference->transactions[0]->account->name }} ({{ $payment_info->currency->name }})
							    </label>
							@else
								<label class="col-sm-2">{{ __('Currency')  }}</label>
							    <label class="col-sm-7 p-md-0 font-weight-bold">
							    	{{ $payment_info->currency->name }}
							    </label>
							@endif
						  </div>
							<div class="form-group row">
						    <label class="col-sm-2">{{ __('Amount')  }}</label>
						    <label class="col-sm-7 p-md-0 font-weight-bold">
						    	{{ formatCurrencyAmount($payment_info->amount, $payment_info->currency->symbol) }}
						    </label>
						  </div>
							<div class="form-group row">
						    <label class="	col-sm-2">{{ __('Description')  }}</label>
						    <label class="col-sm-7 p-md-0 font-weight-bold">
						    	{{ isset($payment_info->saleOrder) ? 'Payment for '. $payment_info->saleOrder->reference : '' }}
						    </label>
						  </div>
							<div class="form-group row">
						    <label class="control-label col-sm-2">{{ __('Payment Type') }}</label>
					    	<label class="col-sm-7 p-md-0 font-weight-bold mt-2">
					    		@php
					    			if (isset($payment_info->payment_method_id) && !empty($payment_info->payment_method_id)) {
										foreach($payment_method as $payment) {
											if ($payment->id == $payment_info->payment_method_id) {
												echo sanitize_output($payment->name);
											}
										}
					    			} else {
										echo __('N/A');
					    			}
					    		@endphp
					    	</label>
						  </div>
							<div class="form-group row">
						    <label class="control-label col-sm-2">{{ __('Date')  }}</label>
						    <div class="col-sm-7 p-md-0 font-weight-bold">
							    <div class="input-group date">
							      <div class="input-group-prepend">
							        <i class="fas fa-calendar-alt input-group-text"></i>
							      </div>
							      <input class="form-control"id="payment_date" name="transaction_date" value="{{ formatDate($payment_info->transaction_date) }}">
							    </div>
						    </div>
						  </div>
						</div>
					</div>
			      	<div class="form-group row m-t-10">
			      		<div class="col-md-12">
			      		<div class="row">
						    <label class="control-label col-sm-2">{{ __('File')  }}</label>
						    <div class="col-sm-7 p-md-0">
				              	<div class="dropzone-attachments" id="reply-attachment">
					                <div class="event-attachments">
					                  @forelse($files as $file)
					                    <div class="list-attachments">
					                      <i class="fa fa-times attachment-item-delete" data-id="{{ $file->id }}" data-attachment="{{ $filePath }}/{{ $file->file }}" title="Delete Attachment" aria-hidden="true"></i>
					                      <br>
					                      <i class="{{ $file->icon }}" title="{{ $file->fileName }}"></i>
					                      <input type="hidden" name="attachments[]" value="{{ $file->file }}">
					                    </div>
					                  @empty
					                  @endforelse
					                  <div class="add-attachments"><i class="fa fa-plus"></i></div>
					                </div>
				              	</div>
			              	<div id="uploader-text"></div>
			              	<div class="form-group row mb-0">
		                      <div class="col-sm-12 mt-5">
		                        <span class="badge badge-danger">{{ __('Note')  }}!</span> {{ __('Allowed File Extensions: jpg, png, gif, docx, xls, xlsx, csv and pdf') }}
		                      </div>
		                    </div>
			            </div>
			          </div>
					    </div>
			      	</div>
			      	<div class="form-group row m-t-10" id="reply-btn">
				        <div class="col-sm-6">
						    <div>
						       <button class="btn btn-primary custom-btn-small" id="btnSubmit" type="submit">{{ __('Update')  }}</button>
						       <a href="{{ url('payment/list') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel')  }}</a>
						    </div>     
				        </div>
			      	</div>
		    	</form>
	    	</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="{{ asset('datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('dist/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('dist/js/custom/sales.min.js') }}"></script>
@endsection