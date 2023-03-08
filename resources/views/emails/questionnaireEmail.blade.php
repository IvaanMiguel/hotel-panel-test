<!DOCTYPE html>
<html lang="en" dir="ltr">
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
	</style>
	<body>

		<div style="max-width:900px; margin:0 auto">
			<table width="100%">
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
			<table style="width:100%; margin: 0 auto">
				<tbody>
					<tr>
						<td>
							<h1 style="text-align:center;font-size:20px;color:white; background-color:#6ab1bf; padding:30px">
								@if ($reservation->lang=='es')
									CALIFIQUE SU EXPERIENCIA
								@endif
								@if ($reservation->lang=='en')
									RATE YOUR EXPERIENCE
								@endif
								@if ($reservation->lang=='fr')
									ÉVALUEZ VOTRE EXPÉRIENCE
								@endif
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
	          					@if ($reservation->lang=='es')
									Hola
								@endif
								@if ($reservation->lang=='en')
									Hello
								@endif
								@if ($reservation->lang=='fr')
									Salut
								@endif

	          					<b>{{ $reservation->client->name }}</b>
	          				</h1>
	          				<h2 style="font-size:18px; color: #525252 !important;text-align:center ">
	          					@if ($reservation->lang=='es')
									Recientemente te hospedaste en <b>SevenCrown {{ $reservation->room->hotel->name }}</b>, cuéntanos ¿qué te pareció?
								@endif
								@if ($reservation->lang=='en')
									You recently stayed at <b>SevenCrown {{ $reservation->room->hotel->name }}</b>, tell us what did you think?
								@endif
								@if ($reservation->lang=='fr')
									Vous avez récemment séjourné à <b>SevenCrown {{ $reservation->room->hotel->name }}</b>, dis nous ce que tu en as pensé ?
								@endif 
	          					
	          				</h2>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="width: 100%;margin: 0 auto">
				<tbody>
					<tr>
						<td> 
	          				<h2 style="font-size:18px; color: #525252 !important;text-align:center ">
	          					
	          					@if ($reservation->lang=='es')
									TÚ OPINIÓN ES MUY IMPORTANTE, NOS PERMITE MEJORAR EN NUESTROS SERVICIOS Y SEGUIR OFRECIENDO UN SERVICIO DE CALIDAD.
								@endif
								@if ($reservation->lang=='en')
									YOUR OPINION IS VERY IMPORTANT, IT ALLOWS US TO IMPROVE OUR SERVICES AND CONTINUE TO OFFER A QUALITY SERVICE.
								@endif
								@if ($reservation->lang=='fr')
									VOTRE AVIS EST TRÈS IMPORTANT, IL NOUS PERMET D'AMÉLIORER NOS SERVICES ET DE CONTINUER À PROPOSER UN SERVICE DE QUALITÉ.
								@endif

	          					
	          				</h2>
						</td>
					</tr>
				</tbody>
			</table>
			 
		    <table  style="width: 100%;margin: 0 auto;margin-bottom:30px;margin-top:30px;border-collapse: collapse;">
				<tbody>
					<tr>
						<td> 
	          				<h1 style="font-size:20px; color: #525252 !important;  text-align:center ">
	          					
	          					@if ($reservation->lang=='es')
									ENCUESTA
								@endif
								@if ($reservation->lang=='en')
									SURVEY
								@endif
								@if ($reservation->lang=='fr')
									ENQUÊTE
								@endif
	          					
	          					<center>
	          						<div style="border-bottom: 2px solid #f3a333; text-align:center;width: 100px;"></div>
	          					</center>
	          				</h1>
	          				<h2 style="font-size:18px; color: #000000 !important;text-align:center ">
	          					
	          					@if ($reservation->lang=='es')
									{{ $reservation->questionnaire->title_es }}
								@endif
								@if ($reservation->lang=='en')
									{{ $reservation->questionnaire->title_en }}
								@endif
								@if ($reservation->lang=='fr')
									{{ $reservation->questionnaire->title_fr }}
								@endif
	          					
	          				</h2>
	          				<p style="text-align:center;">

	          					@if ($reservation->lang=='es')
									{{ $reservation->questionnaire->description_es }}
								@endif
								@if ($reservation->lang=='en')
									{{ $reservation->questionnaire->description_en }}
								@endif
								@if ($reservation->lang=='fr')
									{{ $reservation->questionnaire->description_fr }}
								@endif

			              		
			              	</p>
						</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td> 
	          				<form method="get" action="https://hotelsevencrown.com/opinion/{{ base64_encode($reservation->questionnaire->id.'hotelsevencrown'.$reservation->id) }}"  style="text-align:center;">
			              		@if (isset($reservation->questionnaire))
			              		@php
			              			$counter = 0;
			              		@endphp

			              		@foreach ($reservation->questionnaire->questions as $question) 
			              		
			              		<label for="question_{{ $question->id }}">
			              			<a href="https://hotelsevencrown.com/opinion/{{ base64_encode($reservation->questionnaire->id.'hotelsevencrown'.$reservation->id) }}" style="text-decoration: none;">
			              				
			              				@if ($reservation->lang=='es')
											<b>{{ $question->text_es }}</b>
										@endif
										@if ($reservation->lang=='en')
											<b>{{ $question->text_en }}</b>
										@endif
										@if ($reservation->lang=='fr')
											<b>{{ $question->text_fr }}</b>
										@endif 
			              				
			              			</a>
			              		</label>

			              		<br>

			              		@foreach ($question->options as $option)
			              			<a href="https://hotelsevencrown.com/opinion/{{ base64_encode($reservation->questionnaire->id.'hotelsevencrown'.$reservation->id) }}" style="text-decoration: none;">
			              				<input type="radio" id="question_{{ $question->id }}" name="question_{{ $question->id }}" value="{{ $option->id }}">

										<label for="question_{{ $question->id }}">

											@if ($reservation->lang=='es')
												{{ $option->text_es }}
											@endif
											@if ($reservation->lang=='en')
												{{ $option->text_en }}
											@endif
											@if ($reservation->lang=='fr')
												{{ $option->text_fr }}
											@endif 

											
										</label>
									</a>
			              		@endforeach

			              		<br><br>

			              		@php
			              			$counter++;
			              			if ($counter==3){

			              				break;
			              			} 
			              		@endphp
			              		@endforeach
			              		@endif

			              		<br>

			              		....

			              		<br>  

			              		<a href="https://hotelsevencrown.com/opinion/{{ base64_encode($reservation->questionnaire->id.'hotelsevencrown'.$reservation->id) }}" class="btn btn-primary send-button" style="border:none;cursor: pointer;">
			              			
			              			@if ($reservation->lang=='es')
										Contestar encuesta
									@endif
									@if ($reservation->lang=='en')
										Answer survey
									@endif
									@if ($reservation->lang=='fr')
										Répondre au sondage
									@endif 

			              		</a> 

			              		<br> 
			              	</form>
						</td>
					</tr>
				</tbody>
			</table>
			 

			<table style="width:100%">
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
									
									@if ($reservation->lang=='es')
										Queda prohibida la reproducción total o parcial, por cualquier medio o forma, sin la autorización previa, expresa y escrita del titular.
									@endif
									@if ($reservation->lang=='en')
										The total or partial reproduction, by any means or form, without the prior, express and written authorization of the owner is prohibited.
									@endif
									@if ($reservation->lang=='fr')
										La reproduction totale ou partielle, par quelque moyen ou forme que ce soit, sans l'autorisation préalable, expresse et écrite du propriétaire est interdite.
									@endif 

									
								</p>
								<p style="text-align: center;font-size:12px;color:white">
	            					<a style="color:white;" href="https://hotelsevencrown.com/privacy">
	            						
	            						@if ($reservation->lang=='es')
											Términos y condiciones
										@endif
										@if ($reservation->lang=='en')
											Terms and Conditions
										@endif
										@if ($reservation->lang=='fr')
											Termes et conditions
										@endif 
	            						
	            					</a>
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