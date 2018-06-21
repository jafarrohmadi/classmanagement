<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

		<!-- <meta http-equiv="Refresh" content="5; URL={{ URL::to('/') }}"> -->
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
                color: #0000FF;
            }
            .redi {
                text-align: center;
                color: #0000FF;
                font-size: 20px;            
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">500 Internal Server Error.</div>
                <div class="redi">You will be redirected in <span id="counter">5</span> second(s).</div>
            </div>
        </div>	


    </body>

	    <script type="text/javascript">
			function countdown() {
			    var i = document.getElementById('counter');
			    i.innerHTML = parseInt(i.innerHTML)-1;
			    if (parseInt(i.innerHTML)<=0) {
			        location.href = '{{ URL::to("/") }}';
			    }
			    
			}
			setInterval(function(){ countdown(); },1000);
		</script>
</html>

