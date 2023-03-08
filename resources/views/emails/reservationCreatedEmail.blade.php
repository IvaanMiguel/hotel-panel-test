<!DOCTYPE html>
<html lang="es" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Cardo Font-->
    	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
		<title></title>
	</head>
	<style>
		*{
			font-family: 'Lato', sans-serif;
		}
		@media print
		{    
			.no-print, .no-print *
			{
				display: none !important;
			}
		}
	</style>
	<body>

		<div style="max-width:900px; margin:0 auto">
			<table width="100%" class="no-print">
				<tbody>
					<tr>
						<td style="border-bottom: 5px solid red">
			              <div style="height:40px; background-image:url('{{asset('images/emails/cielo-de-la-paz-bcs.jpg')}}'); background-size: cover; width:100%" ></div>
			              <div style="text-align:center;margin:30px 0 30px 0;">
			                <img  style="max-width:500px" width="100%" src="{{asset('images/emails/cadena-sevencrown-logo.png')}}">
			              </div>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="width:100%; margin: 0 auto" class="no-print">
				<tbody>
					<tr>
						<td>
							<h1 style="text-align:center;font-size:20px;color:white; background-color:#6ab1bf; padding:30px">
								Nueva reservación confirmada 
							</h1>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="width: 100%;margin: 0 auto">
				<tbody>
					<tr>
						<td>
	          				<h1 style="font-size:20px; color: #525252 !important; border-bottom: 2px solid #585f77; text-align:center ">
	          					Información del a reserva
	          				</h1>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="width:100%;margin: 0 auto">
				<tbody>
					<tr>
						<td>
	          				<h1 style="font-size:20px; color: #525252 !important;text-align:left ">
	          					@if ($reservation->room->hotel->id==1)  
								  	Hotel La Paz Malecón
	          					@endif
	          					@if ($reservation->room->hotel->id==2)  
								  	Hotel La Paz Centro Histórico
	          					@endif
	          					@if ($reservation->room->hotel->id==3)  
	          						CABO SAN LUCAS EXPRESS & SUITES
	          					@endif
	          				</h1>
						</td>
					</tr>
				</tbody>
			</table>
		    <table style="width:100%;margin: 0 auto">
		        <tbody>
		          <tr> 
		            <td>
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <img src="{{asset('images/emails/user.png')}}" width="20" >
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->client->name }}
		                    </p>
		                  </td>
		                </tr>
		              </table>
		              <table>
		                <tr>
		                  <td style="vertical-align:top">
		                    <img src="{{asset('images/emails/user.png')}}" width="20">
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->amount_of_people }} Huéspedes
		                    </p>
		                  </td>
		                </tr>
		              </table>
		              <table>
		                <tr>
		                  <td style="vertical-align:top">
		                    <img src="{{asset('images/emails/bed.png')}}" width="20" >
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important; margin:0 0 10px 0" >
		                    	@if ($reservation->room->type_id==1)  
		      						ESTÁNDAR SENCILLA
		      					@endif
		      					@if ($reservation->room->type_id==2)  
		      						ESTÁNDAR DOBLE
		      					@endif
		      					@if ($reservation->room->type_id==3)  
		      						JR SUITE
		      					@endif
		      					@if ($reservation->room->type_id==4)  
		      						MASTER SUITE
		      					@endif
		      					@if ($reservation->room->type_id==5)  
		      						JR SUITE LOVE
		      					@endif
		      					@if ($reservation->room->type_id==6)  
		      						EXPRESS DOBLE
		      					@endif
		      					@if ($reservation->room->type_id==7)  
		      						EXPRESS SENCILLA
		      					@endif
		      					@if ($reservation->room->type_id==8)  
		      						SUITE SENCILLA
		      					@endif
		      					@if ($reservation->room->type_id==9)  
		      						SUITE DOBLE
		      					@endif
		                    </p>
		                  </td>
		                </tr>
		              </table>
		              <table>
		                <tr>
		                  <td style="vertical-align:top">
		                    <img src="{{asset('images/emails/clock.png')}}" width="20" >
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->nights_reserved }} Noches  ({{ $reservation->check_in }} - {{ $reservation->check_out }})
		                    </p> 
		                  </td>
		                </tr>
		              </table>
		              <table>
		                <tr>
		                  <td style="vertical-align:top">
		                    <img src="{{asset('images/emails/email.png')}}" width="20" >
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	<a href="mailto:{{ $reservation->client->email }}">
		                    		{{ $reservation->client->email }}
		                    	</a>
		                    </p>
		                  </td>
		                </tr>
		              </table>
		              <table>
		                <tr>
		                  <td style="vertical-align:top">
		                    <img src="{{asset('images/emails/phone.png')}}" width="20" >
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	<a href="tel:{{ $reservation->client->phone_number }}">
		                    		{{ $reservation->client->phone_number }}
		                    	</a>
		                    </p>
		                  </td>
		                </tr>
		              </table>
		              <table>
		                <tr>
		                  <td style="vertical-align:top">
		                    <img src="{{asset('images/emails/comment.png')}}" width="20" >
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->comments }}
		                    </p>
		                  </td>
		                </tr>
		              </table>
		            </td>
		          </tr>
		        </tbody>
		    </table>
		    <table  style="width: 100%;margin: 0 auto;margin-bottom:30px;margin-top:30px;border-collapse: collapse;">
				<tbody>
					<tr style="border-bottom: 1px solid #e5e5e5;" >
						<th style="padding: 5px 10px;color:#525252">
							#
						</th>
						<th style="padding: 5px 10px;color:#525252">
							Huésped
						</th>
						<th style="padding: 5px 10px;color:#525252">
							Total
						</th>
					</tr>
					<tr class="no-print">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					@if ( isset($reservation->reservations_rooms) && count($reservation->reservations_rooms)>0 )
					@php
						$x=1;
					@endphp
					@foreach ($reservation->reservations_rooms as $room) 
					<tr style="border-bottom: 1px solid #e5e5e5;">
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
			              <p style="margin: 0 0 10px 0">
			              	Habitación {{ $x }}
			              </p> 
			            </td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							{{ $room->number_of_people }}
						</td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							${{ number_format($room->final_amount,2) }} MXN
						</td>
					</tr>
					@php
						$x++;
					@endphp
					@endforeach
					@endif

					{{-- SERVICIOS --}}
	                  @if (isset($reservation->services) && count($reservation->services)>0)
	                  @foreach ($reservation->services as $service) 

	                  <tr style="border-bottom: 1px solid #e5e5e5;">
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
			              <p style="margin: 0 0 10px 0">
			              	{{ ( Config::get('app.locale')=='es')?$service->name_es:'' }}
		                      {{ ( Config::get('app.locale')=='en')?$service->name_en:'' }}
		                      {{ ( Config::get('app.locale')=='fr')?$service->name_fr:'' }}
			              </p> 
			            </td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							@if ($service->applies_only_the_first_night)
								Aplica solo para la primera noche
							@else
								Aplica para todas las noches 
							@endif
						</td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							
		                    {{ number_format($service->pivot->total_service,2) }} MXN

						</td>
					</tr>

	                  @endforeach
	                  @endif

					@if (isset($reservation->coupons) && count($reservation->coupons)>0)
					@foreach ($reservation->coupons as $coupon)

					<tr style="border-bottom: 1px solid #e5e5e5;">
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
			              <p style="margin: 0 0 10px 0">
			              	@if ($coupon->price_per_night)
								Precio por noche
							@else
								Descuento
							@endif
			              </p> 
			            </td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							
						</td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							@if ($coupon->price_per_night)
								{{ number_format($coupon->price_per_night,2) }} {{ $coupon->exchange }}
							@elseif( $coupon->is_percentage )
								-{{ $coupon->amount }} &nbsp; % &nbsp;
							@else
								-{{ number_format($coupon->amount,2) }} {{ $coupon->exchange }}
							@endif
						</td>
					</tr> 

					@endforeach
					@endif

				</tbody>
			</table>
			<table  style="width: 100%;margin: 0 auto;margin-bottom:30px;margin-top:30px;border-collapse: collapse;" >
				<tbody>
					<tr style="border-bottom: 1px solid #e5e5e5;">
						<th style="padding: 5px 10px;color:#525252">Nombre</th>
						<th style="padding: 5px 10px;color:#525252">Precio por noche</th>
						<th style="padding: 5px 10px;color:#525252">Total</th>
					</tr>
					<tr class="no-print">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr style="border-bottom: 1px solid #e5e5e5;">
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
			              <p style="margin: 0 0 10px 0">
			              	{{ $reservation->client->name }}
			              </p> 
			            </td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							${{ number_format( ($reservation->amount/$reservation->nights_reserved) ,2) }} MXN
						</td>
						<td style="padding: 5px 10px;color:#525252;vertical-align:top;text-align:center">
							${{ number_format($reservation->amount,2) }} MXN
						</td>
					</tr>

				</tbody>
			</table>
			@if ($reservation->billing && isset($reservation->facturacion_data)) 
			<table style="width:100%;margin: 0 auto">
		        <tbody>
		          <tr> 
		            <td>
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	RAZÓN SOCIAL:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->razon_social }}
		                    </p>
		                  </td>
		                </tr>
		              </table>
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	TIPO DE DOCUMENTO:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->document_type }}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	NÚMERO DE DOCUMENTO:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->document_number }}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	DIRECCIÓN:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->address }}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	CÓDIGO POSTAL:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->zip_code }}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	ESTADO:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->state }}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	CIUDAD:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->city }}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	PAÍS:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{{ $reservation->facturacion_data->country->id }}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		            </td>
		          </tr>
		        </tbody>
		    </table>
			@endif

			<table style="width:100%;margin: 0 auto;background-color: #3F51B5;color: white;" class="no-print">
		        <tbody>
		          <tr> 
		            <td>
		              <table>
		                <tr>
		                  <td style="vertical-align:top" >
		                    <b>
		                    	ACCEDE AL DETALLE DE LA RESERVACIÓN:
		                    </b>
		                  </td>
		                  <td>
		                    <p style="color: white !important;margin:0 0 10px 0" >
		                    	<a href="{{ url('/reservations_detail/'.$reservation->id) }}">
		                    		<span style="color:white;">
										Ir a los detalles de la reservación: {{ url('/reservations_detail/'.$reservation->id) }}
									</span>
		                    	</a>
		                    </p>
		                  </td>
		                </tr>
		              </table> 
		            </td>
		          </tr>
		        </tbody>
		    </table>

			<table style="width:100%" class="no-print">
				<tbody>
					<tr>
						<td >
							<div style="background-color:#525252;padding:30px; ">
								<table style="margin:0 auto">
									<tbody>
										<tr>
											<td>
												<a target="_blank" style="padding:10px" href="https://www.facebook.com/hotelessevencrown"> <img width="30" src="{{asset('images/emails/fb.png')}}"  longdesc="https://www.facebook.com/hotelessevencrown"> </a>
											</td>
											<td>
												<a target="_blank" style="padding:10px" href="https://www.instagram.com/sevencrownhotels/"> <img width="30" src="{{asset('images/emails/insta.png')}}"  longdesc="https://www.instagram.com/sevencrownhotels/"> </a>
											</td>
										</tr>
									</tbody>
								</table>
								<p style="text-align: center;font-size:12px;color:white">
									Copyright © {{ date('Y') }} <a style="color:white;" href="https://hotelsevencrown.com/">Seven Crown </a>  All Right Reserved.
								</p>
								<p style="text-align: center;font-size:12px; max-width:500px; margin: 0 auto;color:white">
									Queda prohibida la reproducción total o parcial, por cualquier medio o forma, sin la autorización previa, expresa y por escrito de su titular
								</p> 
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<img width="0" src="fake.img" alt=""> 
		</div>
	</body>
</html> 