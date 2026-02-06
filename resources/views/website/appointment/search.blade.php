@foreach($models as $key=>$model)
	<tr id="id-{{ $model->slug }}">
		<td>{{ $models->firstItem()+$key }}.</td>
		<td>{{ isset($model->hasCustomer)?$model->hasCustomer->name:'--'   }}</td>
		<td>{{ $model->hasCustomer->phone ??'--' }}</td>
		<td>{{ $model->hasCustomer->email ??'--' }}</td>
		<td><span class="badge badge-info">{{ date('d, F-y', strtotime($model->pickup_date)) }}</span></td>
		<td><span class="badge badge-info">{{ date('h:i A', strtotime($model->pickup_time)) }}</span></td>
		<td>
			@if($model->status==1)
				<span class="badge badge-info">Pending</span>
			@elseif($model->status==2)
				<span class="badge badge-success">Confirmed</span>
			@elseif($model->status==3)
				<span class="badge badge-danger">Cancelled</span>
			@endif
		</td>
		<td>
			@if($model->status==1)
				<button class="btn btn-warning btn-xs booking-status-btn" data-booking-number="{{ $model->id }}" data-booking-status="{{ $model->status }}"><i class="fa fa-tasks"></i> Status</button>
			@endif
			<a href="{{ route('appointment.show', $model->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> View</a>
		</td>
	</tr>
@endforeach
<tr>
	<td colspan="11">
		Displying {{$models->firstItem()}} to {{$models->lastItem()}} of {{$models->total()}} records
		<div class="d-flex justify-content-center">
			{!! $models->links('pagination::bootstrap-4') !!}
		</div>
	</td>
</tr>