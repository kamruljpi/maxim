@extends('layouts.dashboard')
{{-- @section('page_heading',trans('others.task_label')) --}}
@section('page_heading','')
@section('section')

<?php $increase = $initIncrease; ?>
<form action="{{ Route('task_action') }}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table class="table table-bordered mainBody">
    <thead>
    	<tr>
        	<th width="5%">SI</th>
        	<th width="10%">PO/CAT</th>
        	<th width="10%">Item code</th>
        	<th width="15%">Description</th>
        	<th width="10%">Size</th>
        	<th width="10%">TOTAL PCS/MTR</th>
        	<th width="10%">Initial Incrise(%)</th>
        	<th width="10%">1ST DELIVERY</th>
            <th width="10%">Request Date</th>
            <th width="10%">Confirmation Date</th>
        </tr>
    </thead>
    <tbody> 
    	<?php
    		$j = 1;
    		$totalAllQty = 0;
    		$totalAllIncrQty = 0;
    		$totalUsdAmount = 0;
    		$BDTandUSDavarage = 80;
    		$rowspanValue = 0;
    	 ?>
    	 	@foreach($sentBillId as $counts)
    	 		<?php
    	 			$count = 1;
    	 			$rowspanValue += $count;
    	 		 ?>
    	 	@endforeach

			<?php
            	$ipoIdInc = 0;
			?>
    		@foreach ($sentBillId as $key => $item)

    			<?php
    				$i = 0;
    				$k = 0;

    				$totalQty =0;
    				$totalIncrQty = 0;
    				$itemsize = explode(',', $item->item_size);  				
    				$qty = explode(',', $item->item_quantity);
    				$itemlength = 0;
    				foreach ($itemsize as $itemlengths) {
    					$itemlength = sizeof($itemlengths);
    				}
    				$itemQtyValue = array_combine($itemsize, $qty);		
    			?>
    			
    			
	    			<tr>
	    				<td>{{$j++}}</td>
	    				<td rowspan="{{$itemlength}}">{{$item->poCatNo}}</td>
	    				<td rowspan="{{$itemlength}}">{{$item->item_code}}</td>
	    				<td rowspan="{{$itemlength}}">{{$item->erp_code}}</td>			    		
			    			@if ($itemlength >= 1 )
				    			<td colspan="2" class="colspan-td">  				
				    				<table >
				    					@foreach ($itemQtyValue as $size => $Qty)
				    					<?php 
				    						$i++;
				    						$totalQty += $Qty; 
				    					?>
				    					<tr>
				    						<td width="50%">{{$size}}</td>
							    			<td width="50%">{{$Qty}}</td>
				    					</tr>
				    					@endforeach

				    					@if( $i > 1 )
				    					<tr>
				    						<td></td>
				    						<td width="100%">{{$i}}{{$totalQty}}</td>
				    					</tr>
				    					@endif
				    				</table>
				    			</td>
				    			<td class="colspan-td">
				    			<div class="middel-table">
				    				<table>
				    					@foreach ($itemQtyValue as $size => $Qty)
											<?php
												$k++;
												$totalIncrQty += ceil(($Qty*$increase)/100 + $Qty);
											?>

											<tr>

												<input type="hidden" name="taskType" value="IPO">
												<input type="hidden" name="ipo_increase" value="YES">

												<?php

												?>

												<input type="hidden" name="ipo_id[]" value="{{$ipoIds[$ipoIdInc]}}" >
												<td width="100%">
													<input type="text" name="ipo_increase_percentage[]" value="" placeholder="Percentage">
												</td>

											</tr>
				    					@endforeach
										<?php $ipoIdInc = $ipoIdInc+1; ?>

				    					@if( $k > 1 )
				    					<tr>
{{--				    						<td width="100%">{{$totalIncrQty}}</td>--}}
				    					</tr>
				    					@endif
				    				</table>
				    				</div> 				
				    			</td>
				    		@endif			    		   
			    		<?php 
    						$totalAllQty += $totalQty;
    						$totalAllIncrQty += $totalIncrQty;
    					?>
    					<td></td>
    					<td style="padding-top: 20px;">
    						{{Carbon\Carbon::parse($billdata->created_at)->format('d-m-Y')}}
    					</td>
    					<td></td>
	    			</tr>
    		@endforeach
    	
    	  <tr>
		</tr>

	</tbody>
</table>
	<div class="form-group">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<button type="submit" class="btn btn-primary form-control" style="margin-right: 15px;">Save
			</button>
		</div>
		<div class="col-md-5"></div>
	</div>
</form>
<script type="text/javascript">
	function myFunction() {
		$('.colspan-td table').css('font-family','arial, sans-serif');
		$('.colspan-td table').css('border-collapse','collapse');
		$('.colspan-td table').css('width','100%');
		$('.colspan-td table td').css('border','1px solid #DBDBDB');
		$('.colspan-td table td').css('padding','5px');
		$('.colspan-td table tr:first-child td').css('border-top', '0');
		$('.colspan-td table tr td:first-child').css('border-left', '0');
		$('.colspan-td table tr:last-child td').css('border-bottom', '0');
		$('.colspan-td table tr td:last-child').css('border-right', '0');
	    window.print();
	}
</script>
@stop
