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
								Reply to your contact message
							</h1>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="width: 100%;margin: 0 auto">
				<tbody>
					<tr>
						<td></td>
					</tr>
				</tbody>
			</table>
			<table style="width:100%;margin: 0 auto">
				<tbody>
					<tr>
						<td>
	          				<h1 style="font-size:20px; color: #525252 !important;text-align:left ">
	          					@if ($contact->hotel_id==1)  
								  	Hotel La Paz Malecón 
	          					@endif
	          					@if ($contact->hotel_id==2)  
								  	Hotel La Paz Centro Histórico
	          					@endif
	          					@if ($contact->hotel_id==3)  
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
		                  <td>
		                    <p style="color: #525252 !important;margin:0 0 10px 0" >
		                    	{!! $contact -> response !!}
		                    </p>
		                  </td>
		                </tr>
		              </table> 
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
									The total or partial reproduction, by any means or form, without the prior, express and written authorization of the owner is prohibited.
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